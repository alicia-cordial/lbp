<?php session_start(); ?>
    <article id="articleForm">
        <h3>VOTRE PROFIL</h3>
        <h4>IDENTIFIANT : <?= $_SESSION['user']['identifiant'] ?></h4>
        <h5>Date d'Inscription : <?= $_SESSION['user']['date_inscription'] ?></h5>
        <form id="formUpdateUser">
            <div>
                <label for="login">login</label>
                <input type="text" id="login" name="login" value="<?= $_SESSION['user']['identifiant'] ?>">
            </div>
            <div id="formRadio">
                <input type="radio"
                       name="status" <?php if ($_SESSION['user']['status'] == 'vendeur'): ?> checked class="originalStatus" <?php endif; ?>
                       value="vendeur">
                <label for="vendeur">vendeur.se</label>
                <input type="radio"
                       name="status" <?php if ($_SESSION['user']['status'] == 'client'): ?> checked class="originalStatus" <?php endif; ?>
                       value="client">
                <label for="client">client.e</label>
                <p id="statusInfo">Attention ! La modification de votre statut rendra certaines fonctionnalités
                    indisponibles.</p>
            </div>
            <div>
                <input type="password" id="password" name="password" placeholder="mot de passe">
                <input type="password" id="password2" name="password2" placeholder="confirmez votre mot de passe">
                <p><em>*Le mot de passe doit comporter au moins 6 caractères, un caractère spécial et un chiffre.</em>
            </div>
            <div>
                <input type="email" id="email" name="email" placeholder="email"
                       value="<?= $_SESSION['user']['mail'] ?>">
                <input type="text" pattern="[0-9]{5}" id="zip" name="zip" placeholder="code postal"
                       value="<?= $_SESSION['user']['zip'] ?>">
                <button type="submit">Modifier vos informations</button>
            </div>
        </form>
    </article>
    <div class="formInfo">
        <div id="message"></div>
    </div>
