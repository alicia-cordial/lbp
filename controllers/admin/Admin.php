<?php


class Admin
{
    function __construct()
    {
        $title = "Admin";
        $css = ["admin.css", "compte.css"];
        $js = ["shop.js", "admin.js", "compte.js", "module.js"];
        ob_start();
        $this->selectMain();
        $main = ob_get_clean();

        $render = new View($title, $css, $main, $js);
    }

    public function selectMain()
    {
        //Si pas connecté
        if (!isset($_SESSION['user'])) {
            header('Location: compte');
        } else {
            //Si connecté en admin
            if ($_SESSION['user']['droit'] === "1") {
                require_once('views/admin/adminIndex.php');
                //Si connecté en vendeur
            } else {
                header('Location: compte');
            }
        }
    }

}