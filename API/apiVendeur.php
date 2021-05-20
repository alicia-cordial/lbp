<?php
session_start();
require_once('../models/Database.php');
require_once('../models/UserModel.php');
$model = new UserModel();

if (isset($_POST['action']) && $_POST['action'] === 'articleSelling') {
    $articles = $model->selectVendeurArticles($_SESSION['user']['id']);
    echo json_encode($articles, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}