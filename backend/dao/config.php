<?php
class Database{
    private static $host = "localhost";
    private static $db_name = "airsoft";
    private static $username = "root";
    private static $password = "root";
    private static $connection = null;

    public static function connect(){
        $connection = null;
        try{
            $connection = new PDO("mysql:host=" . self::$host . ";port=8889;dbname=" . self::$db_name, self::$username, self::$password);
            $connection->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $connection;
    }
}
?>