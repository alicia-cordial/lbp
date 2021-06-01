<?php

session_start();
require_once('../models/Database.php');
require_once('../models/UserModel.php');
$model = new UserModel();


if (isset($_POST['action']) && $_POST['action'] === 'selectArticlesAchetes') {
    $articles = $model->selectClientArticles($_SESSION['user']['id']);
    if (!empty($articles)) {
        echo json_encode($articles, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode('none', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}