<?php

if (isset($_GET['id'])) {
    $model = new Shop();
    $id = htmlspecialchars($_GET['id']);
    $articles = $model->selectArticlesCategorie($id);

//    $article = $model->showAllarticlesCat($id);
    if(!$articles) {
        header('location: home');
    }
   
}

?>
<main id="categorieMain">
  <?php foreach ($articles as $art) : ?>
        <?php if ($art['visible'] == 1) : ?>
            <div class="col s12 m7">
                <div class="card small horizontal">
                    <div class="card-image">
                        <img src="img/articles/<?= $art['photo'] ?>">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content articleCard">
                            <span class="card-title"> <a class="grey-text goldHover" href="article?id=<?= $art['id_article'] ?>"><?= $art['titre'] ?></a></span>
                            <p><?= $art['prix'] ?> €</p>
                            
                        </div>
                        <div class="card-action">
                            <a class="grey-text" href="article?id=<?= $art['id_article'] ?>">Voir fiche</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</main>
