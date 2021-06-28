<main id="mainCompte">
    <article>
        <article class="center-align row">
            <h2><a href="compte">ESPACE PERSONNEL</a></h2>
            <h3><?= $_SESSION['user']['identifiant'] ?> ~ Acheteur.se</h3>
        </article>

        <article class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="navUser tab" id="navBoughtArticle">Historique d'achat</li>
                    <li class="navUser tab" id="navMessagerie">Messagerie</li>
                    <li class="navUser tab" id="navUpdateProfil">Modifier le profil</li>
                </ul>
        </article>
    </article>
    <section id="sectionVendeur">
    </section>
</main>