<?php

require_once('../models/Database.php');
require_once('../models/Shop.php');

//$model = new Shop();



//FORMULAIRE RECHERCHE PRÉCISE


if (isset($_POST['form']) && $_POST['form'] === 'objet') {
 
  if (!empty($_POST['zip']) && !empty($_POST['titre'])) {
      $nom = htmlspecialchars($_POST['categorie']);
      $zip = htmlspecialchars($_POST['zip']);
      $titre = htmlspecialchars($_POST['titre']);
      $errors = [];
      $objectExists = $model->selectArticle($nom, $zip, $titre);
      

      if (!empty($objectExists)) {
              session_start();
              $result = ['success'];
              echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    
       }
   }
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
}