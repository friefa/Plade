<?php

include_once("lib/utils/stringUtils.php");

class HeaderModule extends Module
{
    function render(array $params)
    {
        $template = file_get_contents("modules/headerModule/templates/header.html");
        parent::InsertReplacements($template, $params);

        echo $template;
    }
}

?>