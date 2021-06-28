<?php


$model = new Shop();
$articlesRandom = $model->selectArticlesRandom();

//var_dump($model->get_cat());


if (isset($_POST['submit'])) {
    $model = new Shop();

    $articles = $model->selectResearch($search);

    $nom = htmlspecialchars($_POST['nom']);
    $titre = htmlspecialchars($_POST['titre']);
    $zip = htmlspecialchars($_POST['zip']);


    //$articles = $model->selectObject($nom, $zip, $titre);


    echo '<pre>';
    var_dump($articles);

    echo '</pre>';
}


?>


<main>
    <!--BARRE NAVIGATION COMPLEXE-->
    <article id="navHome">
        <p>BARRE NAVIGATION COMPLEXE</p>
        <section id="objet" class="form">
            <span id="formVendeur">Vendeur</span>
            <form id="form_objet" class="form_index" method="post">
                <label for="nom">Categories</label>
                <select name="rechercher" id="nom">
                    <option value="">--Options--</option>
                    <?php foreach ($model->get_Cat() as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= $cat['nom'] ?></option>
                    <?php endforeach; ?>
                </select>

                <input type="text" name="rechercher" id="titre" placeholder="Que recherchez-vous ?">
                <input type="text" name="rechercher" id="zip" placeholder="Quelle région?">

                <input type="hidden" id="hidden_minimum_price" value="0"/>
                <input type="hidden" id="hidden_maximum_price" value="65000"/>
                <p id="price_show">1000 - 65000</p>
                <div id="price_range"></div>
                <div class="list-group">
                    <button type="submit" name="submit" value="submit">Submit</button>
                </div>
            </form>
            <div id="message_form"></div>
        </section>


        <section id="vendeur">
            <span id="formObjet">Objet</span>
            <form id="form_vendeur" class="form_index" method="get">
                <input type="text" name="user" id="user" placeholder="Qui recherchez-vous ?">
            </form>
            <div>
                <div id="message"></div>
            </div>
        </section>
    </article>

    <!--ARTICLES EN RANDOM-->
    <article>
        <div class="row">
            <?php foreach ($articlesRandom as $articleRandom) : ?>
                <div class=" col l4 m6 s12 card medium z-depth-0">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="img/articles/<?= $articleRandom['photo'] ?>">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4"><?= $articleRandom['titre'] ?>
                              <div class="section"></div>
                            <p><?= $articleRandom['prix'] ?> €</p>
                            <p>in <em> <?= $articleRandom['nom'] ?></em></p>
                    </div>
                    <div class="card-reveal">

                        <span class="card-title grey-text text-darken-4"><b><?= $articleRandom['titre'] ?></b><i class="material-icons right">close</i></span>
                            <p><?= $articleRandom['description'] ?></p>
                            <p>Ajouté le : <?= date('d-m-Y', strtotime($articleRandom['date_ajout'])) ?></p>

                        <div class="section"></div>
                            <p><a href="article?id=<?= $articleRandom['id'] ?>">Voir +</a></p>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        </div>

    </article>


</main>
