<main id="mainCompte">
    <article class="row">
        <ul class="tabs">
            <li class="navUser tab  col l2" id="navSoldArticle">Historique de vente</li>
            <li class="navUser tab  col l2" id="navArticleSelling">Articles en vente</li>
            <li class="navUser tab  col l2 navNewArticle"> +</li>
            <li class="navUser tab col l2" id="navUpdateProfil">Modifier le profil</li>
            <li class="navUser tab  col l2" id="navMessagerie">Messagerie</li>
        </ul>
    </article>
    <section id="sectionVendeur">
        <div class="section"></div>
        <div class="center">
            <h3>Bienvenue <span class="goldText">@<?= $_SESSION['user']['identifiant'] ?></span></h3>
            <h4><a class="goldHover" href="profilVendeur?id=<?= $_SESSION['user']['id'] ?>">Voir votre profil public</a></h4>
        </div>
        <div class="section"></div>
    </section>
</main>
