<?php
require_once('../../models/Shop.php');

class ResultatArticles
{
    function __construct()
    {

        
        $title = "ResultatArticle";
        $css = "home.css";

        ob_start();

        $model = new Shop();
        $main = ob_get_clean();
        $this->resultatArticle();
        $render = new View($title, $css, $main);
    }

    public function resultatArticle(){
  
        if (!isset($_GET['term'])) {
            $model = new Shop();

            $term = htmlspecialchars($_GET['term']);
            $getArticle = $model->get_article($term);
            $articleList = array();
            foreach($getArticle as $article){
              $articleList[] = $article['titre'];
            }
      
            echo json_encode($articleList, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            require_once('models/shop/resultatArticles.php');

          }

        } 

}




