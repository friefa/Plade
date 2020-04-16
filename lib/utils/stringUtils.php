<?php

abstract class StringUtils
{
    public static function StartsWith($haystack, $needle) : bool
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

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