<?php


class Article
{
 
    function __construct()
    {

        
        $title = "Article";
        $css = "home.css";

        ob_start();

     
        require_once ('views/shop/article.php');
        $main = ob_get_clean();

        $render = new View($title, $css, $main);
    }



}