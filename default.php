<?php
/**
 * Plade
 * Application
 * Fabian Friedl
 * 19.04.2020
 * All rights reserved.
 */

// Implementations
include_once("lib/engine/engine.php");

session_start();

// Get all parameters
$params = array_merge($_POST, $_GET, $_SESSION);

// Start the web application engine
$engine = new Engine();
$engine->Execute($params);

?>