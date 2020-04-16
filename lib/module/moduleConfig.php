<?php

include_once('lib/module/dependency/moduleDependency.php');
include_once('lib/module/dependency/moduleDependencyType.php');

class ModuleConfig
{
    public string $Name;
    public string $ModuleName;
    public string $Developer;
    public string $Version;
    public string $Entry;
    public string $EntryClass;
    public array $Dependencies;

    public function Init($name) : void
    {
        $configFileName = "modules/".$name."/config.json";

        if (file_exists($configFileName))
        {
            $configFile = file_get_contents($configFileName);

            $configFileJson = json_decode($configFile, true);

            if ($configFileJson)
            {
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
                print("[MODULE-CONFIG] Invalid config syntax of ".$name);
            }
        }
        else
        {
            print("[MODULE-CONFIG] Config of module '".$name."' not found!");
        }
    }
}

?>