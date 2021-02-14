<?php
/**
 * Plade
 * DatabaseHandler
 * Fabian Friedl
 * 26.04.2020
 * All rights reserved.
 */

// Implementations
include_once("lib/database/database.php");

/**
 * This abstract class loads all databases from an array when initialized and makes them available.
 */
abstract class DatabaseHandler
{
    // Data fields
    public static array $Databases;

    /**
     * This method initializes all databases and makes them ready.
     */
    public static function Init(array $databases) : void
    {
        self::$Databases = array();

        foreach ($databases as $key => $value)
        {
            if (self::Valid($value))
            {
                self::$Databases[$key] = new Database($value["Name"], $value["User"], $value["Host"], $value["Port"], $value["Password"]);
            }
            else
            {
                Logger::Log("Invalid database definition in application configuration of '".$key."'", "DatabaseHandler");
            }            
        }
    }

    /**
     * This private method checks whether a database specification is valid.
     */
    private static function Valid(array $params) : bool
    {
        return isset($params["Name"], $params["User"], $params["Host"], $params["Port"], $params["Password"]);
    }
}

?>