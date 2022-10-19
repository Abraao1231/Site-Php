<?php

abstract class Connection
{
    private static $conn;
    public static function getConn(){
            self::$conn =  new PDO('mysql:host=localhost; dbname=sitephp', 'root', 'Abraao1231');           
        return self::$conn;

    }
}