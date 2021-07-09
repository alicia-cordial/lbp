<?php
if (isset($_GET['id'])) {
    $model = new Shop();

    $id = htmlspecialchars($_GET['id']);
    $users = $model->showVendeur($id);
    if ($users['userStatus'] != 'vendeur') {
        header('Location: home');
    }
    $articles = $model->showAllarticles($id);
//    var_dump($users['id_vendeur']);
//    var_dump($_SESSION['user']);
}
?>
<main id="profilVendeurMain">


    <article class="row">
        <div class="col card s12 grey darken-3">

            <div class="card-content col s12 m9 white-text">
                <div><span class="initialIdentifiant"><?= mb_strtoupper($users['identifiant']['0']) ?></span>
                    <h6>@<?= $users['identifiant'] ?></h6></div>
                <p>Inscription : <?= date('d-m-Y', strtotime($users['date_inscription'])) ?></p>
                <p>
                    <i class="tiny material-icons">location_on</i><span><?= $users['zip'] ?></span>
                </p>
            </div>
            <div class="card-content col s12 m3 white-text">
                <p class="containerContactUser"><a id="<?= $users['id_vendeur'] ?>"
                                                   class='contactUser <?php if (!isset($_SESSION['user']) or
                                                       $_SESSION['user']['id'] === $users['id_vendeur']) {
                                                       echo "disabled";
                                                   } ?>' href='#ex1' rel='modal:open'
                                                   class="btn white waves-effect waves-light">
                        <i class="material-icons">message</i>
                    </a></p>
                <p>++++ Note</p>
                <p>Nombre de ventes : <?= $users['nb_articles_vendus'] ?> </p>
            </div>
        </div>

    </article>
    <?php if (empty($articles)) : ?>
        <div class="center container">
            <div class="section"></div>
            <p>Ce membre n'a aucun article en vente actuellement.</p>
        </div>
    <?php endif; ?>
    <?php foreach ($articles as $art) : ?>
        <?php if ($art['visible'] == 1) : ?>
            <div class="col s12 m7">
                <div class="card small horizontal">
                    <div class="card-image">
                        <img src="img/articles/<?= $art['photo'] ?>">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content articleCard">
                            <span class="card-title"> <a class="grey-text goldHover"
                                                         href="article?id=<?= $art['id_article'] ?>"><?= $art['titre'] ?></a></span>
                            <p><?= $art['prix'] ?> €</p>
                            <p>in <a class="goldHover" href="categorie?id=<?= $art['id_categorie'] ?>"><?= $art['nom'] ?></a></p>
                        </div>
                        <div class="card-action">
                            <a class="grey-text" href="article?id=<?= $art['id_article'] ?>">Voir fiche</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>


    <div id="ex1" class="modal">
        <div id="idDestinataire" value="<?= $users['id_vendeur'] ?>"></div>
        <div id="idExpediteur" value="<?= $_SESSION['user']['id'] ?>"></div>
        <div id="nameDestinataire" value="<?= $users['identifiant'] ?>"><p>A : <?= $users['identifiant'] ?></p></div>
        <form id='newMessage' class="form">
            <textarea class="materialize-textarea" required placeholder="Votre message. N'oubliez pas de mentionner l'article qui vous intéresse."></textarea>
            <button class="btn grey darken-3 waves-effect waves-light" type="submit" name="action">Envoyer
                <i class="material-icons right">send</i>
            </button>
        </form>
    </div>

</main>