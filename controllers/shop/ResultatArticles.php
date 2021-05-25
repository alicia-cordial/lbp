<?php



class ResultatArticles
{


    

    function __construct()
    {

        
        $title = "ResultatArticle";
        $css = "home.css";

        ob_start();

     
        require_once ('views/shop/article.php');
        $main = ob_get_clean();

        $render = new View($title, $css, $main);
    }

   

        //ÇA MARCHE LIER À MODEL

}

