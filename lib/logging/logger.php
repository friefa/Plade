<?php
/**
 * Plade
 * Logger
 * Fabian Friedl
 * 25.04.2020
 * All rights reserved.
 */

// Implementations
include_once("lib/logging/logFile.php");

/**
 * This class represents a global logging interface.
 */
class Logger
{
    // Data fields
    private static object $LogFile;
    public static bool $Initialized = false;

    /**
     * This method initializes the global logger.
     */
    public static function Init(string $filename) : void
    {
        self::$LogFile = new LogFile(ApplicationConfig::$LogFile);
        self::$Initialized = true;
    }

    public static function Log(string $str, $class) : void
    {
        if (is_string($class))
        {
            $str = "<".$class."> ".$str;
        }
        else
        {
            $str = "<".get_class($class)."> ".$str;
        }  

        if (self::$Initialized)
        {
            self::$LogFile->Log($str);

            if (ApplicationConfig::$DebugMode)
                print($str."<br>");
        }
        else
        {
            print("[LOGGER-WARNING] Logger is not initialized correctly!");
        }
    }
}

?>