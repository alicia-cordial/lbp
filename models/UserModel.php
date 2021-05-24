<?php
require_once('../models/Database.php');

class UserModel extends Database
{
    public function userExists($email, $login)
    {
        $request = $this->pdo->prepare("SELECT * FROM utilisateur WHERE mail = ? OR identifiant = ?");
        $request->execute([$email, $login]);
        $userExists = $request->fetch(PDO::FETCH_ASSOC);
        return $userExists;
    }

    public function insertUser($status, $login, $zip, $email, $hashedpassword)
    {
        $request = $this->pdo->prepare("INSERT INTO utilisateur (identifiant, mdp, mail, status, zip) VALUES (:identifiant, :password, :email, :status, :zip)");
        $insert = $request->execute(array(
            ':status' => $status,
            ':email' => $email,
            ':password' => $hashedpassword,
            ':identifiant' => $login,
            ':zip' => $zip
        ));
        return $insert;
    }

    public function selectVendeurArticles($id)
    {
        $request = $this->pdo->prepare("SELECT * FROM article AS art INNER JOIN utilisateur_article AS ua on art.id = id_article WHERE ua.id_vendeur = ? AND art.status = 'disponible' ");
        $request->execute([$id]);
        $articlesVendeur = $request->fetchAll(PDO::FETCH_ASSOC);
        return $articlesVendeur;
    }

    public function selectVendeurArticlesSold($id)
    {
        $request = $this->pdo->prepare("SELECT * FROM article AS art INNER JOIN utilisateur_article as ua ON art.id = ua.id_article INNER JOIN utilisateur AS u ON art.id_acheteur = u.id WHERE ua.id_vendeur = ? AND art.status = 'vendu'  ");
        $request->execute([$id]);
        $articlesVendeur = $request->fetchAll(PDO::FETCH_ASSOC);
        return $articlesVendeur;
    }

    public function supprimerArticle($id)
    {
        $request = $this->pdo->prepare("DELETE FROM article WHERE id = ? ");
        $request->execute([$id]);
        return true;
    }

    public function marquerCommeVendu($idAcheteur, $id)
    {
        $request = $this->pdo->prepare("UPDATE article SET status = 'vendu', date_vente =". NOW() .", id_acheteur = ? WHERE id = ? ");
        $request->execute([$idAcheteur, $id]);
        return true;
    }
}


/*$model = new UserModel();
$articles = $model->selectVendeurArticles('1');
//var_dump($articles);
//echo json_encode($articles, JSON_PRETTY_PRINT);*/