<?php
/**
 * Plade
 * LoggingFile
 * Fabian Friedl
 * 25.04.2020
 * All rights reserved.
 */

/**
 * This class represents a log file.
 * The object can be used to log data.
 */
class LoggingFile
{
    // Data fields
    public string $FileName;

    /**
     * The object constructor of the class.
     * Here the object is initialized and the file is recreated if necessary.
     */
    function __construct(string $filename)
    {
        $this->FileName = $filename;

        if (!file_exists($filename))
        {
            file_put_contents($filename, $this->GetPrefix()."Logging file was created by application.".PHP_EOL);
        }
    }

    /**
     * This private method returns the standardized prefix of a log entry.
     */
    private function GetPrefix() : string
    {
        $ip = "unknown";

        if (isset($_SERVER["REMOTE_ADDR"]))
        {
            $ip = $_SERVER["REMOTE_ADDR"];
        }

        return date("[d.m.Y H:i:s::v] ".$ip.": ");
    }

    /**
     * This method is used to write a log entry to the log file.
     */
    public function Log(string $str) : void
    {
        file_put_contents($this->FileName, $this->GetPrefix().$str.PHP_EOL, FILE_APPEND);
    }
}

?>