<?php


class Routeur
{
    private $controllers = [
        "home" => "Home",
        "compte" => "Compte"
    ];

    private $controller;

    public function __construct()
    {
        if(isset($_GET['r']) && key_exists($_GET['r'], $this->controllers)) {
            $this->controller = new $this->controllers[$_GET['r']]();
        } else {
            header('location: index.php?r=home');
            new Home();
        }
    }
}