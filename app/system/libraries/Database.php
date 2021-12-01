<?php

namespace app\core\libraries;

use app\system\Controller;
use PDO;
use PDOException;

class Database
{

    /**
     * @var
     */
    private static $instance;

    public $connection;


    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Database();
            self::$instance->initConnection();
        }
        return self::$instance;
    }

    /**
     * Database Connection
     */
    private function initConnection()
    {
        try {
            // $controller->config('database');
            $link = new PDO("mysql:host=" . HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASS);
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->exec("SET CHARACTER SET utf8");
            $this->connection = $link;

        } catch (PDOException $exc) {
            die("Field to Connect with Database" . $exc->getMessage());
        }
    }
}