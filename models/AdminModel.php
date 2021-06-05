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

    public function deleteUser($id)
    {
        $request = $this->pdo->prepare("UPDATE utilisateur SET identifiant = 'utilisateur.ice supprimé', status ='supprimé', mail = '', mdp = '', zip = '0' WHERE id = ? ");
        $request2 = $this->pdo->prepare("DELETE article, utilisateur_article from article INNER JOIN utilisateur_article on id_article = article.id WHERE article.id_vendeur = ? and status ='disponible'");
        $request->execute([$id]);
        $request2->execute([$id]);
        return true;
    }


    public function showModeration($choice)
    {
        if (empty($choice)) {
            $request = $this->pdo->prepare("SELECT *, article.id as article_id FROM article INNER JOIN utilisateur on article.id_vendeur = utilisateur.id WHERE visible = 0 AND article.status = 'disponible'");
        } else {
            if ($choice == 'categorie_suggeree') {
                $request = $this->pdo->prepare("SELECT *, article.id as article_id FROM article INNER JOIN utilisateur on article.id_vendeur = utilisateur.id WHERE visible = 0 AND $choice is not null AND article.status = 'disponible'");
            } else {
                $request = $this->pdo->prepare("SELECT *, article.id as article_id FROM article INNER JOIN categorie on article.id_categorie = categorie.id INNER JOIN utilisateur on article.id_vendeur = utilisateur.id WHERE visible = 0 AND `signal` = 2 AND article.status = 'disponible'");
            }
        }
        $request->execute();
        $articles = $request->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    }

    public function deleteArticle($id)
    {
        $request = $this->pdo->prepare("DELETE from article WHERE id = ?");
        $request->execute([$id]);
        return true;
    }

    //create new category
    public function createNewCategory($categoryName)
    {
        $request = $this->pdo->prepare("INSERT into categorie (nom) values (?)");
        $request->execute([$categoryName]);
        $id = $this->pdo->lastInsertId();
        return $id;
    }


    public function selectCategories()
    {
        $request = $this->pdo->prepare("SELECT categorie.id, categorie.nom from categorie INNER JOIN article on article.id_categorie = categorie.id");
        $request->execute();
        $categories = $request->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }

    public function showArticlesCategorie($idCategory)
    {
        $request = $this->pdo->prepare("SELECT * from categorie INNER JOIN article on article.id_categorie = categorie.id INNER JOIN utilisateur on utilisateur.id = article.id_vendeur WHERE categorie.id = ?");
        $request->execute([$idCategory]);
        $categories = $request->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }

    //update cat name
    public function updateCat($idCategory, $newName)
    {
        $request = $this->pdo->prepare("UPDATE categorie SET nom = ? WHERE id = ?");
        $request->execute([$newName, $idCategory]);
        return true;
    }

    //accept article new cat
    public function acceptArticleNewCat($categoryName, $id, $idVendeur)
    {
        $idCategory = $this->createNewCategory($categoryName);
        $request = $this->pdo->prepare("UPDATE article SET categorie_suggeree = NULL, id_categorie = ?, visible = 1 WHERE id = ?");
        $request->execute([$idCategory, $id]);
        $request2 = $this->pdo->prepare("INSERT into utilisateur_article(id_article, id_vendeur) VALUES (?,?)");
        $request->execute([$id, $idVendeur]);
        return true;
    }

    //accept article signale
    public function acceptArticleSignal($id)
    {
        $request = $this->pdo->prepare("UPDATE article SET `signal` = NULL, visible = 1 WHERE id = ?");
        $request->execute([$id]);
        return true;
    }

}
//$model = new AdminModel();
//var_dump($model->acceptArticleNewCat('prout','43'));