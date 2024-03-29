<?php
require_once('Database.php');

class UserModel extends Database
{
    public function userExists($email, $login)
    {
        $request = $this->pdo->prepare("SELECT * FROM utilisateur WHERE mail = ? OR identifiant = ?");
        $request->execute([$email, $login]);
        $userExists = $request->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($userExists)) {
            return $userExists;
        } else {
            return false;
        }
    }

    public function userIsAvailable($email, $login, $id)
    {
        $rows = $this->userExists($email, $login);
        if (!($rows)) {
            return true;
        } else {
            if (count($rows) === 1) {
                if ($rows[0]['id'] === $id) {
                    return true;
                }
            } else {
                return false;
            }
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
        $request = $this->pdo->prepare("SELECT *, DATE_FORMAT(date_ajout, '%b %d, %Y') as date FROM article AS art WHERE art.status = 'disponible' AND id_vendeur = ? ");
        $request->execute([$id]);
        $articlesVendeur = $request->fetchAll(PDO::FETCH_ASSOC);
        return $articlesVendeur;
    }


    public function selectVendeurArticlesSold($id)
    {
        $request = $this->pdo->prepare("SELECT *, DATE_FORMAT(date_vente, '%b %d, %Y') as date FROM article AS art INNER JOIN utilisateur_article as ua ON art.id = ua.id_article INNER JOIN utilisateur AS u ON art.id_acheteur = u.id WHERE ua.id_vendeur = ? AND art.status = 'vendu'  ");
        $request->execute([$id]);
        $articlesVendeur = $request->fetchAll(PDO::FETCH_ASSOC);
        return $articlesVendeur;
    }

    public function selectClientArticles($id)
    {
        $request = $this->pdo->prepare("SELECT * FROM article AS art INNER JOIN utilisateur_article as ua ON art.id = ua.id_article INNER JOIN utilisateur AS u ON art.id_vendeur = u.id WHERE ua.id_client = ? AND art.status = 'vendu'  ");
        $request->execute([$id]);
        $articlesClient = $request->fetchAll(PDO::FETCH_ASSOC);
        return $articlesClient;
    }

    public function supprimerArticle($id)
    {
        $request = $this->pdo->prepare("DELETE FROM article WHERE id = ? ");
        $request->execute([$id]);
        return true;
    }

    public function selectContacts($id)
    {
        $request = $this->pdo->prepare("SELECT DISTINCT utilisateur.identifiant, utilisateur.id, utilisateur.status, UPPER(SUBSTRING(`identifiant`, 1, 1)) as initial FROM utilisateur JOIN message INNER JOIN utilisateur_message on utilisateur_message.id_message = message.id WHERE (id_expediteur = $id AND id_destinataire = utilisateur.id) OR (id_destinataire = $id AND id_expediteur = utilisateur.id) AND utilisateur.id != $id");
        $request->execute();
        $contacts = $request->fetchAll(PDO::FETCH_ASSOC);
        return $contacts;
    }

    public function marquerCommeVendu($idAcheteur, $idVendeur, $id)
    {
        $request = $this->pdo->prepare("UPDATE article SET status = 'vendu', visible = 0, date_vente ='" . date('Y-m-d H:i:s') . "', id_acheteur = ? WHERE id = ? ");
        $request->execute([$idAcheteur, $id]);
        $request2 = $this->pdo->prepare("UPDATE utilisateur_article SET id_client = ? WHERE id_article = ? ");
        $request2->execute([$idAcheteur, $id]);
        $request3 = $this->pdo->prepare("UPDATE utilisateur SET nb_articles_vendus = nb_articles_vendus + 1 WHERE id = ? ");
        $request3->execute([$idVendeur]);
        return true;
    }

    public function updateArticle($titre, $description, $prix, $etat, $categorie, $negociation, $id)
    {
        $request = $this->pdo->prepare("UPDATE article SET titre = ?, description = ?, prix = ?, etat_objet = ?, id_categorie = ?, ouvert_negociation = ? WHERE id = ?");
        $request->execute([$titre, $description, $prix, $etat, $categorie, $negociation, $id]);
        return true;
    }

    public function insertArticle($titre, $description, $prix, $etat, $categorie, $negociation, $image, $idUser)
    {
        $request = $this->pdo->prepare("INSERT into article (titre, description, prix, etat_objet, id_categorie, ouvert_negociation, photo, id_vendeur) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $request->execute([$titre, $description, $prix, $etat, $categorie, $negociation, $image, $idUser]);
        $idArticle = $this->pdo->lastInsertId();
        $request2 = $this->pdo->prepare("INSERT into utilisateur_article (id_article, id_vendeur) VALUES (?, ?)");
        $request2->execute([$idArticle, $idUser]);
        return true;
    }

    public function insertArticleAModerer($titre, $description, $prix, $etat, $negociation, $image, $catSuggeree, $idUser, $visible)
    {
        $request = $this->pdo->prepare("INSERT into article (titre, description, prix, etat_objet, ouvert_negociation, photo, categorie_suggeree, id_vendeur, visible) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $request->execute([$titre, $description, $prix, $etat, $negociation, $image, $catSuggeree, $idUser, $visible]);
        return true;
    }

    public function selectMessagesConversation($idDestinataire, $idUser)
    {
        $request = $this->pdo->prepare("SELECT *, DATE_FORMAT(date, '%d%m%Y') as shortday, DATE_FORMAT(date, '%b %d, %Y') as day,  DATE_FORMAT(date, '%h:%i %p') as time FROM message as m INNER JOIN utilisateur_message as um on id_message = m.id WHERE (id_expediteur = $idDestinataire AND id_destinataire = $idUser) OR (id_expediteur = $idUser AND id_destinataire = $idDestinataire)");
        $request->execute();
        $messages = $request->fetchAll(PDO::FETCH_ASSOC);
        return $messages;
    }


    public function sendNewMessage($idDestinataire, $idUser, $messageContent)
    {
        $request = $this->pdo->prepare("INSERT into message (id_expediteur, contenu) VALUES (?, ?)");
        $request->execute([$idUser, $messageContent]);
        $idMessage = $this->pdo->lastInsertId();
        $request2 = $this->pdo->prepare("INSERT into utilisateur_message (id_destinataire, id_message) VALUES (?, ?)");
        $request2->execute([$idDestinataire, $idMessage]);
        $request3 = $this->pdo->prepare("SELECT *, DATE_FORMAT(date, '%d%m%Y') as shortday, DATE_FORMAT(date, '%b %d, %Y') 
                                        as day,  DATE_FORMAT(date, '%h:%i %p') as time FROM message WHERE id = $idMessage");
        $request3->execute();
        $message = $request3->fetch(PDO::FETCH_ASSOC);
        return $message;
    }

    public function dismissNotif($idUser)
    {
        $request = $this->pdo->prepare("UPDATE utilisateur_message SET notification = 0 WHERE notification = 1 AND id_destinataire = ?");
        $request->execute([$idUser]);
        return true;
    }

    public function fetchNotif($idUser)
    {
        $request = $this->pdo->prepare("SELECT *, SUBSTRING(contenu, 1,50) as shortContent FROM utilisateur_message inner join message on utilisateur_message.id_message = message.id inner join utilisateur on utilisateur.id = message.id_expediteur WHERE notification = 1 AND id_destinataire = ?");
        $request->execute([$idUser]);
        $notifications = $request->fetchAll(PDO::FETCH_ASSOC);
        return $notifications;
    }
}

$model = new UserModel();
//var_dump($model->fetchNotif('4'));
////
////var_dump($model->sendNewMessage('4', '1', 'lala'));
////var_dump($model->selectMessagesConversation('4', '1'));
//////var_dump($model->selectMessagesConversation('2', '1'));
//$userExists = $model->userExists('admin@admin.fr', 'admin');
//var_dump($userExists);
////if($model->userIsAvailable('may@hotmail.fr', 'may', '1')) echo "no";
//var_dump($model->userIsAvailable('may@may2.fr', 'may3', '2'));
//var_dump($model->userIsAvailable('may@may.fr', 'may1', '2'));
//var_dump($model->insertArticleAModerer('lala', 'lala', '40', 'bon état', 'non', 'kakak', '1', '0'));