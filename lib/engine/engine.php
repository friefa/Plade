<?php
/**
 * Plade
 * Engine
 * Fabian Friedl
 * 19.04.2020
 * All rights reserved.
 */

// Implementations
include_once("lib/engine/applicationConfig.php");
include_once("lib/module/module.php");
include_once("lib/module/moduleLoader.php");
include_once("lib/module/moduleHandler.php");
include_once("lib/logging/logger.php");
include_once("lib/database/databaseHandler.php");

class Engine
{
    public function Execute(array $params)
    {
        // Initialize the engine
        ApplicationConfig::Init();
        Logger::Init(ApplicationConfig::$LogFile);
        DatabaseHandler::Init(ApplicationConfig::$Databases);

        // Module Handler is started and manages all modules and the display of the web application.
        $params = array_merge($params, ApplicationConfig::$Replacements);

        if (!isset($params['module']))
        {
            $params['module'] = ApplicationConfig::$EntryModule;
        }

        $moduleHandler = new ModuleHandler();
        $moduleHandler->Handle($params);
    }
}

?>