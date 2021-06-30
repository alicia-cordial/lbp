<?php

require_once('../models/Database.php');
require_once('../models/Shop.php');

//$model = new Shop();

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

if (isset($_POST['search']) ) {

  $model = new Shop();

  $search = htmlspecialchars($_POST['search']);
  $getUser = $model->get_seller($search);
  echo json_encode($getUser, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

}

/*********RECHERCHE PRÉCISE*/

 
if (isset($_GET['research']) ) {

  $model = new Shop();

  $research = htmlspecialchars($_GET['research']);
  $getArticle = $model->get_seller($research);
  $articleList = array();

  foreach($getArticle as $article){
    $articleList = $article;
  }
  echo json_encode($articlerList, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

}
