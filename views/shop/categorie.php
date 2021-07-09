<?php

if (isset($_GET['id'])) {
    $model = new Shop();
    $id = htmlspecialchars($_GET['id']);
    $articles = $model->selectArticlesCategorie($id);

    if(!$articles) {
        header('location: home');
    }
    var_dump($articles);
}