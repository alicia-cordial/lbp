<?php

session_start();

//require_once('../../controllers/shop/ResultatArticles.php');
require_once('Database.php');

class Shop extends Database{


  

  function get_article($term){
  
  $request = $this->pdo->prepare("SELECT * FROM `article` where `titre` LIKE '%$term%' ORDER BY `titre` ASC");
  $request->execute([$term]);
  $articles[] = $request->fetchAll(PDO::FETCH_ASSOC);


return $articles;



  }

}
$model = new Shop();
var_dump($model->get_article('a'));


