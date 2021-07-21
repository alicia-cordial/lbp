<?php
require_once ('apiAutoloader.php');


if (isset($_GET['term']) && !(empty($_GET['term']))) {
//    var_dump($_GET['term']);

    $term = htmlspecialchars($_GET['term']);
    $getArticle = $shopModel->get_article($term);
    echo json_encode($getArticle, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  }


  if (isset($_POST['action']) && $_POST['action'] === 'addReview') {
   
    $notes = $shopModel->addReview(htmlspecialchars($_POST['note']), htmlspecialchars($_POST['idArticle']), htmlspecialchars($_POST['idVendeur']), htmlspecialchars($_POST['visible']));
    if(!empty($notes)){
    echo json_encode($notes, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}


if (isset($_POST['action']) && $_POST['action'] === 'addReport') {
  
   $signal = htmlspecialchars($_POST['signal']);
   $idArticle = htmlspecialchars($_POST['idArticle']);
   $idUser = htmlspecialchars($_POST['idUser']);

  $signals = $shopModel-> addReport($signal, $idArticle, $idUser);
  if(!empty($signals)){
  echo json_encode($signals, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  }
}
