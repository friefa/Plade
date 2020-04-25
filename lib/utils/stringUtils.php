<?php
/**
 * Plade
 * StringUtils
 * Fabian Friedl
 * 19.04.2020
 * All rights reserved.
 */


/**
 * This class provides useful additional functions for character strings.
 */
abstract class StringUtils
{
    /**
     * This function checks if a string starts with a specific character string.
     */
    public static function StartsWith($haystack, $needle) : bool
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    /**
     * This function checks if a string ends with a specific character string.
     */
    public static function EndsWith($haystack, $needle) : bool
    {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }
}

?>