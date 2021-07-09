<?php


class Categorie
{
    function __construct()
    {

        $title = "Categorie";
        $css = ["home.css"];
        $js = ["shop.js", "module.js" ];

        ob_start();
        require_once('views/shop/categorie.php');
        $main = ob_get_clean();

        $render = new View($title, $css, $main, $js);
    }
}