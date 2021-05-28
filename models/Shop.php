<?php

session_start();

require_once('Database.php');

class Shop extends Database{


  function selectArticle($nom, $zip, $titre){
    $request = $this->pdo->prepare("SELECT $nom, $zip, $titre FROM `article` INNER JOIN `categorie` ON `article`.`id_categorie` = `categorie`.id INNER JOIN `utilisateur`ON `article`.`id_vendeur` = `utilisateur`.id");
    $request->execute();
    $result[] = $request->fetchAll(PDO::FETCH_ASSOC);

    return $result;
  }


  function get_article($term){
  
    $request = $this->pdo->prepare("SELECT * FROM `article` where `titre` LIKE '%$term%' ORDER BY `titre` ASC");
    $request->execute([$term]);
    $articles[] = $request->fetchAll(PDO::FETCH_ASSOC);
  
  
  return $articles;
  
    }


    function get_articleCat($term){
      $request = $this->pdo->prepare("SELECT `titre`, `nom` FROM `article` INNER JOIN `categorie` ON `article`.`id_categorie` = `categorie`.id WHERE titre LIKE '%$term%'");
      $request->execute([$term]);
      $result_search[] = $request->fetchAll(PDO::FETCH_ASSOC);
  
      return $result_search;
  
    }

  function get_seller($search){
    $request = $this->pdo->prepare("SELECT identifiant, utilisateur.status FROM utilisateur INNER JOIN `article` ON utilisateur.id = article.id_vendeur WHERE `identifiant` LIKE '%$search%'");
    $request->execute();
    $getseller[] = $request->fetchAll(PDO::FETCH_ASSOC);

    return $getseller;

  }

function get_cat(){
  $request = $this->pdo->prepare("SELECT * FROM `categorie`");
  $request->execute();
  $getcat[] = $request->fetchAll(PDO::FETCH_ASSOC);
}



function price_range(){
  $query = $this->pdo->prepare("SELECT * FROM article ORDER BY prix DESC");
  $query->execute();
  $price[] = $query->fetchAll(PDO::FETCH_ASSOC);
  
  return $price;

  }

}
//$model = new Shop();
//var_dump($model->get_seller('alicia'));


//ÇA MARCHE LIER À CONTROLLER