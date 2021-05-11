<?php


class View
{
    function __construct($title, $css, $main)
    {
        require_once ('views/elements/head.php');
        require_once ('views/elements/header.php');
        echo $main;
        require_once ('views/elements/footer.php');
    }
}