<?php var_dump($_SESSION); ?>
<main id="mainCompte">
    <article>
        <h2>ESPACE PERSONNEL - Vendeur</h2>
        <ul>
            <li id="navNewArticle">Déposer une nouvelle annonce</li>
            <li id="navArticleSelling">Articles en vente</li>
            <li id="navSoldArticle">Historique de vente</li>
            <li id="navMessagerie">Messagerie</li>
            <li id="navUpdateProfil">Modifier le profil</li>
        </ul>
    </article>

    <section id="sectionVendeur">
       <article id="articlesSelling">
            <p>Articles en vente</p>
           <?php var_dump($userArticles); ?>

       </article>
    </section>
</main>
