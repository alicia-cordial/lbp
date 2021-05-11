<?php


class Home
{
    function __construct()
    {
        $title = "Home";
        $css = "home.css";

        ob_start();
        require_once ('views/home.php');
        require_once ('views/autocompletion/element.php');
        require_once ('views/autocompletion/recherche.php');
        $main = ob_get_clean();

        $render = new View($title, $css, $main);
    }




}