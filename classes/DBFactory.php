<?php


class DBFactory
{

    public static function getPDOConnection()
    {
        $connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';',
            DB_USER, DB_PASS);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    }

    public static function getMySqliConnection()
    {
        return new MySQLi(DB_HOST, DB_HOST, '', DB_NAME);
    }
}