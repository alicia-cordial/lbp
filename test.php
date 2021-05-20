<?php


require_once('models/Database.php');



if(isset($_GET['search'])){

    $search = htmlspecialchars($_GET['search']);
}
