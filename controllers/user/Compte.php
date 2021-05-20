<?php


class Compte
{
    function __construct()
    {
        $title = "Compte";
        $css = "compte.css";

        ob_start();
        $this->selectMain();
        $main = ob_get_clean();

        $render = new View($title, $css, $main);
    }

    public function selectMain()
    {
//        Si pas connecté
        if (!isset($_SESSION['user'])) {
            require_once('views/user/connexion.php');
        } else {
            if ($_SESSION['user']['status'] === 'vendeur') {
                require_once('views/user/vendeur.php');
            } else {
                require_once('views/user/client.php');
            }
        }
    }
}