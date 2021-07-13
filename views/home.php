

<main id="homeMain">
    <!--BARRE NAVIGATION COMPLEXE-->
    <article id="navHome"><br>
        <p class="center">BARRE NAVIGATION COMPLEXE</p><br>

        <section id="objet" class="form">
            <span id="formVendeur">Vendeur</span>
           
           
            <form id="form_objet" class="form_index" action="home.php" method="GET">

                <select class="common_selector nom" id="nom">
                    <option value="">--Catégories--</option>
                    <?php foreach ($model->get_Cat() as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= $cat['nom'] ?></option>
                    <?php endforeach;?>
                </select>


                <div class="list-group">
                    <button type="submit" neme='submit' id='submit'>Submit</button>
                </div>
            </form>

            <div id="message_form"></div>
        </section>

        <section id="vendeur">
            <span id="formObjet">Objet</span>
            <form id="form_vendeur" class="form_index">
                <input type="text" name="user" id="user" placeholder="Qui recherchez-vous ?">
            </form>
            <div>
                <div id="message"></div>
            </div>
        </section>
    </article>


    <!--SELECTION D'ZARTICLES EN RANDOM-->
    <article>
        <div class="row">
            <?php foreach ($articlesRandom as $articleRandom) : ?>
                <div class=" col l4 m6 s12">
                    <div class="card medium z-depth-0">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator" src="img/articles/<?= $articleRandom['photo'] ?>">
                        </div>
                        <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4"><b><?= $articleRandom['titre'] ?></b>
                              <div class="section"></div>
                            <p><?= $articleRandom['prix'] ?> €</p>
                            <p>in <em><a href="categorie?id=<?= $articleRandom['id_categorie'] ?>"><?= $articleRandom['nom'] ?></em></a></p>
                        </div>
                        <div class="card-reveal">

                    <span class="card-title grey-text text-darken-4"><b><?= $articleRandom['titre'] ?></b><i
                                class="material-icons right">close</i></span>
                            <div class="section"></div>
                            <p class="justifyText"><?= $articleRandom['description'] ?></p>
                            <p>Ajouté le : <?= date('d-m-Y', strtotime($articleRandom['date_ajout'])) ?></p>

                            <div class="section"></div>
                            <p><a href="article?id=<?= $articleRandom['article_id'] ?>">Voir +</a></p>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        </div>

    </article>


</main>
