<?php
/**
 * BABOOK
 * FooterModule
 * Fabian Friedl
 * 19.04.2020
 * All rights reserved.
 */

// Implementations
include_once("lib/utils/stringUtils.php");

/**
 * This object is a module which represents the end of the website.
 */
class FooterModule extends Module
{
    /**
     * This method represents the end of the website.
     */
    function render(array $params)
    {
        $template = file_get_contents("modules/footerModule/templates/footer.html");
        parent::InsertReplacements($template, $params);

        echo $template;
    }
}

?>