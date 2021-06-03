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

  foreach($getUser as $user){
    $sellerList = $user;
  }
  echo json_encode($sellerList, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

}


