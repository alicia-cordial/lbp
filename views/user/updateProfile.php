<?php session_start(); ?>
<section class="container center">
    <article>
        <h3>VOTRE PROFIL</h3>
        <h4>Bienvenue <?= $_SESSION['user']['identifiant'] ?></h4>
    </article>
    <article class="form row">
        <form id="formUpdateUser">

            <div class="row">
                <div class="formBloc input-field col s12">
                    <input type="text" placeholder="identifiant" id="login" name="login"
                           value="<?= $_SESSION['user']['identifiant'] ?>">
                </div>
                <div id="formRadio">
                    <p>
                        <label>
                            <input name="status"
                                   type="radio" <?php if ($_SESSION['user']['status'] === 'vendeur') {
                                echo "class='originalStatus' checked";
                            } ?> value="vendeur"/>
                            <span>vendeur.se</span>
                        </label>
                    </p>
                    <p>
                        <label>
                            <input name="status"
                                   type="radio" <?php if ($_SESSION['user']['status'] === 'client') {
                                echo "class='originalStatus' checked";
                            } ?> value="client"/>
                            <span>acheteur.se</span>
                        </label>
                    </p>
                </div>
                <p id="statusInfo">Attention ! La modification de votre statut rendra certaines fonctionnalités
                    indisponibles.</p>
            </div>
            <div class="row">
                <div class="formBloc input-field col s12">
                    <input type="password" id="password" name="password" placeholder="mot de passe">
                    <input type="password" id="password2" name="password2"
                           placeholder="confirmez votre mot de passe">
                    <p><em>*Le mot de passe doit comporter au moins 6 caractères, un caractère spécial et un
                            chiffre.</em>
                </div>
                <div class="formBloc input-field col s12">
                    <input type="email" id="email" name="email" placeholder="email"
                           value="<?= $_SESSION['user']['mail'] ?>">
                    <input type="text" pattern="[0-9]{5}" id="zip" name="zip" placeholder="code postal"
                           value="<?= $_SESSION['user']['zip'] ?>">
                    <button class="btn indigo darken-1 waves-effect waves-light" type="submit" name="action">Modifier
                        vos informations
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </article>
    <div class="formInfo">
        <div id="message"></div>
    </div>
