<?php
/**
 * Plade
 * ModuleLoader
 * Fabian Friedl
 * 19.04.2020
 * All rights reserved.
 */

// Implementations
include_once("lib/module/moduleConfig.php");

/**
 * This object can load modules and their configurations.
 */
class ModuleLoader
{
    /**
     * This method loads a module by its name.
     * If the module could not be found or loaded null is returned.
     */
    public function Load(string $name) : ?object
    {
        if (is_dir("modules/".$name))
        {
            $moduleConfig = new ModuleConfig();
            $moduleConfig->Init($name);

            if ($moduleConfig->Version == ApplicationConfig::$EngineVersion)
            {
                include_once("modules/".$name."/".$moduleConfig->Entry);

                $class = $moduleConfig->EntryClass;
                $module = new $class();            

                if ($module !== null)
                {
                    $module->ModuleConfig = $moduleConfig;
                    return $module;
                }
                else
                {
                    Logger::Log("Initialization of the module '".$name."' failed", $this);
                }
            }
            else
            {
                Logger::Log("The version of module '".$name."' is incompatible with this engine version (".ApplicationConfig::$EngineVersion.")", $this);
            }            
        }
        else
        {
            Logger::Log("Module '".$name."' not found", $this);
        }

        return null;
    }    
}

?>