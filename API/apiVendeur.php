<?php
session_start();
require_once('../models/Database.php');
require_once('../models/UserModel.php');
$model = new UserModel();

if (isset($_POST['action']) && $_POST['action'] === 'articlesSelling') {
    $articles = $model->selectVendeurArticles($_SESSION['user']['id']);
    if (!empty($articles)) {
        echo json_encode($articles, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode('none', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
} elseif (isset($_POST['action']) && $_POST['action'] === 'articlesSold') {
    $articles = $model->selectVendeurArticlesSold($_SESSION['user']['id']);
    if (!empty($articles)) {
        echo json_encode($articles, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode('none', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
} elseif (isset($_POST['action']) && $_POST['action'] === 'supprimerArticle') {
    $suppr = $model->supprimerArticle($_POST['id']);
    if ($suppr) {
        echo json_encode('suppressed', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}