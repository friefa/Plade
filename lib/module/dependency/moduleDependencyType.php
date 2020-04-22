<?php
/**
 * BABOOK
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

        return $result;
    }

    /**
     * This static method returns the appropriate HTML tag for a dependency.
     */
    public static function GetDependencyString(int $type, string $module, object $dependency) : string
    {
        $result = "";

        switch ($type)
        {
            case ModuleDependencyType::CSS:
                $result = self::GetDependencyStringCss($type, $module, $dependency);
                break;

            case ModuleDependencyType::JS:
                $result = self::GetDependencyStringJs($type, $module, $dependency);
                break;
        }

        return $result;
    }

    /**
     * This private method specifies the appropriate HTML head tag for the modular dependency of a CSS file.
     */
    private static function GetDependencyStringCss(int $type, string $module, object $dependency) : string
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
    private static function GetDependencyStringJs(int $type, string $module, object $dependency) : string
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
}

?>