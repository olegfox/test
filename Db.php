<?php

namespace App;

/**
 * Class Db
 */
class Db
{
    /**
     * @var
     */
    protected static $_instance;

    /**
     *
     * @return PDO
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            $dsn = 'mysql:charset=utf8;host='.Config::$dbHost.';port='.Config::$dbPort.';dbname='.Config::$dbName;
            self::$_instance = new \PDO($dsn, Config::$dbUser, Config::$dbPassword);
            self::$_instance->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            self::$_instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
        }
        return self::$_instance;
    }
}