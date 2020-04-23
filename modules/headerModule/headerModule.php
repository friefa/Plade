<?php
/**
 * BABOOK
 * HeaderModule
 * Fabian Friedl
 * 19.04.2020
 * All rights reserved.
 */

// Implementations
include_once("lib/utils/stringUtils.php");

/**
 * This object is a module that implements the header and all dependencies.
 */
class HeaderModule extends Module
{
    /**
     * This method displays the module on the page.
     */
    function render(array $params) : string
    {
        $template = file_get_contents("modules/headerModule/templates/header.html");
        parent::InsertReplacements($template, $params);

        return $template;
    }
}

?>