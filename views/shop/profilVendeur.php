<?php
if (isset($_GET['id'])) {
    $model = new Shop();

    $id = htmlspecialchars($_GET['id']);
    $users = $model->showVendeur($id);
    if ($users['userStatus'] != 'vendeur') {
        header('Location: home');
    }
    $articles = $model->showAllarticles($id);
//    var_dump($users);
}
?>
<main>


    <article class="row">
        <div class="section"></div>
        <div class="col s12 grey darken-3">
            <div class="section"></div>
            <div class="col s9 white-text">
                <div><span class="initialIdentifiant"><?= mb_strtoupper($users['identifiant']['0']) ?></span>
                    <h6><?= $users['identifiant'] ?></h6></div>
                <p>Inscription : <?= date('d-m-Y', strtotime($users['date_inscription'])) ?></p>
                <p>
                    <i class="tiny material-icons">location_on</i><span><?= $users['zip'] ?></span>
                </p>
            </div>
            <div class="col s3 white-text center">
                <p><a id="<?= $users['id_vendeur'] ?>" class='contactUser' <?php if (!isset($_SESSION['user'])) {
                        echo "disabled";
                    } ?>' href='#ex1' rel='modal:open' class="btn white waves-effect waves-light">
                    <i class="material-icons">message</i>
                    </a></p>
                <p>++++ Note</p>
                <p>Nombre de ventes : </p>
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
                        <div class="card-content">
                            <span class="card-title"> <a class="grey-text"
                                                         href="article?id=<?= $art['id'] ?>"><?= $art['titre'] ?></a></span>
                            <p><?= $art['prix'] ?> €</p>
                            <p><?= $art['description'] ?></p>
                        </div>
                        <div class="card-action">
                            <a class="grey-text" href="article?id=<?= $art['id'] ?>">Voir fiche</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>


    <div id="ex1" class="modal">
        <div id="idDestinataire" value="<?= $users['id'] ?>"></div>
        <div id="nameDestinataire" value="<?= $users['identifiant'] ?>"><p>A : <?= $users['identifiant'] ?></p></div>
        <form id='newMessage' class="form">
            <textarea class="materialize-textarea" required placeholder="Votre message"></textarea>
            <button class="btn grey darken-3 waves-effect waves-light" type="submit" name="action">Envoyer
                <i class="material-icons right">send</i>
            </button>
        </form>
    </div>

</main>