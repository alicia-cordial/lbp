<div id="modalContent">
    <form class="form formArticle" id="<?= $article['id'] ?>">
        <div value="<?= $article['photo'] ?>" class='preview update'></div>

        <div class="row center">
            <input type="file" id="file" name="file"/>
            <a class="btn-small grey darken-3 uploadPic" value="<?= $article['photo'] ?>"
               id="uploadPicUpdate">Upload</a>
            <div id="messageFile"></div>
        </div>

        <div class="row">
            <div class="input-field col l6 s12">
                <input type="text" id="titre" name="titre" placeholder="titre" value="<?= $article['titre'] ?>">
            </div>
            <div class="input-field col s12 l3">
                <i class="material-icons prefix">euro_symbol</i>
                <input type="number" id="prix" name="prix" placeholder="prix" min="1" max="1000000000"
                       value="<?= $article['prix'] ?>">
            </div>

            <div id="negociation" class="input-field col s12 l3">
                <p>
                    <label>
                        <input name="negociation"
                               type="radio" <?php /*if ($article['ouvert_negociation'] === 'oui'): */ ?>
                               checked <?php /*endif; */ ?>
                               value="oui"/>
                        <span>Prix négociable</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input name="negociation"
                               type="radio" <?php /*if ($article['ouvert_negociation'] === 'non'): */ ?>
                               checked <?php /*endif; */ ?>
                               value="non"/>
                        <span>Prix ferme</span>
                    </label>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                 <textarea class="materialize-textarea" id="description" name="description"
                           placeholder="description"><?= $article['description'] ?></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col l4 s12">
                <span>Etat : </span>
                <div class="input-field inline">
                    <select name="etat">
                        <?php foreach ($etats as $etat): ?>
                            <option <?php if ($article['etat_objet'] === $etat): ?>  selected <?php endif; ?> >
                                <?= $etat ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col l4 s12">
                <span>Catégorie : </span>
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
            <div class="col l4 s12">
                <br><button class="btn grey darken-3 waves-effect waves-light" type="submit">Modifier l'annonce
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </div>
    </form>
</div>