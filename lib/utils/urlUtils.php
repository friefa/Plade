<?php
/**
 * Plade
 * UrlUtils
 * Fabian Friedl
 * 23.04.2020
 * All rights reserved.
 */

 /**
  * This class represents useful methods to check and control urls.
  */
abstract class UrlUtils
{
    /**
     * This method checks whether a string represents a valid url.
     */
    public static function IsValid(string $url) : bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }
}

?>