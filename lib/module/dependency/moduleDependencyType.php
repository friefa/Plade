<?php

abstract class ModuleDependencyType
{
    const CSS = 0;
    const JS = 1;

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