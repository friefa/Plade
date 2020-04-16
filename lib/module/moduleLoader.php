<?php

include_once("lib/module/moduleConfig.php");

class ModuleLoader
{
    public function Load(string $name)
    {
        if (is_dir("modules/".$name))
        {
            $moduleConfig = new ModuleConfig();
            $moduleConfig->Init($name);

            include("modules/".$name."/".$moduleConfig->Entry);

            $class = $moduleConfig->EntryClass;
            $module = new $class();            

            if ($module !== null)
            {
                $module->ModuleConfig = $moduleConfig;
                return $module;
            }
        }
        else
        {
            print("[MODULE-LOADER] Module '".$name."' not found!");
        }

        return null;
    }    
}

?>