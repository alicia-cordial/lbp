<?php
if(isset($_GET['id'])){
$model = new Shop();


if(!empty($_GET['nom']) OR !empty($_GET['zip']) OR !empty($_GET['titre'])){
  $nom = htmlspecialchars($_GET['nom']);
  $zip = htmlspecialchars($_GET['zip']);
  $titre = htmlspecialchars($_GET['titre']);

  $objectExists = $model->selectObject($nom, $zip, $titre);

    }
    echo '<pre>';
var_dump($_GET['id']);
echo '</pre>';
}
?>
<main id="mainRecherche">

    <h2>Résultats Articles</h2>

    <table>
    <thead>
    <tr>
        <th>titre</th>
        <th>description</th>
        <th>prix</th>
        <th>categorie</th>
    </tr>
    </thead>

    <tbody>
        <?php foreach ($objectExists as $article) {


            ?>
   
        <tr>
            <td><?= $article['titre']; ?></td>
            <td><?= $article['description']; ?></td>
            <td><?= $article['prix']; ?></td>
            <td><?= $article['categorie']; ?></td>
        </tr>

        <?php } ?>
  
    </tbody>
</table>

</main>