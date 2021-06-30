<?php



class ResultatArticles
{


    

    function __construct()
    {

        
        $title = "Resultats";
        $css = ["home.css"];
        $js = ["shop.js"];
        ob_start();

     
      require_once ('views/shop/resultatArticles.php');
        $main = ob_get_clean();

        $render = new View($title, $css, $main, $js);
    }

   

        //ÇA MARCHE LIER À MODEL

}

