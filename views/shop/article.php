<?php
if(isset($_GET['id'])){

    $model = new Shop();
  
    $id = htmlspecialchars($_GET['id']);
    $articles = $model->showArticle($id);
    //echo '<pre>';
    //var_dump($articles);
    //echo'</pre>';
    }
    ?>


   
<h1>Fiche Produit</h1>

<table>
    <thead>
    <tr>
        <th>Titre</th>
        <th>Description</th>
        <th>Date Ajout</th>
        <th>Prix</th>
        <th>Etat objet</th>
        <th>Ouvert à négociation</th>
      
    </tr>
    </thead>

    <tbody>
   
        <tr>
            <td><?= $articles['titre']; ?></td>
            <td><?= $articles['description']; ?></td>
            <td><?= $articles['date_ajout']; ?></td>
            <td><?= $articles['prix']; ?></td>
            <td><?= $articles['etat_objet']; ?></td>
            <td><?= $articles['ouvert_negociation']; ?></td>
          
        </tr>



    </tbody>
</table>