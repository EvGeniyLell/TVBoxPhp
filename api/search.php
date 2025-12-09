<?php

declare (strict_types = 1);

header('Content-Type: application/json; charset=utf-8');

try {
    require_once __DIR__ . '/Plugin/Plugin.php';
    require_once __DIR__ . '/NetworkService/NetworkService.php';

    $pluginFiles = glob(__DIR__ . '/Plugins/*/Plugin.php');

    if ($pluginFiles === false || empty($pluginFiles)) {
        echo json_encode(['success' => true, 'data' => [], 'info' => 'No plugins found']);
        exit;
    }

    foreach ($pluginFiles as $pluginFile) {
        require_once $pluginFile;
    }

    $pluginClasses = array_filter(get_declared_classes(), function ($class) {
        return is_subclass_of($class, 'Plugin');
    });

    $query = isset($_GET['q']) ? trim($_GET['q']) : '';

    if (empty($query)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Search query is required']);
        exit;
    }

    $results = [];

    foreach ($pluginClasses as $pluginClass) {
        try {
            $networkService = new NetworkService();
            $pluginInstance = new $pluginClass($networkService);
            $pluginInfo     = $pluginInstance->getInfo();
            $pluginResults  = $pluginInstance->searchTitle($query);

            $bos = array_map(function ($dto) use ($pluginInfo) {
                return $dto->toBo($pluginInfo->uid);
            }, $pluginResults);

            $results = array_merge($results, $bos);
        } catch (\Throwable $e) {
            error_log("Error in plugin $pluginClass: " . $e->getMessage());
        }
    }

    echo json_encode(['success' => true, 'data' => $results], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

} catch (\Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
