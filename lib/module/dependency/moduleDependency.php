<?php
/**
 * BABOOK
 * ModuleDependency
 * Fabian Friedl
 * 19.04.2020
 * All rights reserved.
 */

// Implementations
include_once('lib/module/dependency/moduleDependencyType.php');

/**
 * This object represents a modular dependency.
 */
class ModuleDependency
{
    // Data fields
    public string $FileName;
    public int $Type;

    /**
     * This method initializes a modular dependency by its name and type.
     */
    public function Init(string $dependencyName, string $dependencyType) : void
    {   
        $this->FileName = $dependencyName;
        $this->Type = ModuleDependencyType::GetType($dependencyType);

        if ($this->Type == -1)
        {
            print("[MODULE-DEPENDENCY] Invalid dependency type '".$dependencyType."'");
        }
    }

    /**
     * This method checks if a module has and represents this dependency.
     */
    public function OwnedBy(string $module) : bool
    {   
        $result = false;

        if (file_exists("modules/".$module."/dependencies/".$this->FileName))
        {
            $result = true;
        }

        return $result;
    }
}

?>