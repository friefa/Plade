<?php
/**
 * Plade
 * ModuleDependencyType
 * Fabian Friedl
 * 19.04.2020
 * All rights reserved.
 */

/**
 * This class forms an artificial enumeration with conversion methods.
 */
abstract class ModuleDependencyType
{
    const CSS = 0;
    const JS = 1;
    const JSModule = 2;
    const JSDefer = 3;
    const Module = 4;

    /**
     * This method returns the dependency type of a given string.
     */
    public static function GetType(string $type) : int
    {
        $result = -1;

        if ($type == "css")
        {
            $result = ModuleDependencyType::CSS;
        }
        else if ($type == "js")
        {
            $result = ModuleDependencyType::JS;
        }
        else if ($type == "jsmodule")
        {
            $result = ModuleDependencyType::JSModule;
        }
        else if ($type == "jsdefer")
        {
            $result = ModuleDependencyType::JSDefer;
        }
        else if ($type == "module")
        {
            $result = ModuleDependencyType::Module;
        }

        return $result;
    }

    /**
     * This static method returns the appropriate HTML tag for a dependency.
     */
    public static function GetDependencyString(string $module, object $dependency) : string
    {
        $result = "";

        switch ($dependency->Type)
        {
            case ModuleDependencyType::CSS:
                $result = self::GetDependencyStringCss($module, $dependency);
                break;

            case ModuleDependencyType::JS:
                $result = self::GetDependencyStringJs($module, $dependency);
                break;

            case ModuleDependencyType::JSModule:
                $result = self::GetDependencyStringJsModule($module, $dependency);
                break;

            case ModuleDependencyType::JSDefer:
                $result = self::GetDependencyStringJsDefer($module, $dependency);
                break;
        }

        return $result;
    }

    /**
     * This private method specifies the appropriate HTML head tag for the modular dependency of a CSS file.
     */
    private static function GetDependencyStringCss(string $module, object $dependency) : string
    {
        $result = '';

        if ($dependency->CDN)
        {
            $result = '<link rel="stylesheet" href="'.$dependency->FileName.'">';
        }
        else
        {
            $result = '<link rel="stylesheet" href="modules/'.$module.'/dependencies/'.$dependency->FileName.'">';
        }

        return $result;
    }

    /**
     * This private method specifies the appropriate HTML head tag for the modular dependency of a JS file.
     */
    private static function GetDependencyStringJs(string $module, object $dependency) : string
    {
        $result = '';

        if ($dependency->CDN)
        {
            $result = '<script src="'.$dependency->FileName.'"></script>';
        }
        else
        {
            $result = '<script src="modules/'.$module.'/dependencies/'.$dependency->FileName.'"></script>';
        }

        return $result;
    }

    /**
     * This private method specifies the appropriate HTML head tag for the modular dependency of a JS Module file.
     */
    private static function GetDependencyStringJsModule(string $module, object $dependency) : string
    {
        $result = '';

        if ($dependency->CDN)
        {
            $result = '<script type="module" src="'.$dependency->FileName.'"></script>';
        }
        else
        {
            $result = '<script type="module" src="modules/'.$module.'/dependencies/'.$dependency->FileName.'"></script>';
        }

        return $result;
    }

    /**
     * This private method specifies the appropriate HTML head tag for the modular dependency of a JS Defer file.
     */
    private static function GetDependencyStringJsDefer(string $module, object $dependency) : string
    {
        $result = '';

        if ($dependency->CDN)
        {
            $result = '<script defer src="'.$dependency->FileName.'"></script>';
        }
        else
        {
            $result = '<script defer src="modules/'.$module.'/dependencies/'.$dependency->FileName.'"></script>';
        }

        return $result;
    }
}

?>