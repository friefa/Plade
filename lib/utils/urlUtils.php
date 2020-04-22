<?php

abstract class UrlUtils
{
    public static function IsValid(string $url) : bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }
}

?>