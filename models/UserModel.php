<?php

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

    public function selectVendeurArticles($id) {
        $request = $this->pdo->prepare("SELECT * FROM article AS art INNER JOIN utilisateur_article AS ua on art.id = id_article WHERE ua.id_vendeur = ? ");
        $request->execute([$id]);
        $articlesVendeur[] = $request->fetch(PDO::FETCH_ASSOC);
        return $articlesVendeur;
    }
}