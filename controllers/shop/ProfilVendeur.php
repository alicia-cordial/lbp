<?php


class ProfilVendeur
{
    function __construct()
    {
        
        $title = "ProfilVendeurs";
        $css = "home.css";
        $js = ["shop.js" ];

        ob_start();
        require_once ('views/shop/profilVendeur.php');
        $main = ob_get_clean();

        $render = new View($title, $css, $main, $js);
    }




}