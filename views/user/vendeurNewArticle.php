<article class="form container row center">
    <form id="formNewArticle" enctype="multipart/form-data">
        <div class='preview'>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input type="text" id="titre" name="titre" placeholder="titre">
                <textarea class="materialize-textarea" id="description" name="description"
                          placeholder="description"></textarea>
            </div>
            <div class="col s12">
                <div class="input-field inline">
                    <input type="number" id="prix" name="prix" placeholder="prix" min="1" max="1000000000">

                </div>
                <span> €</span>
            </div>
            <div id="negociation" class="input-field col s12">
                <p>
                    <label>
                        <input name="negociation"
                               type="radio"
                               value="oui"/>
                        <span>Prix négociable</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input name="negociation"
                               type="radio"
                               value="non"/>
                        <span>Prix ferme</span>
                    </label>
                </p>
            </div>
        </div>
        <div class="row">
            <input type="file" id="file" name="file" />
            <a class="btn-small uploadPic" value="" id="uploadPicNew">Upload</a>
            <div id="messageFile"></div>
        </div>

        <div class="row">
            <div class="input-field col s8 offset-s2">
                <select name="etat">
                    <?php foreach ($etats as $etat): ?>
                        <option><?= $etat ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col s8 offset-s2">
                <span>Catégorie :</span>
                <div class="input-field inline">
                    <select name="categorie">
                        <?php foreach ($categories as $categorie): ?>
                            <option value="<?= $categorie['id'] ?>"><?= $categorie['nom'] ?></option>
                        <?php endforeach; ?>
                        <option id="autreCat" value="autre">Autre Catégorie</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <button class="btn indigo darken-1 waves-effect waves-light" type="submit">Créer l'annonce
                <i class="material-icons right">send</i>
            </button>
        </div>

    </form>

    <div class="formInfo">
        <div id="message"></div>
    </div>
</article>