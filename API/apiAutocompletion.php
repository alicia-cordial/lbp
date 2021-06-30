<?php
require_once ("apiAutoloader.php");
require_once('../models/Shop.php');

if (isset($_GET['term']) && !(empty($_GET['term']))) {
//    var_dump($_GET['term']);
    $model = new Shop();

    $term = htmlspecialchars($_GET['term']);
    $getArticle = $model->get_article($term);
    echo json_encode($getArticle, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
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