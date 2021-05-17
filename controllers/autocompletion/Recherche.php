<?php


class Recherche extends Home
{


    function __construct()
    {


        $model = new Autocompletion();
  
        $infos = $model->getInfos();
        $chargebdd = $model->chargeBdd();

        $title = "Recherche";
        $css = "home.css";

        ob_start();
        require_once ('views/autocompletion/recherche.php');

   
        $main = ob_get_clean();

        $render = new View($title, $css, $main);
    }


        


}