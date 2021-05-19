RESULTATS RECHERCHE
<?php
if (is_array($articles) || is_object($articles)){
foreach($articles as $a) :
    ?>

<h2>
<?= $a['titre']; ?>
</h2>

<p>
<?= $a['description']; ?>
</p>



<?php endforeach ?>

<?php }
var_dump($a);
?>

