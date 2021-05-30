<?php
require_once('Database.php');

class UserModel extends Database
{
    public function userExists($email, $login)
    {
        $request = $this->pdo->prepare("SELECT * FROM utilisateur WHERE mail = ? OR identifiant = ?");
        $request->execute([$email, $login]);
        $userExists = $request->fetchAll(PDO::FETCH_ASSOC);
        return $userExists;
    }

    public function userIsAvailable($email, $login, $id)
    {
        $numberLines = count($this->userExists($email, $login));

        if ($numberLines === 1) {
            $row = $this->userExists($email, $login);
            if ($row[0]['id'] === $id) {
                return true;
            } else {
                return false;
            }
        } elseif ($numberLines === 0) {
            return true;
        } else {
            return false;
        }
    }

    public function selectUserData($id)
    {
        $request = $this->pdo->prepare("SELECT * FROM utilisateur WHERE id = ?");
        $request->execute([$id]);
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

    public function updateUser($status, $login, $zip, $email, $hashedpassword, $id)
    {
        $request = $this->pdo->prepare("UPDATE utilisateur SET identifiant = :identifiant, mdp = :password, mail = :email, status = :status, zip = :zip WHERE id = $id ");
        $update = $request->execute(array(
            ':status' => $status,
            ':email' => $email,
            ':password' => $hashedpassword,
            ':identifiant' => $login,
            ':zip' => $zip
        ));
        return $update;
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

    public function selectVendeurContacts($id)
    {
        $request = $this->pdo->prepare("SELECT DISTINCT u.id, identifiant FROM utilisateur as u INNER JOIN message as m ON m.id_expediteur = u.id INNER JOIN utilisateur_message as um ON um.id_destinataire = ? WHERE u.id != $id");
        $request->execute([$id]);
        $contacts = $request->fetchAll(PDO::FETCH_ASSOC);
        return $contacts;
    }

    public function marquerCommeVendu($idAcheteur, $id)
    {
        $request = $this->pdo->prepare("UPDATE article SET status = 'vendu', date_vente ='" . date('Y-m-d H:i:s') . "', id_acheteur = ? WHERE id = ? ");
        $request->execute([$idAcheteur, $id]);
        $request2 = $this->pdo->prepare("UPDATE utilisateur_article SET id_client = ? WHERE id_article = ? ");
        $request2->execute([$idAcheteur, $id]);
        return true;
    }

    public function updateArticle($titre, $description, $prix, $etat, $categorie, $negociation, $id)
    {
        $request = $this->pdo->prepare("UPDATE article SET titre = ?, description = ?, prix = ?, etat_objet = ?, id_categorie = ?, ouvert_negociation = ? WHERE id = ?");
        $request->execute([$titre, $description, $prix, $etat, $categorie, $negociation, $id]);
        return true;
    }

    public function insertArticle($titre, $description, $prix, $etat, $categorie, $negociation, $idUser)
    {
        $request = $this->pdo->prepare("INSERT into article (titre, description, prix, etat_objet, id_categorie, ouvert_negociation, id_vendeur) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $request->execute([$titre, $description, $prix, $etat, $categorie, $negociation, $idUser]);
        $idArticle = $this->pdo->lastInsertId();
        $request2 = $this->pdo->prepare("INSERT into utilisateur_article (id_article, id_vendeur) VALUES (?, ?)");
        $request2->execute([$idArticle, $idUser]);
        return true;
    }

    public function insertArticleAModerer($titre, $description, $prix, $etat, $negociation, $catSuggeree, $idUser, $visible)
    {
        $request = $this->pdo->prepare("INSERT into article (titre, description, prix, etat_objet, ouvert_negociation, categorie_suggeree, id_vendeur, visible) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $request->execute([$titre, $description, $prix, $etat, $negociation, $catSuggeree, $idUser, $visible]);
        return true;
    }

    public function selectMessagesConversation($idDestinataire, $idUser)
    {
        $request = $this->pdo->prepare("SELECT * FROM message as m INNER JOIN utilisateur_message as um on id_message = m.id WHERE (id_expediteur = $idDestinataire AND id_destinataire = $idUser) OR (id_expediteur = $idUser AND id_destinataire = $idDestinataire)");
        $request->execute();
        $messages = $request->fetchAll(PDO::FETCH_ASSOC);
        return $messages;
    }
}

////
//$model = new UserModel();
//var_dump($model->selectMessagesConversation('4', '1'));
////var_dump($model->selectMessagesConversation('2', '1'));
//$userExists = $model->userExists('may5', 'may5');
//var_dump($userExists);
//if($model->userIsAvailable('may@hotmail.fr', 'may', '1')) echo "no";
//var_dump($model->userIsAvailable('may@hotmail.fr', 'may', '2'));
//var_dump($model->insertArticleAModerer('lala', 'lala', '40', 'bon état', 'non', 'kakak', '1', '0'));