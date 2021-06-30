<form class="form container" id="formNewArticle">
    <div value="" class='preview update'></div>

    <div class="row center">
        <input type="file" id="file" name="file"/>
        <a class="btn-small grey darken-3 uploadPic" value="" id="uploadPicNew">Upload</a>
        <div id="messageFile"></div>
    </div>

    <div class="row">
        <div class="input-field col s12">
            <input type="text" id="titre" name="titre" placeholder="titre">
        </div>
        <div class="input-field col s12 l6">
            <i class="material-icons prefix">euro_symbol</i>
            <input type="number" id="prix" name="prix" placeholder="prix" min="1" max="1000000000">
        </div>

        <div id="negociation" class="input-field  right-align col  s12 l6">
            <p>
                <label>
                    <input name="negociation"
                           type="radio" value="oui"/>
                    <span>Prix négociable</span>
                </label>
            </p>
            <p>
                <label>
                    <input name="negociation"
                           type="radio" value="non"/>
                    <span>Prix ferme</span>
                </label>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
                 <textarea class="materialize-textarea" id="description" name="description"
                           placeholder="description"></textarea>
        </div>
    </div>

    <div class="row center">
        <div class="col s12 l4">
            <span>Etat : </span>
            <div class="input-field inline">
                <select name="etat">
                    <?php foreach ($etats as $etat): ?>
                        <option><?= $etat ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col s12 l4">
            <span>Catégorie : </span>
            <div class="input-field inline">
                <select name="categorie">
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?= $categorie['id'] ?>"><?= $categorie['nom'] ?></option>
                    <?php endforeach; ?>
                    <option id="autreCat" value="autre">Autre</option>
                </select>
            </div>
        </div>
        <div class="col s12 l4">
            <br>
            <button class="btn grey darken-3 waves-effect waves-light" type="submit">Créer l'annonce
                <i class="material-icons right">send</i>
            </button>
        </div>
    </div>
</form>
<div id="message" class="center"></div>
<div class="section"></div>