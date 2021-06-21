<main id="mainCompte">
    <!--    --><?php //var_dump($_SESSION);?>
    <article>
        <article class="center-align row">
            <h2><a href="compte">ESPACE PERSONNEL</a></h2>
            <h3><?= $_SESSION['user']['identifiant'] ?> ~ Vendeur.se</h3>
        </article>

        <article class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="navUser tab  col l2" id="navSoldArticle">Historique de vente</li>
                    <li class="navUser tab  col l2" id="navArticleSelling">Articles en vente</li>
                    <li class="navUser tab  col l2 navNewArticle"> + </li>
                    <li class="navUser tab col l2" id="navUpdateProfil">Modifier le profil</li>
                    <li class="navUser tab  col l2" id="navMessagerie">Messagerie</li>
                </ul>
            </div>
        </article>
    </article>
    <section id="sectionVendeur">

    </section>
</main>
