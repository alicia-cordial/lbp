<?php

class Home
{
    function __construct()
    {

        $title = "Home";
        $css = ["home.css"];
        $js = ['shop.js', 'module.js'];

        ob_start();
        $model = new Shop();
        $articlesRandom = $model->selectArticlesRandom();
        require_once('views/home.php');
        $main = ob_get_clean();

        $render = new View($title, $css, $main, $js);
    }

}