<?php
/**
 * Plade
 * ModuleDependency
 * Fabian Friedl
 * 19.04.2020
 * All rights reserved.
 */

// Implementations
include_once('lib/module/dependency/moduleDependencyType.php');
include_once('lib/utils/urlUtils.php');

/**
 * This object represents a modular dependency.
 */
class ModuleDependency
{
    // Data fields
    public string $FileName;
    public int $Type;
    public bool $CDN;

    /**
     * This method initializes a modular dependency by its name and type.
     */
    public function Init(string $dependencyName, string $dependencyType) : void
    {   
        $this->FileName = $dependencyName;
        $this->Type = ModuleDependencyType::GetType($dependencyType);

        if (UrlUtils::IsValid($dependencyName))
        {
            $this->CDN = true;
        }
        else 
        {
            $this->CDN = false;
        }

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