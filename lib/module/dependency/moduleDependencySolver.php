<?php
/**
 * Plade
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
    public function Solve(array $modules, &$addedDependencies = []) : string
    {
        $result = "";

        foreach ($modules as $module)
        {
            foreach ($module->ModuleConfig->Dependencies as $dependency)
            {
                if ($dependency->Type == ModuleDependencyType::Module)
                {
                    $_module = Module::GetByName($dependency->FileName, $modules);

                    if ($_module !== null)
                    {
                        $addedDependencies[] = $dependency->FileName;
                        $result .= $this->SolveLocal($_module, $modules, $addedDependencies);
                    }
                    else
                    {
                        Logger::Log("Failed to assign the module '".$dependency->FileName."'");
                    }
                }
            }

            foreach ($module->ModuleConfig->Dependencies as $dependency)
            {
                if (!in_array($dependency->FileName, $addedDependencies) && ($dependency->OwnedBy($module->ModuleConfig->Name) || $dependency->CDN))
                {
                    $result .= ModuleDependencyType::GetDependencyString($module->ModuleConfig->Name, $dependency) . PHP_EOL;
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
                    Logger::Log("Failed to solve dependency '".$dependency->FileName."'");
                }
            }
        }

        return $result;
    }

    /**
     * This function resolves all dependencies belonging to the module.
     * If a dependency could not be resolved, the function returns an error.
     */
    public function SolveLocal(object $targetModule, array $modules, array &$addedDependencies = []) : string 
    {
        $result = "";

        foreach ($targetModule->ModuleConfig->Dependencies as $dependency)
        {
            if ($dependency->Type == ModuleDependencyType::Module)
            {
                $module = Module::GetByName($dependency->FileName, $modules);

                if ($module !== null)
                {
                    $addedDependencies[] = $dependency->FileName;
                    $result .= $this->SolveLocal($module, $modules, $addedDependencies);
                }
                else
                {
                    Logger::Log("Failed to locally assign the module '".$dependency->FileName."'");
                }
            }
        }

        foreach ($modules as $module)
        {
            foreach ($module->ModuleConfig->Dependencies as $dependency)
            {
                if (!in_array($dependency->FileName, $addedDependencies) && ($dependency->OwnedBy($module->ModuleConfig->Name) || $dependency->CDN) && $targetModule->ModuleConfig->HasDependency($dependency))
                {
                    $result .= ModuleDependencyType::GetDependencyString($module->ModuleConfig->Name, $dependency) . PHP_EOL;
                    $addedDependencies[] = $dependency->FileName;
                }
            }
        }

        foreach ($targetModule->ModuleConfig->Dependencies as $dependency)
        {
            if (!in_array($dependency->FileName, $addedDependencies))
            {
                Logger::Log("Failed to solve local dependency '".$dependency->FileName."'");             
            }
        }

        return $result;
    }
}

?>