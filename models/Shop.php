<?php

//session_start();

require_once('Database.php');

class Shop extends Database{


    /*SELECT ARTICLES D'UNE CATEGORIE*/
    function selectArticlesCategorie($idCat){
        $request = $this->pdo->prepare("SELECT *, article.id as id_article FROM `article` WHERE visible = 1 AND id_categorie = ?");
        $request->execute([$idCat]);
        $result_search = $request->fetchAll(PDO::FETCH_ASSOC);
        return $result_search;
    }


    /*ARTICLES VENDEUR */
  function showAllarticlesCat($id){

    $request = $this->pdo->prepare("SELECT *, article.id as id_article FROM `article`  INNER JOIN `categorie` ON `article`.`id_categorie` = `categorie`.id WHERE id_vendeur = '$id' AND visible = 1 AND status = 'disponible' ");
    $request->execute();
    $result = $request->fetchAll(PDO::FETCH_ASSOC);

    return $result;
  }



/*SELECTION ARTICLE RANDOM HOME*/
    function selectArticlesRandom(){
        $request = $this->pdo->prepare("SELECT *, article.id as article_id FROM `article` INNER JOIN `categorie` ON `article`.`id_categorie` = `categorie`.id WHERE status = 'disponible' and article.visible = '1' ORDER BY RAND() LIMIT 10");
        $request->execute();
        $articles = $request->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    }

/*AUTOCOMPLETION HEADER */
  function get_article($term){
  
    $request = $this->pdo->prepare("SELECT *, article.id as article_id FROM `article` INNER JOIN `categorie` ON `article`.`id_categorie` = `categorie`.id WHERE article.visible = '1' AND titre LIKE '%$term%' ORDER BY `titre` ASC LIMIT 8");
    $request->execute([$term]);
    $articles = $request->fetchAll(PDO::FETCH_ASSOC);
  return $articles;
    }

  /*PROFIL ARTICLE*/

  function showArticle($id){
 
    $request = $this->pdo->prepare("SELECT * FROM `article` INNER JOIN `categorie` ON `article`.`id_categorie` = `categorie`.id INNER JOIN `utilisateur` ON utilisateur.id = article.id_vendeur WHERE article.visible = '1' AND article.id = '$id' ");
    $request->execute([$id]);
    $articleExist = $request->fetch(PDO::FETCH_ASSOC);
  
    return $articleExist;
  }




    /*AUTOCOMPLETION RECHERCHE VENDEUR */

  function get_seller($search){
    $request = $this->pdo->prepare("SELECT * FROM utilisateur WHERE status = 'vendeur' AND droit = '0' AND `identifiant` LIKE '%$search%'");
    $request->execute([$search]);
    $getseller = $request->fetchAll(PDO::FETCH_ASSOC);

    return $getseller;

  }

  /*PROFIL VENDEUR*/

  function showVendeur($id){
 
    $request = $this->pdo->prepare("SELECT *, utilisateur.status as userStatus, utilisateur.id as id_vendeur FROM utilisateur LEFT JOIN `article` on article.id_vendeur = utilisateur.id WHERE utilisateur.id = ? AND utilisateur.status = ?");
    $request->execute([$id, 'vendeur']);
    $userExist = $request->fetch(PDO::FETCH_ASSOC);
  
    return $userExist;
  }
  
/*ARTICLES VENDEUR */
  function showAllarticles($id){

    $request = $this->pdo->prepare("SELECT *, article.id as id_article FROM `article`  INNER JOIN `categorie` ON `article`.`id_categorie` = `categorie`.id where id_vendeur = '$id' AND visible = 1 AND status = 'disponible' ");
    $request->execute();
    $result = $request->fetchAll(PDO::FETCH_ASSOC);

    return $result;
  }


/*FORMULAIRE RECHERCHE */
function selectObject($id){
  $request = $this->pdo->prepare("SELECT * FROM `article` INNER JOIN `categorie` ON `article`.`id_categorie` = `categorie`.id INNER JOIN `utilisateur`ON `article`.`id_vendeur` = `utilisateur`.id  WHERE article.id = '$id'");
  $request->execute([$id]);
  $result = $request->fetchAll(PDO::FETCH_ASSOC);

  return $result;
}


  /*AUTOCOMPLETION RECHERCHE OBJET*/


  function get_articleCat($term){
    $request = $this->pdo->prepare("SELECT * FROM `article` INNER JOIN `categorie` ON `article`.`id_categorie` = `categorie`.id WHERE titre LIKE '%$term%'");
    $request->execute([$term]);
    $result_search[] = $request->fetchAll(PDO::FETCH_ASSOC);

    return $result_search;

  }


  /***********AFFICHER TOUTES LES CATEGORIES *************************/
 

  public function getCat($choice)
  {
      
          $request = $this->pdo->prepare("SELECT * FROM `categorie` WHERE id != 0 ");
          $request->execute([$choice]);
  
      $categories = $request->fetchAll(PDO::FETCH_ASSOC);
      return $categories;
  }



 /***********SELECTION  CATEGORIE *************************/
 function cat($id){
  $request = $this->pdo->prepare("SELECT * FROM `categorie` WHERE id = ? ");
  $request->execute([$id]);
  $result = $request->fetch(PDO::FETCH_ASSOC);

  return $result;

}


  /************ AVIS******************/

  public function addReview($note, $idArticle, $idVendeur){

    $request = $this->pdo->prepare('INSERT INTO notation(note, id_article, id_vendeur) VALUES(?, ?, ?)');
    $request->execute([$note, $idArticle, $idVendeur]);
    $idNote = $this->pdo->lastInsertId();
    $request2 = $this->pdo->prepare("SELECT * FROM notation WHERE id = $idNote");
    $request2->execute();
    $notes = $request2->fetch(PDO::FETCH_ASSOC);
    return $notes;
}

public function moyenneNote($id){
  $request = $this->pdo->prepare("SELECT  AVG(note) FROM notation INNER JOIN article ON note.id_vendeur = article.id_vendeur WHERE article.id_vendeur =  ? ");
  $request->execute([$id]);
  $moyenne = $request->fetch(PDO::FETCH_ASSOC);

  return $moyenne;
}

public function Note($id){
  $request = $this->pdo->prepare("SELECT COUNT(note) FROM notation WHERE note.id_vendeur = $id ");
  $request->execute([$id]);
  $allNotes = $request->fetch(PDO::FETCH_ASSOC);

  return $allNotes;
}

  /************SIGNALEMENT******************/

  public function addReport($signal, $idUser, $idArticle){

    $request = $this->pdo->prepare('INSERT INTO signalement(`signal`, id_acheteur, id_article) VALUES(?, ?, ?)');
    $request->execute([$signal,  $idUser, $idArticle]);
    $idSignal = $this->pdo->lastInsertId();
    $request2 = $this->pdo->prepare("SELECT DISTINCT * FROM signalement WHERE id = $idSignal ");
    $request2->execute([$idSignal]);
    $signals = $request2->fetch(PDO::FETCH_ASSOC);
    return $signals;
}

/*récupérer le nombre de signalement */


public function nbSignal($id){
  $request = $this->pdo->prepare("SELECT COUNT(`signal`) FROM signalement INNER JOIN article ON article.id = signalement.id_article WHERE article.id =  ?");
  $request->execute([$id]);
  $allSignals = $request->fetch(PDO::FETCH_ASSOC);

  return $allSignals;
}



}

//$model = new Shop();
//echo '<pre>';
//var_dump($model->addReview(3, 2, 2));
//echo '</pre>';

