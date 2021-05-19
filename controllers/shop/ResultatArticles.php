<?php


class ResultatArticles
{
    function __construct()
    {

        $model = new Shop();
        $result= $model->resultatArticle();
        
        $title = "ResultatArticle";
        $css = "home.css";

        ob_start();
        require_once ('views/shop/resultatArticles.php');
        $main = ob_get_clean();

        $render = new View($title, $css, $main);
    }




}

$model = new Shop();

