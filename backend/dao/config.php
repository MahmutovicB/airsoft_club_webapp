<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));


class Config {
    public static function DB_NAME() {
        return 'airsoft';
    }

    public static function DB_PORT() {
        return '8889';
    }

    public static function DB_USER() {
        return 'root';
    }

    public static function DB_PASSWORD() {
        return 'root';
    }

    public static function DB_HOST() {
        return 'localhost';
    }

    public static function JWT_SECRET() {
        return 'MySecretKey123#';
    }
}

class Database{
    private static $connection = null;

    public static function connect(){
        $connection = null;
        try{
            $connection = new PDO("mysql:host=" . Config::DB_HOST . ";port=" . Config::DB_PORT . ";dbname=" . Config::DB_NAME, Config::DB_USER, CONFIG::DB_PASSWORD);
            $connection->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $connection;
    }

    
 
}
?>