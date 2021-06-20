<?php

require_once ("apiAutoloader.php");

if (isset($_POST['action']) && $_POST['action'] === 'selectArticlesAchetes') {
    $articles = $userModel->selectClientArticles($_SESSION['user']['id']);
    if (!empty($articles)) {
        echo json_encode($articles, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode('none', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}