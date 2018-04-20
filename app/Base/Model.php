<?php

namespace Base;

use Config;
use PDO;

abstract class Model
{
    static protected $conn = null;
    static protected $stmt = null;
    protected $table = '';
    protected $fields = [];
    protected $usersTable = 'users';
    protected $adsTable = 'ads';

    public function __construct()
    {
        if (self::$conn != null) {
            return;
        }

        try {
            $dbConfig = Config::getMysqlConfig();
            self::$conn = new PDO($dbConfig['dbType'] . ':host=' . $dbConfig['dbHost'] . ';dbname=' . $dbConfig['dbName'], $dbConfig['dbUser'], $dbConfig['dbPassword']);
            self::$conn->query('SET character_set_connection = "utf8";');
            self::$conn->query('SET character_set_client = "utf8";');
            self::$conn->query('SET character_set_results = "utf8";');
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $exc) {
            die($exc->getMessage());
        }
    }

    public function __destruct()
    {
    }
}

