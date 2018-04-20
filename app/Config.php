<?php
class Config
{
    private static $mysqldbHost = 'localhost';
    private static $mysqldbName = 'dbName';
    private static $mysqldbUser = 'user';
    private static $mysqldbPassword = 'password';

    public static function getMysqlConfig()
    {
        return array(
            "dbHost" => self::$mysqldbHost,
            "dbName" => self::$mysqldbName,
            "dbUser" => self::$mysqldbUser,
            "dbPassword" => self::$mysqldbPassword,
            "dbType" => "mysql"
        );
    }
}
