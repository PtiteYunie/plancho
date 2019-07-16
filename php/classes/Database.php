<?php
require_once(".conf.php");


class Database
{
    private $pdo;
    private static $conn;

    private function __construct()
    {
        $conn = 'mysql:host='. DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME;
        $this->pdo = new PDO($conn,DB_USER,DB_PWD);
    }

    public static function getDatabase():Database
    {
        if (!isset(self::$conn)) {
            self::$conn = new Database();
        }
        return self::$conn;
    }

    public static function getDatabaseConnection(){

        if (!isset(self::$conn)) {
            self::$conn = new Database();
        }
        return self::$conn->pdo;
    }
}



