<?php

//session_start();

require_once('Database.php');

class Shop extends Database{

  private $id;
  private $identifiant;
  private $mail;
  private $zip;
  private $date_inscription;
  private $titre;
  private $description;
  private $date_ajout;
  private $photo;
  private $prix;
  private $etat_objet;





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



    /*AUTOCOMPLETION RECHERCHE OBJET*/


    function get_articleCat($term){
      $request = $this->pdo->prepare("SELECT * FROM `article` INNER JOIN `categorie` ON `article`.`id_categorie` = `categorie`.id WHERE titre LIKE '%$term%'");
      $request->execute([$term]);
      $result_search[] = $request->fetchAll(PDO::FETCH_ASSOC);
  
      return $result_search;
  
    }



  /*PROFIL ARTICLE*/

  function showArticle($id){
 
    $request = $this->pdo->prepare("SELECT * FROM `article` INNER JOIN `categorie` ON `article`.`id_categorie` = `categorie`.id  WHERE article.id = '$id' ");
    $request->execute([$id]);
    $articleExist = $request->fetch(PDO::FETCH_ASSOC);
  
    return $articleExist;
  }




    /*AUTOCOMPLETION RECHERCHE VENDEUR */

  function get_seller($search){
    $request = $this->pdo->prepare("SELECT * FROM utilisateur INNER JOIN `article` ON utilisateur.id = article.id_vendeur WHERE `identifiant` LIKE '%$search%'");
    $request->execute([$search]);
    $getseller[] = $request->fetchAll(PDO::FETCH_ASSOC);

    return $getseller;

  }

  /*PROFIL VENDEUR*/

  function showVendeur($id){
 
    $request = $this->pdo->prepare("SELECT * FROM utilisateur INNER JOIN `article` ON utilisateur.id = article.id_vendeur WHERE utilisateur.id = '$id' ");
    $request->execute([$id]);
    $userExist = $request->fetch(PDO::FETCH_ASSOC);
  
    return $userExist;
  }








}
//$model = new Shop();
//var_dump($model->showVendeur('1'));


//ÇA MARCHE LIER À CONTROLLER