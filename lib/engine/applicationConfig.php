<?php
/**
 * Plade
 * ApplicationConfig
 * Fabian Friedl
 * 23.04.2020
 * All rights reserved.
 */

/**
 * This class globally represents all application settings of the engine.
 */
class ApplicationConfig
{
    // Data fields
    public const CONFIG_FILE = "appconfig.json";
    public static bool $Initialized = false;
    public static string $EngineVersion;
    public static string $EntryModule;
    public static bool $DebugMode;
    public static bool $IpLogging;
    public static string $LogFile;
    public static array $Replacements;

    /**
     * This static method is used to load and initialize the application configuration.
     */
    public static function Init() : void
    {
        if (file_exists(self::CONFIG_FILE))
        {
            $raw = file_get_contents(self::CONFIG_FILE);
            $json = json_decode($raw, true);

            if (self::ValidateJsonArray($json))
            {
                self::$EngineVersion = $json['EngineVersion'];
                self::$EntryModule = $json['EntryModule'];
                self::$DebugMode = filter_var($json['DebugMode'], FILTER_VALIDATE_BOOLEAN);
                self::$LogFile = $json['LogFile'];
                self::$IpLogging = filter_var($json["IpLogging"], FILTER_VALIDATE_BOOLEAN);
                self::$Replacements = $json['Replacements'];

                $buffer = array();

                foreach(self::$Replacements as $key => $value)
                {
                    $buffer['%'.$key.'%'] = $value;
                }

                self::$Replacements = $buffer;

                self::$Initialized = true;
            }
            else
            {
                print("[APPLICATION-CONFIG] Configuration file is invalid!");
            }
        }
        else
        {
            print("[APPLICATION-CONFIG] Configuration file was not found!");
        }
    }

    /**
     * This private static method checks if the given array is a valid configuration.
     */
    private static function ValidateJsonArray(array $arr) : bool
    {
        return isset($arr['EngineVersion'], $arr['EntryModule'], $arr['DebugMode'], $arr['Replacements'], $arr['LogFile'], $arr["IpLogging"]);
    }
}

?>