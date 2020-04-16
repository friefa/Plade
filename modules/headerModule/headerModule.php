<?php

include_once("lib/utils/stringUtils.php");

class HeaderModule extends Module
{
    function render(array $params)
    {
        $template = file_get_contents("modules/headerModule/templates/header.html");

        foreach ($params as $key => $value)
        {
            if (StringUtils::StartsWith($key, "%") && StringUtils::EndsWith($key, "%"))
            {
                $template = str_replace($key, $value, $template);
            }
        }

        echo $template;
    }
}

?>