<?php
require_once('Database.php');

class AdminModel extends Database
{
    public function showUsers($choice)
    {
        if (empty($choice)) {
            $request = $this->pdo->prepare("SELECT * FROM utilisateur WHERE droit = 0 and status != 'supprimé' ");
            $request->execute();
        } else {
            $request = $this->pdo->prepare("SELECT * FROM utilisateur WHERE status = ? AND droit = 0");
            $request->execute([$choice]);
        }
        $users = $request->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function deleteUser($id) {
        $request = $this->pdo->prepare("UPDATE utilisateur SET identifiant = 'utilisateur.ice supprimé', status ='supprimé', mail = '', mdp = '', zip = '0' WHERE id = ? ");
        $request2 = $this->pdo->prepare("DELETE article, utilisateur_article from article INNER JOIN utilisateur_article on id_article = article.id WHERE article.id_vendeur = 3 and status ='disponible'");
        $request->execute([$id]);
        $request2->execute([$id]);
        return true;
    }


    public function showModeration($choice)
    {
        if (empty($choice)) {
            $request = $this->pdo->prepare("SELECT * FROM utilisateur WHERE visible = 0");
            $request->execute();
        } else {
            $request = $this->pdo->prepare("SELECT * FROM utilisateur WHERE visible = 0 AND categorie_suggeree != 'null'");
            $request->execute([$choice]);
        }
        $articles = $request->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    }

}
//$model = new AdminModel();
//var_dump($model->showUsers('vendeur'));