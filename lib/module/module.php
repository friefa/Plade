<?php

abstract class Module {
    public $ModuleConfig;

    abstract protected function render(array $params);

    protected function InsertReplacements(string &$template, array $params) : string
    {
        foreach ($params as $key => $value)
        {
            if (StringUtils::StartsWith($key, "%") && StringUtils::EndsWith($key, "%"))
            {
                $template = str_replace($key, $value, $template);
            }
        }

        return $template;
    }
}

?>