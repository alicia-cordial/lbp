<?php


class Routeur
{
//    tableau associatif des pages et de leurs controllers
    private $controllers = [
        "home" => "Home",
        "compte" => "Compte",
        "article" => "Article",
        "resultatArticles" => "ResultatArticles",
        "profilVendeur" => "ProfilVendeur",
        "admin" => "Admin",
        "categorie" => "Categorie",

    ];

//    controller sélectionné
    private $controller;


    public function __construct()
    {
        if (isset($_GET['r']) && key_exists($_GET['r'], $this->controllers)) {
            $this->controller = new $this->controllers[$_GET['r']]();
        } else {
            header('location: home');
            new Home();
        }
    }
}