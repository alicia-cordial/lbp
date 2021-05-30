<section id="sectionVendeur">
    <article>
        <h3>Déposer une nouvelle annonce</h3>
        <form id="formNewArticle">
            <input type="text" id="titre" name="titre" placeholder="titre">
            <label for="titre">Titre</label>

            <textarea id="description" name="description" placeholder="description"></textarea>

            <input type="number" id="prix" name="prix" placeholder="prix" min="1" max="1000000000">
            <label for="prix"> € </label>

            <select name="etat">
                <?php foreach ($etats as $etat): ?>
                    <option><?= $etat ?></option>
                <?php endforeach; ?>
            </select>

            <select name="categorie">
                <?php foreach ($categories as $categorie) : ?>
                    <option value="<?= $categorie['id'] ?>"><?= $categorie['nom'] ?></option>
                <?php endforeach; ?>
                    <option id="autreCat" value="autre">autre</option>
            </select>

            <div id="negociation">
                <input type="radio" name="negociation" value="oui">
                <label for="oui">Prix négociable</label>
                <input type="radio" name="negociation" value="non">
                <label for="non">Prix ferme</label>
            </div>

<!--            INPUT PHOTO-->
            <button type="submit">Créer l'annonce</button>
        </form>

        <div class="formInfo">
            <div id="message"></div>
        </div>

    </article>
</section>