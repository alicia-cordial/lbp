<?php

require_once('../models/Database.php');
require_once('../models/Shop.php');

//$model = new Shop();



//FORMULAIRE RECHERCHE PRÉCISE

if(isset($_POST['form'])){


  $model = new Shop();


  if(!empty($_POST['nom']) OR !empty($_POST['zip']) OR !empty($_POST['titre'])){
    $nom = htmlspecialchars($_POST['nom']);
    $zip = htmlspecialchars($_POST['zip']);
    $titre = htmlspecialchars($_POST['titre']);

    $objectExists = $model->selectObject($nom, $zip, $titre);
    $articleList = array();

    foreach($objectExists as $article){
      $articleList = $article;
    }


  }
  echo json_encode($articleList, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

}

  //RECHERCHE ARTICLES


  if (isset($_GET['term'])) {

    $model = new Shop();

    $term = htmlspecialchars($_GET['term']);
    $getArticle = $model->get_articleCat($term);
    $articleList = array();

    foreach($getArticle as $article){
      $articleList = $article;
    }
    echo json_encode($articleList, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

  }


//RECHERCHE VENDEURS

if (isset($_GET['search']) ) {

  $model = new Shop();

  $search = htmlspecialchars($_GET['search']);
  $getUser = $model->get_seller($search);
  
  $sellerList = array();
  foreach($getUser as $sellers){
    $sellerList = $sellers;
  }
  echo json_encode($sellerList, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  //require_once('../views/shop/profilVendeur.php');
}



if(isset($_GET['id'])){

  $model = new Shop();

  $id = htmlspecialchars($_GET['id']);
  $users = $model->showVendeur($id);
  //$IdList = array();

    require_once('../views/shop/profilVendeur.php');
    //header("Location: ../views/profilVendeur.php");
    //echo json_encode($showVendeur, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    
  }



/*
$id = $_GET['user'];
$request = $this->pdo->prepare("SELECT * FROM utilisateur INNER JOIN `article` ON utilisateur.id = article.id_vendeur WHERE `identifiant` LIKE '%$$id%'");
$request->execute();

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  echo $row["id"]. "\n";
 
  }
 } else {
  echo "0 results";
 }*/