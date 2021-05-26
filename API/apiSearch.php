<?php

require_once('../models/Database.php');
require_once('../models/Shop.php');

$model = new Shop();



/*INSCRIPTION*/
//if (isset($_POST['form']) && $_POST['form'] === 'objet') {
  if(isset($_POST['Submit'])){
  if (!empty($_POST['nom']) && !empty($_POST['zip']) && !empty($_POST['titre'])) {
      $nom = htmlspecialchars($_POST['nom']);
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
//}

/*CONNEXION*/
if (isset($_POST['form']) && $_POST['form'] === 'vendeur') {
  if(isset($_POST['Submit'])){
  if (!empty($_POST['seller']) && !empty($_POST['zip'])) {
      $status = htmlspecialchars($_POST['seller']);
      $zip = htmlspecialchars($_POST['zip']);
      $sellerExists = $model->selectSeller($status, $zip);

      if (!empty($sellerExists)) {
          
              session_start();
              $_SESSION['user'] = $userExists;
              $result = ['success'];
              echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
      } 
  }
}
}



if (isset($_GET['term'])) {
    //var_dump($_GET['term']);
    $model = new Shop();

    $term = htmlspecialchars($_GET['term']);
    $getArticle = $model->get_articleCat($term);
    $articleList = array();
    foreach($getArticle as $article){
      $articleList = $article;
    }
    echo json_encode($articleList, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

  }


if (isset($_GET['zip'])) {
    //var_dump($_GET['term']);
    $model = new Shop();

    $zip = htmlspecialchars($_GET['zip']);
    $getZip = $model->get_zip($zip);
    $zipList = array();
    foreach($getZip as $zip){
      $zipList = $zip;
    }
    echo json_encode($zipList, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

  }



if (isset($_GET['vendeur'])) {
  //var_dump($_GET['term']);
  $model = new Shop();

  $vendeur = htmlspecialchars($_GET['vendeur']);
  $getUser = $model->get_seller($vendeur);
  $sellerList = array();
  foreach($getUser as $seller){
    $sellerList = $seller;
  }
  echo json_encode($sellerList, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}