<?php
/**
 * BABOOK
 * Application
 * Fabian Friedl
 * 19.04.2020
 * All rights reserved.
 */

// Implementations
include_once("lib/engine/applicationConfig.php");
include_once("lib/module/module.php");
include_once("lib/module/moduleLoader.php");
include_once("lib/module/moduleHandler.php");

// Initialize the application configuration
ApplicationConfig::Init();

// Module Handler is started and manages all modules and the display of the web application.
$params = array_merge($_GET, $_POST);

if (!isset($params['module']))
{
    $params['module'] = 'login';
}



$moduleHandler = new ModuleHandler();
$moduleHandler->Handle($params);

?>