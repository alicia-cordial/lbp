<?php

if (isset($_GET['id'])) {
    require_once('models/Shop.php');
    $model = new Shop();

    $id = htmlspecialchars($_GET['id']);
    $article = $model->showArticle($id);
    if ($article['visible'] != '1') {
        header('Location: home');
    }

    $id = htmlspecialchars($_GET['id']);
    $signalement = $model->nbSignal($id);
    if($signalement["COUNT(`signal`)"] == 2){
        header('Location: home');
    }

  var_dump($signalement);
  

}

?>
<article class="container">

    <section class="row">
        <div class="col s12 m6">
            <div class="card">
                <div class="card-image">
                    <img src="img/articles/<?= $article['photo'] ?>">
                </div>

                <div class="card-content">
                    <span class="card-title"><?= $article['titre']; ?></span>
                    <p><?= $article['prix'] ?> €</p>
                </div>
                <div class="card-action">
                    <p><em><a class="grey-text"
                              href="categorie?id=<?= $article['id_categorie'] ?>"> <?= $article['nom'] ?> </a></em></p>
                </div>
            </div>
        </div>

        <div class="col s12 m6">
            <div class="card cardVendeur grey darken-3">
                <div class="card-content white-text">

                    <span class="card-title"><span
                                class='initialIdentifiant'> <?= strtoupper($article['identifiant']['0']) ?> </span> @<?= $article['identifiant'] ?></span>
                    <p></p>
                </div>
                <div class="card-action white-text">
                    <a class="goldHover white-text" href="profilVendeur?id=<?= $article['id_vendeur'] ?>">PROFIL</a>
                    <p class="containerContactUser"><a
                                class='contactUser white-text <?php if (!isset($_SESSION['user']) or $_SESSION['user']['id'] === $article['id_vendeur'] or $_SESSION['user']['status'] == "vendeur") {
                                    echo "disabled";
                                } ?> ' href='#ex1' rel='modal:open'><i class='material-icons'>message</i></a></p>
                </div>
            </div>
        </div>

        <div class="col s12 m6">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Infos supplémentaires : </span>
                    <p>Ouvert aux négociations : <?= $article['ouvert_negociation'] ?></p>
                    <p>Localisation : <?= $article['zip'] ?></p>
                    <p>Etat : <?= $article['etat_objet'] ?></p>
                    <p>Date de publication : <?= date("d/m/Y à H:i", strtotime($article['date_ajout'])) ?></p>
                    <p><a class='signaler white-text' href='#ex2' rel='modal:open'><i class='material-icons black-text'>flag</i></a></p>
                </div>
            </div>
        </div>
    </section>

    <section class="row">

        <div class="col s12 m6">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Description : </span>
                    <p class="justifyText"><?= $article['description'] ?></p>
                </div>
            </div>
        </div>
    </section>
</article>

<div id="ex1" class="modal">
    <div id="idDestinataire" value="<?= $article['id_vendeur']; ?>"></div>
    <div id="nameDestinataire" value="<?= $article['identifiant']; ?>">A : <?= $article['identifiant']; ?></div>
    <form id='newMessage' class="form">
        <textarea class="materialize-textarea" required placeholder="Votre message. N'oubliez pas de mentionner l'article qui vous intéresse."></textarea>
        <button class="btn grey darken-3 waves-effect waves-light" type="submit" name="action">Envoyer
            <i class="material-icons right">send</i>
        </button>
    </form>
</div>


<div id="ex2" class="modal">

    <form id='newSignal' class="form">
            <div id="idUser" value="<?= $article['id']; ?>"></div>
          
            <div id="idArticle" value="<?= $_SESSION['user']['id']; ?>"></div>
    

        <p> Pour signaler un article, c'est ici !</p>
        <input hidden id="signal" value="1"/>
        <button class="btn grey darken-3 waves-effect waves-light" type="submit" name="action">Signaler
            <i class="material-icons right">flag</i>
        </button>
    </form>
</div>


