<?php

//session_start();

require_once('Database.php');

class Shop extends Database{




/*AUTOCOMPLETION HEADER */
  function get_article($term){
  
    $request = $this->pdo->prepare("SELECT * FROM `article` INNER JOIN `categorie` ON `article`.`id_categorie` = `categorie`.id WHERE article.visible = '1' AND titre LIKE '%$term%' ORDER BY `titre` ASC LIMIT 8");
    $request->execute([$term]);
    $articles[] = $request->fetchAll(PDO::FETCH_ASSOC);
  
  
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
/*ARTICLES VENDEUR */
  function showAllarticles($id){

    $request = $this->pdo->prepare("SELECT * FROM `article` where id_vendeur = '$id' ");
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

/*RECHERCHE PRÉCISE */
/*function selectResearch($research){
  $request = $this->pdo->prepare("SELECT * FROM `article` INNER JOIN `categorie` ON `article`.`id_categorie` = `categorie`.id INNER JOIN `utilisateur`ON `article`.`id_vendeur` = `utilisateur`.id  WHERE article.titre LIKE '%$research%' OR categorie.nom LIKE '%$research%' OR utilisateur.zip LIKE '%$research%'");
  $request->execute([$research]);
  $result[] = $request->fetchAll(PDO::FETCH_ASSOC);

  return $result;
}
*/



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


}
//$model = new Shop();
//var_dump($model->selectResearch('?', '?', '69006'));

