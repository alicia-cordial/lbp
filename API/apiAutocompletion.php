<?php
require_once ('apiAutoloader.php');
require_once('../models/Shop.php');

if (isset($_GET['term']) && !(empty($_GET['term']))) {
//    var_dump($_GET['term']);
    $model = new Shop();

    $term = htmlspecialchars($_GET['term']);
    $getArticle = $model->get_article($term);
    echo json_encode($getArticle, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  }




  if (isset($_POST['action']) && $_POST['action'] === 'addReview') {
    $note = $model->addReview(htmlspecialchars($_POST['id_vendeur']), htmlspecialchars($_POST['note']), htmlspecialchars($_POST['id_article']));
    if(!empty($note)){
    echo json_encode($note, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}


