<?php

require_once('Database.php');

class Shop extends Database{

 
  function resultatArticle(){
  if(isset($_GET['article'])){
      //$article = (string) trim($_GET['article']);
      $article = $this->pdo->prepare(" SELECT * FROM article WHERE id = :id ",
      ['id' => $this->id]);
      $article->execute(); 
      $articles = $article->fetch(PDO::FETCH_ASSOC); 

    return $articles;

  }
  }

 
}

$model = new Shop();
var_dump($model->resultatArticle());


