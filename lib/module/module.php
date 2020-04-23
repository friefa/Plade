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
    abstract protected function render(array $params) : string;

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

    /**
     * This function insert all hooks into the template.
     */
    protected function InsertHooks(string &$template, array $dependencies, array $params)
    {
        foreach ($dependencies as $dependency)
        {
            if ($dependency->Type == ModuleDependencyType::Module)
            {
                $hook = "{hook.".$dependency->FileName."}";
                $module = self::GetByName($dependency->FileName, ModuleHandler::$LoadedModules)->render($params);

                $template = str_replace($hook, $module, $template);
            }
        }
    }

    /**
     * This function will insert portals (href-links) into its template.
     */
    protected function InsertPortals(string &$template, array $dependencies, array $params)
    {
        foreach ($dependencies as $dependency)
        {
            if ($dependency->Type == ModuleDependencyType::Module)
            {
                $hook = "{portal.".$dependency->FileName."}";

                $template = str_replace($hook, 'href="default.php?module='.$dependency->FileName.'"', $template);
            }
        }
    }

    /**
     * This method search for a module in an array by its name.
     */
    public static function GetByName(string $name, array $modules) : ?object
    {
        $result = null;

        foreach ($modules as $module)
        {
            if ($module->ModuleConfig->Name == $name)
            {
                $result = $module;
                break;
            }
        }

        return $result;
    }
}

?>