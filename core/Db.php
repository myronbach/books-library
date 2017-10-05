<?php


namespace core;


class Db
{
    protected static $instance = null;
    public $pdo;
    protected $dsn;
    protected $username = '';
    protected $password = '';

    protected function __construct()
    {
        $driver = DB;
        $paramsPath = ROOT.'/config/database.php';
        $params = include $paramsPath;
        $db = $params[$driver];
        switch ($driver){
            case 'mysql':
                $this->dsn = "{$db['driver']}:host={$db['host']};dbname={$db['dbname']}";
                $this->username = $db['user'];
                $this->password = $db['password'];
                break;
            case 'sqlite':
                $this->dsn = "{$db['driver']}:{$db['database']}";
        }
        //debug($db);
        //die();

        try{
            $this->pdo = new \PDO($this->dsn, $this->username, $this->password);
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