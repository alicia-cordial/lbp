<form class="formUpdateArticle" id="<?= $article['id'] ?>">
    <input type="text" id="titre" name="titre" placeholder="titre" value="<?= $article['titre'] ?>">
    <label for="titre">Titre</label>
    <textarea id="description" name="description" placeholder="description"><?= $article['description'] ?></textarea>
    <input type="number" id="prix" name="prix" placeholder="prix" min="1" max="1000000000"
           value="<?= $article['prix'] ?>">
    <label for="prix"> € </label>
    <select name="etat">
        <?php foreach ($etats as $etat): ?>
            <option <?php if ($article['etat_objet'] === $etat): ?>  selected <?php endif; ?> ><?= $etat ?></option>
        <?php endforeach; ?>
    </select>
    <select name="categorie">
        <?php foreach ($categories as $categorie) : ?>
            <option <?php if ($article['id_categorie'] === $categorie['id']): ?> selected <?php endif; ?>
                    value="<?= $categorie['id'] ?>"><?= $categorie['nom'] ?></option>
        <?php endforeach; ?>
    </select>
    <div id="negociation">
        <input type="radio" <?php if ($article['ouvert_negociation'] === 'oui'): ?> checked  <?php endif; ?>
               name="negociation" value="oui">
        <label for="oui">Prix négociable</label>
        <input type="radio" <?php if ($article['ouvert_negociation'] === 'non'): ?> checked  <?php endif; ?>
               name="negociation" value="non">
        <label for="non">Prix ferme</label>
    </div>
    <button type="submit">Modifier l'annonce</button>
</form>

<div class="formInfo">
    <div id="message"></div>
</div>