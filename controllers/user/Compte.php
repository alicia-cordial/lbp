<?php

class Compte
{
    function __construct()
    {
        $title = "Compte";
        $css = "compte.css";
        $js = ['module.js', 'compte.js', 'vendeur.js', 'shop.js'];
        ob_start();
        $this->selectMain();
        $main = ob_get_clean();

        $render = new View($title, $css, $main, $js);
    }

    public function selectMain()
    {
        //Si pas connecté
        if (!isset($_SESSION['user'])) {
            require_once('views/user/connexion.php');
        } else {
            //Si connecté en admin
            if ($_SESSION['user']['droit'] === "1") {
                header('Location: admin');
                //Si connecté en vendeur
            } else if ($_SESSION['user']['status'] === 'vendeur') {
                require_once('views/user/vendeur.php');
                //Si connecté en acheteur
            } else if ($_SESSION['user']['status'] === 'client') {
                require_once('views/user/client.php');
            }
        }
    }
}
