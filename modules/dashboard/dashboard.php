<?php
/**
 * BABOOK
 * Dashboard
 * Fabian Friedl
 * 19.04.2020
 * All rights reserved.
 */

// Implementations
include_once("lib/utils/stringUtils.php");

/**
 * This module represents the main module of the web application.
 */
class Dashboard extends Module
{
    /**
     * This method displays the module on the website.
     */
    function render(array $params)
    {
        $template = file_get_contents("modules/dashboard/templates/dashboard.html");
        parent::InsertReplacements($template, $params);

        echo $template;
    }
}

?>