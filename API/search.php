<?php
require_once 'API/Plugin/Plugin.php';

set_time_limit(30);

// Import all existing plugins
foreach (glob(__DIR__ . '/API/Plugins/*/Plugin.php') as $pluginFile) {
    require_once $pluginFile;
}

// Find all classes that extend Plugin
$pluginClasses = [];
foreach (get_declared_classes() as $class) {
    if (is_subclass_of($class, 'Plugin')) {
        $pluginClasses[] = $class;
    }
}

$query   = isset($_GET['q']) ? trim($_GET['q']) : '';
$results = [];

foreach ($pluginClasses as $pluginClass) {
    $networkService = new NetworkService();
    $pluginInstance = new $pluginClass($networkService);

    try {
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
            error_log("Plugin $pluginClass exceeded timeout of $elapsed seconds");
            // No need to continue here as the loop is already finished, but leaving for readability
            continue;
        }

    } catch (\Throwable $e) {
        error_log('Error at ' . $pluginClass . ': ' . $e->getMessage());
        continue;
    }
}

// Output all results as a single array (JSON for the frontend)
header('Content-Type: application/json; charset=utf-8');
echo json_encode($results, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
