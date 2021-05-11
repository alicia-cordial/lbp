<main id="mainCompte">
    <article>
        <h2>INSCRIPTION</h2>
    </article>
    <article id="form">
        <form method="post" class="formModule">
            <div>
                <input type="email" id="email" name="email" placeholder="email">
                <input type="password" id="password" name="password" placeholder="mot de passe">
            </div>
            <div>
                <input type="text" name="login">
            </div>
        </form>

        <div class="formInfo">
            <button id="formConnexion">S'inscrire</button>
            <div id="message"></div>
        </div>
    </article>
    <p>Vous avez déjà un compte ?  <span onclick="changeForm()">Connectez-vous.</span></p>
</main>