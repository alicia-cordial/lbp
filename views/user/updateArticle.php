<div id="modalContent">
    <form class="formUpdateArticle" id="<?= $article['id'] ?>">
        <div value="<?= $article['photo'] ?>" class='preview update'>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="text" id="titre" name="titre" placeholder="titre" value="<?= $article['titre'] ?>">
                <textarea class="materialize-textarea" id="description" name="description"
                          placeholder="description"><?= $article['description'] ?></textarea>
            </div>
            <div class="col s12">
                <div class="input-field inline">
                    <input type="number" id="prix" name="prix" placeholder="prix" min="1" max="1000000000"
                           value="<?= $article['prix'] ?>">

                </div>
                <span> €</span>
            </div>
            <div id="negociation" class="input-field col s12">
                <p>
                    <label>
                        <input name="negociation"
                               type="radio" <?php if ($article['ouvert_negociation'] === 'oui'): ?> checked  <?php endif; ?>
                               value="oui"/>
                        <span>Prix négociable</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input name="negociation"
                               type="radio" <?php if ($article['ouvert_negociation'] === 'non'): ?> checked  <?php endif; ?>
                               value="non"/>
                        <span>Prix ferme</span>
                    </label>
                </p>
            </div>
        </div>

        <div class="row">
            <input type="file" id="file" name="file"/>
            <a class="btn-small uploadPic" value="<?= $article['photo'] ?>" id="uploadPicUpdate">Upload</a>
            <div id="messageFile"></div>
        </div>

        <div class="row">
            <div class="input-field col s8 offset-s2">
                <select name="etat">
                    <?php foreach ($etats as $etat): ?>
                        <option <?php if ($article['etat_objet'] === $etat): ?>  selected <?php endif; ?> >
                            <?= $etat ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col s8 offset-s2">
                <span>Catégorie :</span>
                <div class="input-field inline">
                    <select name="categorie">
                        <?php foreach ($categories as $categorie): ?>
                            <option <?php if ($article['id_categorie'] === $categorie['id']): ?> selected
                                                                                                 <?php endif; ?>value="<?= $categorie['id'] ?>">
                                <?= $categorie['nom'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <button class="btn indigo darken-1 waves-effect waves-light" type="submit">Modifier l'annonce
                <i class="material-icons right">send</i>
            </button>
        </div>

    </form>

    <div class="formInfo">
        <div id="message"></div>
    </div>
</div>