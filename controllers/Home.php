<?php


class Home
{
    function __construct()
    {
        
        $title = "Home";
        $css = "home.css";

        ob_start();
        require_once ('views/home.php');
        $main = ob_get_clean();

        $render = new View($title, $css, $main);
    }




}