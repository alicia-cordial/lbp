<?php


class Autocompletion extends Database{

  function recherche(){



    // Afficher les résultats de recherche provenant du formulaire de l'index LIEN AVEC RECHERCHE
    if(isset($_GET['search'])){
    
      $search = $_GET['search'];
    
      $query = $this->pdo->query("SELECT * FROM article WHERE titre LIKE '%$search%'");
 
    }
    }


function getInfos(){
  $id = $_GET['id'];
  $req = $this->pdo->prepare(" SELECT * FROM article WHERE id = ':id' ");
  $req->execute(["id"=>":id"]);
  $article = $req->fetch();
  var_dump($id);
}




    function chargeBDD(){

      // Requête comparant le term avec les données de la bdd
      $term = $_GET["term"];
      
        $query = $this->pdo->query("SELECT titre FROM article WHERE titre LIKE '%$term%' LIMIT 8");
        $tableau = $query->fetchAll(PDO::FETCH_COLUMN, 0);
      
        echo json_encode($tableau);
      
      
      
      
      }
      







}