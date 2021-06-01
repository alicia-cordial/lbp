<?php


class Admin
{
    function __construct()
    {
        $title = "Admin";
        $css = "admin.css";
        $js = ["admin.js"];
        ob_start();
        require_once('views/admin/adminIndex.php');
        $main = ob_get_clean();

        $render = new View($title, $css, $main, $js);
    }


}