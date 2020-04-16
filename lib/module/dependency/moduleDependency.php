<?php

include_once('lib/module/dependency/moduleDependencyType.php');

class ModuleDependency
{
    public string $FileName;
    public int $Type;

    public function Init(string $dependencyName, string $dependencyType) : void
    {   
        $this->FileName = $dependencyName;
        $this->Type = ModuleDependencyType::GetType($dependencyType);

        if ($this->Type == -1)
        {
            print("[MODULE-DEPENDENCY] Invalid dependency type '".$dependencyType."'");
        }
    }

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