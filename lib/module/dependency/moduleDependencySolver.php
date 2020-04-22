<?php
/**
 * BABOOK
 * ModuleDependencySolver
 * Fabian Friedl
 * 19.04.2020
 * All rights reserved.
 */


/**
 * This object resolves dependencies between modules.
 */
class ModuleDependencySolver
{
    /**
     * This function resolves all dependencies of all modules.
     * If a dependency could not be resolved, an error is displayed.
     */
    public function Solve(array $modules) : string
    {
        $result = "";
        $addedDependencies = array();

        foreach ($modules as $module)
        {
            foreach ($module->ModuleConfig->Dependencies as $dependency)
            {
                if (!in_array($dependency->FileName, $addedDependencies) && ($dependency->OwnedBy($module->ModuleConfig->Name) || $dependency->CDN))
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

    /**
     * This function resolves all dependencies belonging to the module.
     * If a dependency could not be resolved, the function returns an error.
     */
    public function SolveLocal(object $targetModule, array $modules) : string 
    {
        $result = "";
        $addedDependencies = array();

        foreach ($modules as $module)
        {
            foreach ($module->ModuleConfig->Dependencies as $dependency)
            {
                if (!in_array($dependency->FileName, $addedDependencies) && ($dependency->OwnedBy($module->ModuleConfig->Name) || $dependency->CDN) && $targetModule->ModuleConfig->HasDependency($dependency))
                {
                    $result .= ModuleDependencyType::GetDependencyString($dependency->Type, $module->ModuleConfig->Name, $dependency->FileName) . PHP_EOL;
                    $addedDependencies[] = $dependency->FileName;
                }
            }
        }

        foreach ($targetModule->ModuleConfig->Dependencies as $dependency)
        {
            if (!in_array($dependency->FileName, $addedDependencies))
            {
                print("[MODULE-DEPENDENCY-SOLVER] Failed to solve local dependency '".$dependency->FileName."'!");
            }
        }

        return $result;
    }
}

?>