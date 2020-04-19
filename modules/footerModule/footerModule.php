<?php

include_once("lib/utils/stringUtils.php");

class FooterModule extends Module
{
    function render(array $params)
    {
        $template = file_get_contents("modules/footerModule/templates/footer.html");
        parent::InsertReplacements($template, $params);

        echo $template;
    }
}

?>