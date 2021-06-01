<?php

require_once('../models/Database.php');
require_once('../models/Shop.php');

if (isset($_GET['term'])) {
    //var_dump($_GET['term']);
    $model = new Shop();

    $term = htmlspecialchars($_GET['term']);
    $getArticle = $model->get_article($term);
    $articleList = array();
    foreach($getArticle as $article){
      $articleList = $article;
    }
    echo json_encode($articleList, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

  }




  if(isset($_GET['titre'])){
    $model = new Shop();

    $titre = htmlspecialchars($_GET['titre']);
    $getOnearticle = $model->get_oneArticle($titre);
    $listArticle = array();
    foreach($getOnearticle as $oneArticle){
      $listArticle = $oneArticle;
    }
    echo json_encode($listArticle, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  }

/*
  if(isset($_GET['searchone'])){

    $model = new Shop();

    $search_one = htmlspecialchars($_GET['searchone']);
    $getOnearticle = $model->get_onearticle($search_one);
    if (!empty($getOnearticle)) {
        echo json_encode($getOnearticle, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode('none', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

  }*/