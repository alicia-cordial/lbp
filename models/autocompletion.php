<?php


class Autocompletion extends Database{

    function chargeBDD(){

// Requête comparant le term avec les données de la bdd
$term = $_GET["term"];

try
{

  $query = $this->pdo->query("SELECT nom FROM article WHERE titre LIKE '%$term%' LIMIT 8");
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

  $query = $this->pdo->query("SELECT * FROM philosophes WHERE nom LIKE '%$search%'");

}else{
    header('Location:index.php');
  }

}

}