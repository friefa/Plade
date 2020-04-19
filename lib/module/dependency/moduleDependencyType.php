<?php

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
    public static function GetDependencyString(int $type, string $module, string $dependencyName) : string
    {
        $result = "";

        switch ($type)
        {
            case ModuleDependencyType::CSS:
                $result = '<link rel="stylesheet" href="modules/'.$module.'/dependencies/'.$dependencyName.'">';
                break;

            case ModuleDependencyType::JS:
                $result = '<script src="modules/'.$module.'/dependencies/'.$dependencyName.'"></script>';
                break;
        }

        return $result;
    }
}

?>