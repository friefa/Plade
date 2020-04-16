<?php

include_once("lib/module/moduleLoader.php");
include_once("lib/module/dependency/moduleDependencySolver.php");

class ModuleHandler
{
    private array $LoadedModules = array();

    public function Handle(array $params) : void
    {
        $dirs = array_diff(scandir("modules"), array('..', '.'));

        foreach ($dirs as $dirName)
        {
            if (is_dir("modules/".$dirName))
            {
                $loader = new ModuleLoader();
                $module = $loader->Load($dirName);
                $this->LoadedModules[$dirName] = $module;
            }
        }

        $moduleDependencySolver = new ModuleDependencySolver();
        $dependenciesString = $moduleDependencySolver->Solve($this->LoadedModules);
        
        $this->LoadedModules["headerModule"]->render(["%dependencies%" => $dependenciesString, "%title%" => "BABOOK"]);
    }
}

?>