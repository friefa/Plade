<?php
/**
 * Plade
 * ModuleMetaSolver
 * Fabian Friedl
 * 14.02.2021
 * All rights reserved.
 */

/**
 * This class solves the meta tags.
 */
class ModuleMetaSolver
{
    /**
     * This method initializes the meta tag.
     */
    public function Solve(array $tags) : string
    {
        $result = "";

        foreach ($tags as $tag)
        {
            if (ApplicationConfig::$DebugMode) $result .= "<!-- ".$tag->Name."-->".PHP_EOL;

            $result .= "<meta ";

            foreach ($tag->Content as $content)
            {
                $result .= $content->Key.'="'.$content->Value.'"';
            }

            $result .= ">".PHP_EOL;
        }

        return $result;
    }
}
?>