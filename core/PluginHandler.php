
<?php

class PluginHandler
{
    private static $activePlugins = [];

    public static function init()
    {
        System::log("PluginHandler initialized. Loading plugins...");
        self::loadPlugins();
    }

    private static function loadPlugins()
    {
        $pluginsDir = __DIR__ . "/../plugins/";
        System::log("Procurando plugins em: " . $pluginsDir);
        $pluginFolders = array_filter(glob($pluginsDir . "*"), "is_dir");
        System::log("Pastas encontradas: " . print_r($pluginFolders, true));
        if (!is_dir($pluginsDir)) {
            mkdir($pluginsDir, 0777, true);
            System::log("Plugins directory created: {$pluginsDir}");
            return;
        }

        foreach ($pluginFolders as $folder) {
            $pluginSlug = basename($folder);
            $pluginJsonPath = $folder . "/plugin.json";
            $mainPhpPath = $folder . "/main.php";

            if (file_exists($pluginJsonPath) && file_exists($mainPhpPath)) {
                $pluginData = json_decode(file_get_contents($pluginJsonPath), true);

                if ($pluginData && isset($pluginData["name"]) && isset($pluginData["slug"])) {
                    // Check if plugin is active (for now, assume all found are active)
                    // In a real scenario, this would come from a database or config
                    self::$activePlugins[$pluginSlug] = $pluginData;
                    System::log("Loading plugin: " . $pluginData["name"] . " ({$pluginSlug})");

                    // Inclui main.php do plugin e loga
                    System::log("Incluindo plugin: $mainPhpPath");
                    require_once $mainPhpPath;

                    // Register plugin routes
                    if (isset($pluginData["routes"]) && is_array($pluginData["routes"])) {
                        foreach ($pluginData["routes"] as $route) {
                            // Assuming all plugin routes are GET for now, can be extended
                            RoutesHandler::addRoute("GET", $route, function() use ($pluginSlug, $route) {
                                echo "Plugin {$pluginSlug} route: {$route}";
                            });
                        }
                    }

                } else {
                    System::log("Invalid plugin.json for plugin in folder: {$pluginSlug}", "warning");
                }
            } else {
                System::log("Skipping folder (missing plugin.json or main.php): {$pluginSlug}", "warning");
            }
        }
        System::log("Finished loading plugins.");
        // Logar todas as rotas registradas
        System::log("Rotas registradas: " . print_r(RoutesHandler::getRoutes(), true));
    }

    public static function getActivePlugins()
    {
        return self::$activePlugins;
    }

    // Placeholder for upload and installation functionality
    public static function installPlugin($zipFilePath)
    {
        System::log("Attempting to install plugin from: {$zipFilePath}");
        // Implementation for unzipping, moving files, running install scripts
        // This will be more complex and might involve user interaction/permissions
        System::log("Plugin installation functionality not yet implemented.", "warning");
        return false;
    }
}


