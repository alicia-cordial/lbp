<?php


class Autocompletion extends Routeur{


function getInfos(){
    $id = $_GET['id'];
    $req = $this->pdo->prepare(" SELECT * FROM article WHERE id = '$id' ");
    $req->execute();
    $article = $req->fetch();
}




    function chargeBDD(){

// Requête comparant le term avec les données de la bdd
$term = $_GET["term"];

try
{

  $query = $this->pdo->query("SELECT titre FROM article WHERE titre LIKE '%$term%' LIMIT 8");
  $tableau = $query->fetchAll(PDO::FETCH_COLUMN, 0);

  echo json_encode($tableau);

}
catch(Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

}


function recherche(){

// Afficher les résultats de recherche provenant du formulaire de l'index
if(isset($_GET['search'])){

  $search = $_GET['search'];

  $query = $this->pdo->query("SELECT * FROM article WHERE titre LIKE '%$search%'");

}else{
    header('Location:home.php');
  }

}

}