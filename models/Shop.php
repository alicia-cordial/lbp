<?php

//session_start();

require_once('Database.php');

class Shop extends Database{

  private $id;
  private $identifiant;

  private $mail;

  private $zip;
  private $date_inscription;




/*FORMULAIRE RECHERCHE */
  function selectObject($nom, $zip, $titre){
    $request = $this->pdo->prepare("SELECT * FROM `article` INNER JOIN `categorie` ON `article`.`id_categorie` = `categorie`.id INNER JOIN `utilisateur`ON `article`.`id_vendeur` = `utilisateur`.id WHERE $nom = ? OR $zip = ? OR $titre = ?");
    $request->execute([$nom, $zip, $titre]);
    $result = $request->fetchAll(PDO::FETCH_ASSOC);

    return $result;
  }

/*AUTOCOMPLETION HEADER */
  function get_article($term){
  
    $request = $this->pdo->prepare("SELECT * FROM `article` where `titre` LIKE '%$term%' ORDER BY `titre` ASC LIMIT 8");
    $request->execute([$term]);
    $articles[] = $request->fetchAll(PDO::FETCH_ASSOC);
  
  
  return $articles;
  
    }


    function get_oneArticle($titre){
      $request = $this->pdo->prepare("SELECT * FROM `article` WHERE titre = ?");
      $request->execute([$titre]);
      $article[] = $request->fetchAll(PDO::FETCH_ASSOC);
      
      return $article;
    }


    /*AUTOCOMPLETION RECHERCHE OBJET*/


    function get_articleCat($term){
      $request = $this->pdo->prepare("SELECT * FROM `article` INNER JOIN `categorie` ON `article`.`id_categorie` = `categorie`.id WHERE titre LIKE '%$term%'");
      $request->execute([$term]);
      $result_search[] = $request->fetchAll(PDO::FETCH_ASSOC);
  
      return $result_search;
  
    }


    /*AUTOCOMPLETION RECHERCHE VENDEUR */

  function get_seller($search){
    $request = $this->pdo->prepare("SELECT * FROM utilisateur INNER JOIN `article` ON utilisateur.id = article.id_vendeur WHERE `identifiant` LIKE '%$search%'");
    $request->execute();
    $getseller[] = $request->fetchAll(PDO::FETCH_ASSOC);

    return $getseller;

  }

  function showVendeur($id){
 
    $request = $this->pdo->prepare("SELECT * FROM utilisateur INNER JOIN `article` ON utilisateur.id = article.id_vendeur WHERE utilisateur.id = '$id' ");
    $request->execute([$id]);
    $userExist = $request->fetchAll(PDO::FETCH_ASSOC);
  
    return $userExist;
  }

//GETID
function getId()
{
    return $this->id;
}

//GETLOGIN
 function getIdentifiant()
{
    return $this->identifiant;
}



//GET ZIP

 function getZip()
{

    return $this->zip;

}


//GET EMAIL

 function getMail()
{

    return $this->mail;

}

//GET EMAIL

function getDateInscription()
{

    return $this->date_inscription;

}

  /*

function get_cat(){
  $request = $this->pdo->prepare("SELECT * FROM `categorie`");
  $request->execute();
  $getcat[] = $request->fetchAll(PDO::FETCH_ASSOC);
}
*/



/*RECHERCHE PRICE RANGE */

function price_range(){
  $query = $this->pdo->prepare("SELECT * FROM article ORDER BY prix DESC");
  $query->execute();
  $price[] = $query->fetchAll(PDO::FETCH_ASSOC);
  
  return $price;

  }

}
$model = new Shop();
//var_dump($model->showVendeur('1'));


//ÇA MARCHE LIER À CONTROLLER