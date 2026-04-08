<?php

class Database
{
    public static function connect()
    {
        return new PDO(
            "mysql:host=localhost;dbname=adote_aqui;charset=utf8",
            "root",
            "root"
        );
    }
}