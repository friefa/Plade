<?php
/**
 * Plade
 * ModuleConfig
 * Fabian Friedl
 * 19.04.2020
 * All rights reserved.
 */

// Implementations
include_once('lib/module/dependency/moduleDependency.php');
include_once('lib/module/dependency/moduleDependencyType.php');

/**
 * This object represents the configuration file of a module.
 */
class ModuleConfig
{
    // Data fields
    public string $Name;
    public string $ModuleName;
    public string $Developer;
    public string $Version;
    public string $Entry;
    public string $EntryClass;
    public array $Dependencies;

    /**
     * This method initializes the configuration object.
     */
    public function Init($name) : void
    {
        $configFileName = "modules/".$name."/config.json";

        // Checks if the configuration file exists.
        if (file_exists($configFileName))
        {
            $configFile = file_get_contents($configFileName);

            $configFileJson = json_decode($configFile, true);

            // Checks if the JSON configuration file is valid.
            if ($configFileJson)
            {
                // All relevant entries are loaded into the object.
                $this->Name = $name;
                $this->ModuleName = $configFileJson["ModuleName"];
                $this->Developer = $configFileJson["Developer"];
                $this->Version = $configFileJson["Version"];
                $this->Entry = $configFileJson["Entry"];
                $this->EntryClass = $configFileJson["EntryClass"];
                
                $deps = $configFileJson["Dependencies"];

                $this->Dependencies = array();

                foreach ($deps as $key => $value)
                {
                    $moduleDependency = new ModuleDependency();
                    $moduleDependency->Init($key, $value);

                    $this->Dependencies[] = $moduleDependency;
                }
            }
            else
            {
                Logger::Log("Invalid config syntax of ".$name, $this);
            }
        }
        else
        {
            Logger::Log("Config of module '".$name."' not found", $this);
        }
    }

    /**
     * This method checks whether the module configuration has a specific dependency.
     */
    public function HasDependency(object $targetDependency) : bool
    {
        $result = false;

        foreach ($this->Dependencies as $dependency)
        {
            if ($targetDependency->FileName == $dependency->FileName)
            {
                $result = true;
            }
        }

        return $result;
    }
}

?>