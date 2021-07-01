<article class="container center">
    <a id="addNewCat" class="btn-floating btn-flat waves-effect waves-light"><i class="material-icons">add</i></a>
</article>
<article class="container center">
    <div class="center toggleCat" id="toggleVide"><h4 >Catégories Vides</h4></div>
    <table id="categoriesVides" class="striped centered">
        <thead>
        <th>Nom</th>
        <th>Supprimer</th>
        </thead>
        <tbody></tbody>
    </table>
    <div class="center toggleCat" id="toggleFull"><h4>Catégories</h4></div>
    <table id="categories" class="striped">
        <thead>
        <th>Nom</th>
        <th>Articles</th>
        <th>Modifier</th>
        </thead>
        <tbody></tbody>
    </table>
</article>

<article id="articlesTries">

</article>

<article id="infoAdmin">

</article>

<div id="ex1" class="modal">
    <div id="nameDestinataire"></div>
    <form id='newMessage'>
        <input placeholder='votre message' required>
        <button type='submit'>Envoyer</button>
    </form>
    <div id="infoMessage"></div>
    <a href="#" rel="modal:close">Close</a>
</div>