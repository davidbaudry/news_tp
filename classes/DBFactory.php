<?php


class DBFactory
{

    public static function getPDOConnection()
    {
        $database = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.'', DB_HOST, '');
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $database;
    }

    public static function getMySqliConnection()
    {
        return new MySQLi(DB_HOST, DB_HOST, '', DB_NAME);
    }
}