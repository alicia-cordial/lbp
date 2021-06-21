<main id="mainCompte">
    <section class="container center">
        <article>
            <h2>INSCRIPTION</h2>
        </article>
        <article class="form row">
            <form id="formInscription">

                <div class="row">
                    <div class="formBloc input-field col s12" id="bloc1">
                        <p>Vous êtes...</p>

                        <div id="formRadio">
                            <p>
                                <label>
                                    <input name="status" type="radio" value="vendeur" />
                                    <span>vendeur.se</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name="status" type="radio" value="client"/>
                                    <span>acheteur.se</span>
                                </label>
                            </p>

                         <!--   <input type="radio" name="status" value="vendeur">
                            <label for="vendeur">vendeur.se</label>
                            <input type="radio" name="status" value="client">
                            <label for="client">acheteur.se</label>-->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="formBloc input-field col s12" id="bloc2">
                        <input type="text" id="login" name="login" placeholder="identifiant">
                        <input type="password" id="password" name="password" placeholder="mot de passe">
                        <input type="password" id="password2" name="password2"
                               placeholder="confirmez votre mot de passe">
                        <p><em>*Le mot de passe doit comporter au moins 6 caractères, un caractère spécial et un
                                chiffre.</em></p>
                    </div>
                </div>

                <div class="row">
                    <div class="formBloc input-field col s12" id="bloc3">
                        <input type="email" id="email" name="email" placeholder="email">
                        <input type="text" pattern="[0-9]{5}" id="zip" name="zip" placeholder="code postal">
                        <button class="btn indigo darken-1 waves-effect waves-light" type="submit" name="action">S'inscrire
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
            <p>Vous avez déjà un compte ? <span class="callForm">Connectez-vous.</span></p>
        </article>
    </section>
</main>