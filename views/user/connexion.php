<main id="mainCompte">
    <section class="container center">
        <article>
            <h2>CONNEXION</h2>
        </article>

        <article class="form row">
            <form id="formConnexion">
                <div class="row">
                    <div class="formBloc input-field col s12" id="bloc1">
                        <input type="text" id="login" name="login" placeholder="email ou identifiant">
                    </div>
                </div>
                <div class="row">
                    <div class="formBloc input-field col s12" id="bloc2">
                        <input type="password" id="password" name="password" placeholder="mot de passe">
                        <button class="btn grey darken-3 waves-effect waves-light" type="submit" name="action">Se connecter
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>

            <div class="formInfo">
                <div id="message"></div>
            </div>
        </article>

        <article>
            <p>Vous n'avez pas encore de compte ? <span class="callForm" id="callFormInscription">Inscrivez-vous.</span></p>
        </article>
    </section>
</main>