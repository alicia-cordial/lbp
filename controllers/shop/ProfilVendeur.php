<?php


class ProfilVendeur
{
    function __construct()
    {
        
        $title = "ProfilVendeur";
        $css = ["home.css"];
        $js = ["shop.js", "module.js" ];

        ob_start();
        require_once('views/shop/profilVendeur.php');
        $main = ob_get_clean();

        $render = new View($title, $css, $main, $js);
    }




}