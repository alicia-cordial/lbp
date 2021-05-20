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
        $articles = $model->resultatArticle($this->search);
        require_once ('test.php');
        $main = ob_get_clean();

        $render = new View($title, $css, $main);
    }



}
$model = new Shop();

//var_dump($model->resultatArticle('a'));
