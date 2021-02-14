<?php
/**
 * Plade
 * ModuleMeta
 * Fabian Friedl
 * 14.02.2021
 * All rights reserved.
 */

// Implementations
include_once('lib/module/meta/moduleMetaTag.php');

/**
 * This module represents a meta tag for a specific module.
 */
class ModuleMeta
{
    // Data fields
    public string $Name;
    public array $Content;

    /**
     * This method initializes the meta tag.
     */
    public function Init(string $name, array $content)
    {
        $this->Name = $name;
        $this->Content = $content;
    }
}
?>