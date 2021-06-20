<?php

require_once("apiAutoloader.php");

if (isset($_POST['action']) && $_POST['action'] === 'articlesSelling') {
    $articles = $userModel->selectVendeurArticles($_SESSION['user']['id']);
    if (!empty($articles)) {
        echo json_encode($articles, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode('none', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'articlesSold') {
    $articles = $userModel->selectVendeurArticlesSold($_SESSION['user']['id']);
    if (!empty($articles)) {
        echo json_encode($articles, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode('none', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
if (isset($_POST['action']) && $_POST['action'] === 'supprimerArticle') {
    $suppr = $userModel->supprimerArticle($_POST['id']);
    if ($suppr) {
        echo json_encode('suppressed', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'marquerCommeVendu') {
    $vendu = $userModel->marquerCommeVendu($_POST['idAcheteur'], $_POST['idArticle']);
    if ($vendu) {
        echo json_encode('vendu', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'afficherDetails') {
    $article = $userModel->findById('article', $_POST['idArticle'])[0];
    $categories = $userModel->selectAll('categorie');
    $etats = ['neuf', 'très bon état', 'bon état'];
    require_once('../views/user/updateArticle.php');

}

if (isset($_POST['form']) && $_POST['form'] === 'updateArticle') {
    if (!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['prix']) && !empty($_POST['etat']) && !empty($_POST['categorie']) && !empty($_POST['negociation'])) {
        $titre = htmlspecialchars($_POST['titre']);
        $description = htmlspecialchars($_POST['description']);
        $prix = htmlspecialchars($_POST['prix']);
        $etat = htmlspecialchars($_POST['etat']);
        $categorie = htmlspecialchars($_POST['categorie']);
        $negociation = htmlspecialchars($_POST['negociation']);
        $update = $userModel->updateArticle($titre, $description, $prix, $etat, $categorie, $negociation, $_POST['idArticle']);
        echo json_encode('success', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode('Veuillez remplir tous les champs SVP', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'afficherNewArticle') {
    if (count($userModel->selectVendeurArticles($_SESSION['user']['id'])) >= 5) {
        echo 'maximum';
    } else {
        $categories = $userModel->selectAll('categorie');
        $etats = ['neuf', 'très bon état', 'bon état'];
        require_once('../views/user/vendeurNewArticle.php');
    }

}

if (isset($_POST['form']) && $_POST['form'] === 'newArticle') {
    if (!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['prix']) && !empty($_POST['etat']) && !empty($_POST['negociation']) && !empty($_POST['categorie'])) {
        $titre = htmlspecialchars($_POST['titre']);
        $description = htmlspecialchars($_POST['description']);
        $prix = htmlspecialchars($_POST['prix']);
        $etat = htmlspecialchars($_POST['etat']);
        $categorie = htmlspecialchars($_POST['categorie']);
        $negociation = htmlspecialchars($_POST['negociation']);
        if (empty($_POST['catSuggeree'])) {
            $insert = $userModel->insertArticle($titre, $description, $prix, $etat, $categorie, $negociation, $_SESSION['user']['id']);
            echo json_encode('success', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } else {
            $catSuggeree = htmlspecialchars($_POST['catSuggeree']);
            $visible = 0;
            $insert = $userModel->insertArticleAModerer($titre, $description, $prix, $etat, $negociation, $catSuggeree, $_SESSION['user']['id'], $visible);
            echo json_encode('moderation', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    } else {
        echo json_encode('Veuillez remplir tous les champs SVP', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}