<?php

//session_start();

require_once('Database.php');

class Shop extends Database{


    /*SELECT ARTICLES D'UNE CATEGORIE*/
    function selectArticlesCategorie($idCat){
        $request = $this->pdo->prepare("SELECT * FROM `article` WHERE visible = 1 AND id_categorie = ?");
        $request->execute([$idCat]);
        $result_search = $request->fetchAll(PDO::FETCH_ASSOC);
        return $result_search;
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
    $request = $this->pdo->prepare("SELECT * FROM utilisateur WHERE status = 'vendeur' AND `identifiant` LIKE '%$search%'");
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

/*****************************RECHERCHE PRÉCISE*********************/
function Research($research){


 $query = "SELECT * FROM `article` INNER JOIN `categorie` ON `article`.`id_categorie` = `categorie`.id INNER JOIN `utilisateur`ON `article`.`id_vendeur` = `utilisateur`.id WHERE article.visible = '1' ";

  //if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"])){
    //$query .= " AND prix BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."' ";
 // }


    if(isset($_POST["nom"])){
      $query .= "AND categorie.nom LIKE '%$research%' ";
    }

      if(isset($_POST["titre"])){
        $query .= " AND article.titre LIKE '%$research%' ";
      }

        if(isset($_POST["zip"])){
          $query .= "AND utilisateur.zip LIKE '%$research%' ";
        }

 $statement = $this->pdo->prepare($query);
 $statement->execute([$research]);
 $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  
  return $result;

}

  /*AUTOCOMPLETION RECHERCHE OBJET*/


  function get_articleCat($term){
    $request = $this->pdo->prepare("SELECT * FROM `article` INNER JOIN `categorie` ON `article`.`id_categorie` = `categorie`.id WHERE titre LIKE '%$term%'");
    $request->execute([$term]);
    $result_search[] = $request->fetchAll(PDO::FETCH_ASSOC);

    return $result_search;

  }


  function get_Cat(){
    $request = $this->pdo->prepare("SELECT * FROM `categorie` ");
    $request->execute();
    $result = $request->fetchAll(PDO::FETCH_ASSOC);

    return $result;

  }


  /****************SIGNALER UN OBJET**************/

  function addSignal($id, $signal){
    $request = $this->pdo->prepare("UPDATE `article`SET `signal` = '?' WHERE article.id =  $id");
    $update = $request->execute(array(
    'signal' => $signal,
    'id' => $id,
    ));
return $update;
  }


}

//$model = new Shop();
//echo '<pre>';
//var_dump($model->selectResearch('vêtement'));
//echo '</pre>';

