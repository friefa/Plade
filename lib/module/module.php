<?php
/**
 * BABOOK
 * Module
 * Fabian Friedl
 * 19.04.2020
 * All rights reserved.
 */

/**
 * This abstract class represents all modules.
 */
abstract class Module 
{
    // Data fields
    public $ModuleConfig;

    /**
     * This abstract method represents a module.
     */
    abstract protected function render(array $params);

    /**
     * This method inserts all values into a template.
     */
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