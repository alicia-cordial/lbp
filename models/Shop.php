<?php

session_start();

//require_once('../../controllers/shop/ResultatArticles.php');
require_once('Database.php');

class Shop extends Database{


  

  function get_article($term){
  
  $request = $this->pdo->prepare("SELECT * FROM `article` where `titre` LIKE '%$term%' ORDER BY `titre` ASC");
  $request->execute([$term]);
  $articles[] = $request->fetchAll(PDO::FETCH_ASSOC);


return $articles;

  }

  function selectArticle($nom, $zip, $titre){
    $request = $this->pdo->prepare("SELECT $nom, $zip, $titre FROM `article` INNER JOIN `categorie` ON `article`.`id_categorie` = `categorie`.id INNER JOIN `utilisateur`ON `article`.`id_vendeur` = `utilisateur`.id");
    $request->execute();
    $result[] = $request->fetchAll(PDO::FETCH_ASSOC);

    return $result;
  }

  function selectSeller($status, $zip){
    $request = $this->pdo->prepare("SELECT $status, $zip FROM FROM utilisateur WHERE `status` LIKE 'vendeur'");
    $request->execute();
    $result[] = $request->fetchAll(PDO::FETCH_ASSOC);

    return $result;
  }


function get_onearticle($term1){
    $request = $this->pdo->prepare("SELECT * FROM article WHERE titre LIKE '%$term1%'");
    $request->execute([$term1]);
    $article_one[] = $request->fetchAll(PDO::FETCH_ASSOC);

    return $article_one;
}




  function get_articleCat($term){
    $request = $this->pdo->prepare("SELECT * FROM `article` INNER JOIN `categorie` ON `article`.`id_categorie` = `categorie`.id WHERE titre LIKE '%$term%'");
    $request->execute();
    $result_search[] = $request->fetchAll(PDO::FETCH_ASSOC);

    return $result_search;
  }


  function get_zip($zip){
    $request = $this->pdo->prepare("SELECT * FROM utilisateur INNER JOIN `article` ON `utilisateur`.`id` = `article`.id_vendeur WHERE zip LIKE '%$zip%'");
    $request->execute();
    $getzip[] = $request->fetchAll(PDO::FETCH_ASSOC);

    return $getzip;
  }


function get_seller($vendeur){
  $request = $this->pdo->prepare("SELECT `status` FROM utilisateur WHERE `status` LIKE '%$vendeur%'");
  $request->execute();
  $getseller[] = $request->fetchAll(PDO::FETCH_ASSOC);

  return $getseller;

}

function get_cat(){
  $request = $this->pdo->prepare("SELECT * FROM `categorie`");
  $request->execute();
  $getcat = $request->fetchAll(PDO::FETCH_ASSOC);
}

}
//$model = new Shop();
//var_dump($model->get_article('a'));


//ÇA MARCHE LIER À CONTROLLER