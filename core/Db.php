<?php


namespace core;


class Db
{
    protected static $instance = null;
    protected $dns = DNS;
    public $pdo;

    protected function __construct()
    {
        try{
            $this->pdo = new \PDO($this->dns);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch (\PDOException $e){
            die ('DB Error');
        }
    }

    public static function instance()
    {
        if(self::$instance === null){
            self::$instance = new Db();
        }
        return self::$instance;
    }
}