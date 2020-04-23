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
    public static array $LoadedModules = array();

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
                self::$LoadedModules[$dirName] = $module;
            }
        }

        if (isset($params['module']) && isset(self::$LoadedModules[$params['module']]))
        {
            // Hier werden die Abhängigkeiten geladen.
                $moduleDependencySolver = new ModuleDependencySolver();
                $dependenciesString = $moduleDependencySolver->SolveLocal(self::$LoadedModules[$params['module']], self::$LoadedModules);
                $params = array_merge($params, ["%dependencies%" => $dependenciesString]);

                // Hier werden die Module angezeigt
                echo self::$LoadedModules["headerModule"]->render($params);
                echo self::$LoadedModules[$params['module']]->render($params);
                echo self::$LoadedModules["footerModule"]->render($params);
        }
        else 
        {
            print("[MODULE-HANDLER] Module not found!");
        }
    }        
}

?>