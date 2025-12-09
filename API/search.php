<?php

declare (strict_types = 1);

/**
 * Search API - Entry point for searching across plugins
 *
 * This file initializes the necessary plugins and executes the search query
 * against all available plugins, returning the aggregated results.
 */

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

try {
    require_once 'API/Plugin/Plugin.php';
} catch (\Throwable $e) {
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Failed to load Plugin class: ' . $e->getMessage()], JSON_UNESCAPED_UNICODE);
    exit;
}

set_time_limit(30);

// Import all existing plugins
$pluginFiles = glob(__DIR__ . '/Plugins/*/Plugin.php');
if ($pluginFiles === false) {
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Failed to scan plugins directory'], JSON_UNESCAPED_UNICODE);
    exit;
}

foreach ($pluginFiles as $pluginFile) {
    try {
        require_once $pluginFile;
    } catch (\Throwable $e) {
        error_log("Failed to load plugin file $pluginFile: " . $e->getMessage());
        continue;
    }
}

// Find all classes that extend Plugin
$pluginClasses = [];
foreach (get_declared_classes() as $class) {
    if (is_subclass_of($class, 'Plugin')) {
        $pluginClasses[] = $class;
    }
}

// Get and validate search query
$query = isset($_GET['q']) ? trim($_GET['q']) : '';

if (empty($query)) {
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Search query is required'], JSON_UNESCAPED_UNICODE);
    exit;
}

$results = [];

// Check if NetworkService class exists
if (!class_exists('NetworkService')) {
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'NetworkService class not found'], JSON_UNESCAPED_UNICODE);
    exit;
}

// Execute search across all plugins
foreach ($pluginClasses as $pluginClass) {
    try {
        $networkService = new NetworkService();
        $pluginInstance = new $pluginClass($networkService);

        $start         = microtime(true);
        $pluginInfo    = $pluginInstance->getInfo();
        $pluginResults = $pluginInstance->searchTitle($query);

        // Transform DTO -> BO: correctly pass UID
        $bos = array_map(function ($dto) use ($pluginInfo) {
            return $dto->toBo($pluginInfo->uid);
        }, $pluginResults);

        // Add BO array to results
        $results = array_merge($results, $bos);

        $elapsed = microtime(true) - $start;
        if ($elapsed > 5) {
            error_log("Plugin $pluginClass exceeded timeout: $elapsed seconds");
        }

    } catch (\Throwable $e) {
        error_log("Error in plugin $pluginClass: " . $e->getMessage());
        continue;
    }
}

// Output all results as JSON
header('Content-Type: application/json; charset=utf-8');
http_response_code(200);
echo json_encode(['success' => true, 'data' => $results], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
