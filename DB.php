<?php
namespace DB;
// Creates DB connector class
class DatabaseConnector
{

    private $dbConnection = null;

    public function __construct()
    {
        // Uses .ENV to get values
        $host = 'localhost';
        $db   = 'cmp332_movies';
        $username   = 'root';

        try {
            // Creates a new PDO for mysql connection
            $this->dbConnection = new \PDO(
                "mysql:host=$host;charset=utf8mb4;dbname=$db",
                $username,
            );
            // If error exit with error message
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->dbConnection;
    }
}
