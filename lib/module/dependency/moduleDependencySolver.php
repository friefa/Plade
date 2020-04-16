<?php

class ModuleDependencySolver
{
    public function Solve(array $modules) : string
    {
        $result = "";
        $addedDependencies = array();

        foreach ($modules as $module)
        {
            foreach ($module->ModuleConfig->Dependencies as $dependency)
            {
                if (!in_array($dependency->FileName, $addedDependencies) && $dependency->OwnedBy($module->ModuleConfig->Name))
                {
                    $result .= ModuleDependencyType::GetDependencyString($dependency->Type, $module->ModuleConfig->Name, $dependency->FileName) . PHP_EOL;
                    $addedDependencies[] = $dependency->FileName;
                }
            }
        }

        foreach ($modules as $module)
        {
            foreach ($module->ModuleConfig->Dependencies as $dependency)
            {
                if (!in_array($dependency->FileName, $addedDependencies))
                {
                    print("[MODULE-DEPENDENCY-SOLVER] Failed to solve dependency '".$dependency->FileName."'!");
                }
            }
        }

        return $result;
    }
}

?>