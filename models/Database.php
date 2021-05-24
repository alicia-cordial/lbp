<?php

class Database
{
    public $username;
    public $pass;
    public $hostname;
    public $dbname;
    public $pdo;

    public function __construct()
    {
        $this->username = "root";
        $this->hostname = "localhost";
        $this->dbname = 'lbp';
        $this->connexionDb();
    }

    public function connexionDb()
    {
        try {
            $this->pdo = new pdo("mysql:dbname=lbp;host=localhost;charset=UTF8",'root','');
        }
        catch (Exception $e)
        {
            echo $e . "<br>";
        }
    }

    public function closeDb()
    {
        $this->pdo = null;
    }

    public function selectAll($table){
        $query = $this->pdo->prepare("SELECT * from `$table`");
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function findById($table,$id){
        $query = $this->pdo->prepare("SELECT * from '$table' WHERE id =:id");
        $query->execute(["id"=>$id]);
        $result = $query->fetchAll();
        return $result;
    }

}