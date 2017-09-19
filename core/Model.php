<?php


namespace core;


abstract class Model
{
    protected $db;
    private $table;

    public function __construct($table)
    {
        $this->db = Db::instance()->pdo;
        $this->table = $table;

    }

    /**
     * Select data
     * @param $sql - query string
     * @return array
     *
     */
    public function query($sql)
    {
        $stmt = $this->db->prepare($sql);
        $res =  $stmt->execute();
        if ($res != false){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        return [];
    }


    /**
     * Select specific fields from table
     * @param array $fields
     * @return array
     */
    public function getAllItems(array $fields, array $desc = ['desc' => 'id'])
    {
        $fields = implode(',', $fields);
        $orderBy =reset($desc); //id
        $order = array_search($orderBy, $desc); //'desc'
        $order = strtoupper($order);
        $stmt = $this->db->prepare("SELECT $fields FROM $this->table ORDER BY $orderBy $order");
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}