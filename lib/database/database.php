<?php
/**
 * Plade
 * Database
 * Fabian Friedl
 * 25.04.2020
 * All rights reserved.
 */

/**
 * This class represents a database.
 */
class Database
{
    public string $Name;
    public string $Password;
    public string $Host;
    public string $Port;
    public string $User;

    /**
     * The default constructor of the database object.
     */
    function __construct(string $name, string $user, string $host, string $port, string $password)
    {
        $this->Name = $name;
        $this->Password = $password;
        $this->Host = $host;
        $this->User = $user;
        $this->Port = $port;
    }

    /**
     * This method is used to insert something into the database and get the last inserted index.
     * This is useful for single inserts where you want to get the last inserted index. (Auto Increment)
     */
    public function QueryInsert(string $query) : int
    {
        $result = -1;

        if ($query != "" && $query !== null)
        {
            $db = new mysqli($this->Host.":".$this->Port, $this->User, $this->Password, $this->Name);

            if ($db->connect_errno) {
                Logger::Log("Failed to connect with database (".mysqli_connect_errno()."): ".mysqli_connect_error(), $this);
                exit;
            }

            $db->query($query);

            $result = $db->insert_id;      
        }
        else
        {
            Logger::Log("The query was empty", $this);
        }        

        return $result;
    }

    /**
     * This method executes a query and returns the data as an array.
     */
    public function Query(string $query) : array
    {
        $result = array();

        if ($query != "" && $query !== null)
        {
            $db = new mysqli($this->Host.":".$this->Port, $this->User, $this->Password, $this->Name);

            if ($db->connect_errno) {
                Logger::Log("Failed to connect with database (".mysqli_connect_errno()."): ".mysqli_connect_error(), $this);
                exit;
            }

            $queryResult = $db->query($query);

            if (!is_bool($queryResult))
            {
                while ($obj = $queryResult->fetch_object())
                {
                    $result[] = $obj;
                }  
            }        
        }
        else
        {
            Logger::Log("The query was empty", $this);
        }        

        return $result;
    }

    /**
     * This function loads a single object from the database.
     * Returns null if could not be found.
     */
    public function SingleQuery(string $query) : ?object
    {
        $result = null;

        $queryResult = $this->Query($query);

        if (isset($queryResult[0]))
            $result = $queryResult[0];

        return $result;
    }
}

?>