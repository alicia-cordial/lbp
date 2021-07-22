<?php

class Database
{
    public $username;
    public $password;
    public $hostname;
    public $dbname;
    public $pdo;

    public function __construct()
    {
        $this->username = 'huongmay';
        $this->hostname = 'localhost:3306';
        $this->dbname = 'huong-may-nguyen-phuoc_caveofwonders';
        $this->password = 'zapette27';
        $this->connexionDb();
    }

    public function connexionDb()
    {
        try {
            $this->pdo = new pdo('mysql:dbname='. $this->dbname .';host=' . $this->hostname . ';charset=UTF8',  $this->username , $this->password);
        } catch (Exception $e) {
            echo $e . "<br>";
        }
    }

    public function closeDb()
    {
        $this->pdo = null;
    }

    public function selectAll($table)
    {
        $query = $this->pdo->prepare("SELECT * from ". $table);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function findById($table, $id){
        $query = $this->pdo->prepare("SELECT * from ". $table ." WHERE id = ? ");
        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}