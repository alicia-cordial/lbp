<?php
//require_once('../controllers/shop/ResultatArticles.php');
require_once('Database.php');

class Shop extends Database{

 
  function resultatArticle($titre){
    if(isset($_GET['search'])){

      $search = htmlspecialchars($_GET['search']);
    
      $article = $this->pdo->query("SELECT * FROM article WHERE titre LIKE '%$search%'");
      $article->execute(array(':titre' => $titre));
      $articles = $article->fetch(PDO::FETCH_ASSOC);
   
      echo json_encode($articles, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

  }
}


}

//$model = new Shop();

//var_dump($model->resultatArticle($search));


