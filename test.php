<?php
/*

require_once('models/Database.php');
require_once('models/Shop.php');

session_start();

$model = new Shop();

if(isset($_GET['search'])){

    $search = htmlspecialchars($_GET['search']);

    $model->resultatArticle($search);
}
