<?php

require_once ("apiAutoloader.php");

if (isset($_POST['action']) && $_POST['action'] === 'showUsers') {
    $users = $adminModel->showUsers($_POST['choice']);
    if (!empty($users)) {
        echo json_encode($users, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode('none', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'deleteUser') {
    $suppr = $adminModel->deleteUser($_POST['id']);
    if ($suppr) {
        echo json_encode('suppressed', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'showModeration') {
    $articles = $adminModel->showModeration($_POST['choice']);
    if (!empty($articles)) {
        echo json_encode($articles, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode('none', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'deleteArticle') {
    $suppr = $adminModel->deleteArticle($_POST['id']);
    if ($suppr) {
        echo json_encode('suppressed', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'acceptArticleNewCat') {

    $success = $adminModel->acceptArticleNewCat($_POST['categoryName'], $_POST['id'], $_POST['idVendeur']);
    if ($success) {
        echo json_encode("success", JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode("fail", JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'acceptArticleSignal') {

    $success = $adminModel->acceptArticleSignal($_POST['id']);
    if ($success) {
        echo json_encode("success", JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode("fail", JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'selectCategories') {

    $categories = $adminModel->selectCategories();
    if (!empty($categories)) {
        echo json_encode($categories, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode("none", JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'showArticlesCategorie') {

    $articles = $adminModel->showArticlesCategorie($_POST['idCategory']);
    if (!empty($articles)) {
        echo json_encode($articles, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'updateCat') {

    $newCat = $adminModel->updateCat($_POST['idCategory'], $_POST['newName']);
    if ($newCat) {
        echo json_encode("success", JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'deleteCat') {
    $suppr = $adminModel->deleteCat($_POST['id']);
    if ($suppr) {
        echo json_encode('suppressed', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'addNewCat') {
    $add = $adminModel->createNewCategory($_POST['name']);
    if ($add != false) {
        echo json_encode($add, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode('same', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}