<?php
/**
 * BABOOK
 * ModuleHandler
 * Fabian Friedl
 * 19.04.2020
 * All rights reserved.
 */

// Implementations
include_once("lib/module/moduleLoader.php");
include_once("lib/module/dependency/moduleDependencySolver.php");

/**
 * This object handles all modules using given parameters.
 */
class ModuleHandler
{
    // Data fields
    private array $LoadedModules = array();

    /**
     * This method handles all modules using given parameters.
     * This method is considered the starting point for the Modular System and organizes and manages the modules and their representation.
     */
    public function Handle(array $params) : void
    {
        $dirs = array_diff(scandir("modules"), array('..', '.'));

        // All modules from the modules folder will be loaded here.
        foreach ($dirs as $dirName)
        {
            if (is_dir("modules/".$dirName))
            {
                $loader = new ModuleLoader();
                $module = $loader->Load($dirName);
                $this->LoadedModules[$dirName] = $module;
            }
        }

        // Hier werden die Abhängigkeiten geladen.
        $moduleDependencySolver = new ModuleDependencySolver();
        $dependenciesString = $moduleDependencySolver->SolveLocal($this->LoadedModules["dashboard"], $this->LoadedModules);
        $params = array_merge($params, ["%dependencies%" => $dependenciesString, "%title%" => "BABOOK"]);

        // Hier werden die Module angezeigt
        $this->LoadedModules["headerModule"]->render($params);
        $this->LoadedModules["dashboard"]->render($params);
        $this->LoadedModules["footerModule"]->render($params);
    }
}

?>