<?php
if(isset($_GET['id'])){

    $model = new Shop();
  
    $id = htmlspecialchars($_GET['id']);
    $objets = $model->showArticle($id);
    var_dump($objets);
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
    <?php 
    
    foreach ($objets as $objet) {
        ?>
        <tr>
            <td><?= $objet['titre']; ?></td>
            <td><?= $objet['description']; ?></td>
            <td><?= $objet['date_ajout']; ?></td>
            <td><?= $objet['prix']; ?></td>
            <td><?= $objet['etat_objet']; ?></td>
            <td><?= $objet['ouvert_negociation']; ?></td>
        </tr>

    <?php } ?>

    </tbody>
</table>