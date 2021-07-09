<?php
require_once ("apiAutoloader.php");

  //RECHERCHE ARTICLES
  if (isset($_GET['term'])) {
    $term = htmlspecialchars($_GET['term']);
    $getArticle = $shopModel->get_articleCat($term);
    echo json_encode($getArticle, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  }


//RECHERCHE VENDEURS
if (isset($_POST['search']) ) {
  $search = htmlspecialchars($_POST['search']);
  $getUser = $shopModel->get_seller($search);
  echo json_encode($getUser, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

}

/*********RECHERCHE PRÉCISE*/
if (isset($_GET['action']) && $_GET['action'] === 'Research') {
    $research = $shopModel->Research($_GET['research']);
    if ($research) {
        echo json_encode($research, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

/*selectArticlesCategory*/
/*if (isset($_POST['action']) && $_POST['action'] === 'selectArticlesCategory') {
    $articles = $shopModel->selectArticlesCategorie($_POST['idCategory']);
    if ($articles) {
        echo json_encode($articles, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}*/
