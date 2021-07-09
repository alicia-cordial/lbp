<article class="container center">
    <a id="addNewCat" class="btn-floating btn-flat waves-effect waves-light"><i class="material-icons">add</i></a>
</article>

<article class="container center">
    <div class="center toggleCat" id="toggleVide"><h4>Catégories Vides</h4></div>
    <table id="categoriesVides" class="striped centered">
        <thead>
        <th>Nom</th>
        <th>Supprimer</th>
        </thead>
        <tbody></tbody>
    </table>

    <div class="center toggleCat" id="toggleFull"><h4>Catégories</h4></div>
    <table id="categories" class="striped centered">
        <thead>
        <th>Nom</th>
        <th>Voir</th>
        <th>Modifier</th>
        </thead>
        <tbody></tbody>
    </table>
</article>


<article id="infoAdmin">

</article>
<div class="modal" id="modalArticlesTries">
    <h3 class="center"></h3>
<table id="articlesTries" class="striped centered">
    <thead>
    <th>Titre</th>
    <th>Photo</th>
    <th>Date d'ajout</th>
    <th>Vendeur.se</th>
    <th>Contact</th>
    <th>Supprimer</th>
    </thead>
    <tbody>
    </tbody>
</table>
</div>

<div id="ex1" class="modal">
    <div id="nameDestinataire">A :</div>
    <form id='newMessage' class="form">
        <textarea class="materialize-textarea" required placeholder="Votre message"></textarea>
        <button class="btn grey darken-3 waves-effect waves-light" type="submit" name="action">Envoyer
            <i class="material-icons right">send</i>
        </button>
    </form>
</div>