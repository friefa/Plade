<?php
/**
 * Plade
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
class Box extends Module
{
    /**
     * This method displays the module on the website.
     */
    function render(array $params) : string
    {
        $template = file_get_contents("modules/box/templates/box.html");
        parent::InsertReplacements($template, $params);

        return $template;
    }
}

?>