<main id="mainCompte">
    <?php var_dump($_SESSION);?>
    <article>
        <h2>ESPACE PERSONNEL - Vendeur</h2>
        <h3><?= $_SESSION['user']['identifiant'] ?></h3>
        <ul>
            <li class="navUser navNewArticle">Déposer une nouvelle annonce</li>
            <li class="navUser" id="navArticleSelling">Articles en vente</li>
            <li class="navUser" id="navSoldArticle">Historique de vente</li>
            <li class="navUser" id="navMessagerie">Messagerie</li>
            <li class="navUser" id="navUpdateProfil">Modifier le profil</li>
        </ul>
    </article>
    <section id="sectionVendeur">

    </section>
</main>
