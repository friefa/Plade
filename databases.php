<?php
/**
 * Plade
 * Databases
 * Fabian Friedl
 * 14.02.2021
 * All rights reserved.
 */

/**
 * This class is for security reasons the configuration file for the databases.
 */
abstract class Databases
{
    const Databases = array(
        "Test" => array(
            "Name" => "test", 
            "Host" => "127.0.0.1",
            "Port" => "3306",
            "User" => "root",
            "Password" => ""
            )
    );
}

?>