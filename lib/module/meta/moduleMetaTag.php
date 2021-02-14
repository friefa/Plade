<?php
/**
 * Plade
 * ModuleMetaType
 * Fabian Friedl
 * 14.02.2021
 * All rights reserved.
 */

/**
 * This class represents a module meta tag pair.
 */
class ModuleMetaTag
{
    public string $Key;
    public string $Value;

    /**
     * This method initializes the Module Meta Tag.
     */
    public function Init(string $key, string $value)
    {
        $this->Key = $key;
        $this->Value = $value;
    }
}
?>