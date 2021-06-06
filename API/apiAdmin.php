<?php

session_start();
require_once('../models/Database.php');
require_once('../models/AdminModel.php');
$model = new AdminModel();


if (isset($_POST['action']) && $_POST['action'] === 'showUsers') {
    $users = $model->showUsers($_POST['choice']);
    if (!empty($users)) {
        echo json_encode($users, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode('none', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'deleteUser') {
    $suppr = $model->deleteUser($_POST['id']);
    if ($suppr) {
        echo json_encode('suppressed', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'showModeration') {
    $articles = $model->showModeration($_POST['choice']);
    if (!empty($articles)) {
        echo json_encode($articles, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode('none', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'deleteArticle') {
    $suppr = $model->deleteArticle($_POST['id']);
    if ($suppr) {
        echo json_encode('suppressed', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'acceptArticleNewCat') {

    $success = $model->acceptArticleNewCat($_POST['categoryName'], $_POST['id'], $_POST['idVendeur']);
    if ($success) {
        echo json_encode("success", JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode("fail", JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'acceptArticleSignal') {

    $success = $model->acceptArticleSignal($_POST['id']);
    if ($success) {
        echo json_encode("success", JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode("fail", JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'selectCategories') {

    $categories = $model->selectCategories();
    if (!empty($categories)) {
        echo json_encode($categories, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode("none", JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'showArticlesCategorie') {

    $articles = $model->showArticlesCategorie($_POST['idCategory']);
    if (!empty($articles)) {
        echo json_encode($articles, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'updateCat') {

    $newCat = $model->updateCat($_POST['idCategory'], $_POST['newName']);
    if ($newCat) {
        echo json_encode("success", JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'deleteCat') {
    $suppr = $model->deleteCat($_POST['id']);
    if ($suppr) {
        echo json_encode('suppressed', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'addNewCat') {
    $add = $model->createNewCategory($_POST['name']);
    if ($add) {
        echo json_encode($add, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}