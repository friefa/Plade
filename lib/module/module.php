<?php

abstract class Module {
    public $ModuleConfig;

    abstract protected function render(array $params);
}

?>