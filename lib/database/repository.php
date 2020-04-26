<?php
/**
 * Plade
 * DatabaseEntity
 * Fabian Friedl
 * 25.04.2020
 * All rights reserved.
 */

/**
 * This class represents the interface between the database and the objects.
 */
abstract class Repository
{
    // Data fields
    private object $Database;

    /**
     * The standard constructor initializes the given database.
     */
    function __construct(object $database)
    {
        $this->Database = $database;
    }

    // Abstract implementations
    public abstract function Add(object $obj);

    public abstract function Delete(object $obj);

    public abstract function Update(object $obj);

    public abstract function Load(object $obj);

    public abstract function LoadAll();

    public abstract function LoadWhere(object $obj);
}

?>