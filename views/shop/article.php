<?php

if(isset($_GET['id'])){

    $model = new Shop();
  
    $id = htmlspecialchars($_GET['id']);
    $articles = $model->showArticle($id);
    //echo '<pre>';
    //var_dump($articles);
    //echo'</pre>';


if($_POST['submit']){

    $model = new Shop();

    $id = htmlspecialchars($_GET['id']);
    $signal = htmlspecialchars($_POST['signal']);

        $model->addSignal($id, $signal);
        $success = "SUCCESS";
    }
}
var_dump($model->addSignal($id, $signal));
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
        <th>Signal</th>
        <th>Catégorie</th>
        <th>Vendeur</th>
        <th>Code Postal</th>
        <th>Mail</th>
    </tr>
    </thead>

    <tbody>
   
        <tr>
            <td><?= $articles['titre']; ?></td>
            <td><?= $articles['description']; ?></td>
            <td><?= $articles['date_ajout']; ?></td>
            <td><?= $articles['prix'].'€'; ?></td>
            <td><?= $articles['etat_objet']; ?></td>
            <td><?= $articles['ouvert_negociation']; ?></td>
            <td> 
                <form method='post' action='article.php'>
                    <input type="hidden" value="<?= $articles['id']; ?>" name="id">
                    <input type="text" value="<?= $articles['signal']; ?>" name="signal">
                    <input type='submit' name='submit' value='submit'>
                </form>
            </td>

            <td><?= $articles['nom']; ?></td>
            <td><a href='profilVendeur?id=<?= $articles['id']; ?>'><?= $articles['identifiant']; ?></a></td>
            <td><?= $articles['zip']; ?></td>
            <td><a id =" <?= $articles['id'] ?>" class='contactUser' href='#ex1' rel='modal:open'>Contacter le vendeur</a> </td>
    
          
        </tr>



    </tbody>
</table>



<div id="ex1" class="modal">
    <div id="idDestinataire" value="<?= $articles['id']; ?>"></div>
    <div id="nameDestinataire" value="<?= $articles['identifiant']; ?>"></div>
            <form id='newMessage'>
                <input placeholder='votre message' required>
                <button type='submit'>Envoyer</button>
        </form>
    <div id="infoMessage"></div>
        <a href="#" rel="modal:close">Close</a>
    </div>

