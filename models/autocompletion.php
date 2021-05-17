<?php

class Autocompletion extends Database{


public function getInfos(){


$req = $this->pdo->prepare(" SELECT * FROM article WHERE id = ':id' ");
$req->execute(['id' => ':id' ]);
$article = $req->fetch(PDO::FETCH_ASSOC);
return $article;
var_dump($article);
}

public function chargeBdd(){
$term = $_GET["term"];

  $query = $this->pdo->query("SELECT titre FROM article WHERE titre LIKE '%$term%' LIMIT 8");
  $tableau = $query->fetchAll(PDO::FETCH_COLUMN, 0);

  echo json_encode($tableau);//ça marche


}

public function recherche(){
if(isset($_GET['search'])){

    $search = $_GET['search'];
  
    $query = $this->pdo->query("SELECT * FROM article WHERE titre LIKE '%$search%'");

}

}

}