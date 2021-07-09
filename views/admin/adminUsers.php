<article>
    <p class="center">Nombre d'inscrit.es : <span id="nbInscrits"></span></p><br>
    <div id="showUsersContainer">
        <span class="showUsers" value="">Tous.tes</span>
        <span class="showUsers" value="client" ">Acheteur.ses</span>
        <span class="showUsers" value="vendeur">Vendeur.ses</span>
    </div>
</article>

<table id="listeUsersTries" class="centered highlight">
    <thead>
    <tr>
        <th>Identifiant</th>
        <th>Statut</th>
        <th>Nombre d'articles vendus</th>
        <th>Date d'inscription</th>
        <th>Message</th>
        <th>Email</th>
        <th>Supprimer</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<section class="section"></section>
<article id="infoAdmin" class="center container">
</article>
<section class="section"></section>
<div id="ex1" class="modal">
    <div id="nameDestinataire">A :</div>
    <form id='newMessage' class="form">
        <textarea class="materialize-textarea" required placeholder="Votre message"></textarea>
        <button class="btn grey darken-3 waves-effect waves-light" type="submit" name="action">Envoyer
            <i class="material-icons right">send</i>
        </button>
    </form>
</div>