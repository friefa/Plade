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
    public static function Init() : void
    {
        if (ApplicationConfig::$Initialized)
        {
            self::$LogFile = new LogFile(ApplicationConfig::$LogFile);
            self::$Initialized = true;
        }
        else
        {
            print("[LOGGER-WARNING] Application configuration is not initialized correctly!");
        }
    }

    /**
     * This method can be used globally to log errors.
     * If the DebugMode is turned on, this method also prints the errors on the page.
     */
    public static function Log(string $str) : void
    {
        $str = "<".get_called_class()."> ".$str;

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