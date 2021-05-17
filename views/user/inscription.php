<main id="mainCompte">
    <article>
        <h2>INSCRIPTION</h2>
    </article>
    <article class="form">
        <form id="formInscription">
            <div class="formBloc" id="bloc1">
                <p>Vous êtes...</p>
                <div id="formRadio">
                    <input type="radio" name="status" value="vendeur">
                    <label for="vendeur">vendeur.se</label>
                    <input type="radio" name="status" value="client">
                    <label for="client">client.e</label>
                </div>
            </div>

            <div class="formBloc" id="bloc2">
                <input type="text" id="login" name="login" placeholder="identifiant">
                <input type="password" id="password" name="password" placeholder="mot de passe">
                <input type="password" id="password2" name="password2" placeholder="confirmez votre mot de passe">
                <p><em>*Le mot de passe doit comporter au moins 6 caractères, un caractère spécial et un chiffre.</em>
                </p>
            </div>

            <div class="formBloc" id="bloc3">
                <input type="email" id="email" name="email" placeholder="email">
                <input type="text" pattern="[0-9]{5}" id="zip" name="zip" placeholder="code postal">
                <button type="submit">S'inscrire</button>
            </div>
        </form>

        <div class="formInfo">
            <div id="message"></div>
        </div>
    </article>
    <p>Vous avez déjà un compte ? <span class="callForm" >Connectez-vous.</span></p>
</main>