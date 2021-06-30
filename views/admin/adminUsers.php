<article>
    <!--    <p>Nombre d'inscrit.es : </p>-->
    <div id="showUsersContainer">
        <span class="showUsers" value="">Tous.tes</span>
        <span class="showUsers" value="client" ">Acheteur.ses</span>
        <span class="showUsers" value="vendeur">Vendeur.ses</span>
    </div>
</article>

<table id="listeUsersTries" class="center">
    <thead>
    <tr>
        <th>Identifiant</th>
        <th>Statut</th>
        <th>Date d'inscription</th>
        <th>Contact</th>
        <th>Supprimer</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<article id="infoAdmin">

</article>

<div id="ex1" class="modal">
    <div id="nameDestinataire">A : </div>
    <form id='newMessage' class="form">
        <textarea class="materialize-textarea" required placeholder="Votre message"></textarea>
        <button class="btn grey darken-3 waves-effect waves-light" type="submit" name="action">Envoyer
            <i class="material-icons right">send</i>
        </button>
    </form>
    <div id="infoMessage"></div>
</div>