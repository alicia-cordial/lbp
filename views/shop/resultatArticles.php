<?php

require_once('../../models/Shop.php');

if(isset($_GET['id'])){


    $id = htmlspecialchars($_GET['id']);
    $nom = htmlspecialchars($_GET['nom']);
    $titre = htmlspecialchars($_GET['titre']);    
    $zip = htmlspecialchars($_GET['zip']);

    $model = new Shop();

    //$articles = $model->selectObject($nom, $zip, $titre);
    //$articles = $model->selectResearch($research);
    echo '<pre>';
    var_dump($articles);
 
    echo'</pre>';
    }


    ?>

</section> 
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
            <td><?= $articles['zip']; ?></td>
            <td><?= $articles['nom']; ?></td>
          
        </tr>




    </tbody>
</table>
