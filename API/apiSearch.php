<?php

require_once('../models/Database.php');
require_once('../models/Shop.php');

//$model = new Shop();

  //RECHERCHE ARTICLES


  if (isset($_GET['term'])) {

    $model = new Shop();

    $term = htmlspecialchars($_GET['term']);
    $getArticle = $model->get_articleCat($term);
 
    echo json_encode($getArticle, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

  }


//RECHERCHE VENDEURS

if (isset($_GET['search']) ) {

  $model = new Shop();

  $search = htmlspecialchars($_GET['search']);
  $getUser = $model->get_seller($search);


  echo json_encode($getUser, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

}

/*********RECHERCHE PRÉCISE*/

 
if (isset($_GET['action']) && $_GET['action'] === 'Research') {
   $model = new Shop();
    $research = $model->Research($_GET['research']);
    if ($research) {
        echo json_encode($research, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
