<?php


class Home extends Routeur
{


    function __construct()
    {


        $model = new Autocompletion();
        $infos = $model->getInfos();
        $recherche = $model->recherche();
        $chargebdd = $model->chargeBdd();

        $title = "Home";
        $css = "home.css";

        ob_start();
        require_once ('views/home.php');

   
        $main = ob_get_clean();

        $render = new View($title, $css, $main);
    }


        


}