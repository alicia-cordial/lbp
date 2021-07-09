<header class="grey darken-3">
    <nav class="grey darken-3 z-depth-0">
        <div class="nav-wrapper">
            <a href="#" data-target="mobile-demo" class="sidenav-trigger">
                <i class="material-icons">menu</i></a>
            <ul class="nav-center hide-on-med-and-down">

                <!--                DROPDOWN -->
                <?php if (!isset($_SESSION['user'])) : ?>
                    <li class="liNav"><a class="grey-text" href="compte">COMPTE</a></li>
                <?php else : ?>
                    <li class="liNav"><a class="grey-text dropdown-trigger" href=""
                                         data-target='compteDropdown'>COMPTE</a></li>
                    <ul id='compteDropdown' class='dropdown-content'>

                        <?php if ($_SESSION['user']['droit'] === '1') : ?>
                            <li><a href="compte" class="grey-text"> ESPACE ADMIN</a></li>
                        <?php elseif ($_SESSION['user']['status'] === 'vendeur') : ?>
                            <li><a href="compte" class="grey-text"> ESPACE VENDEUR</a></li>
                        <?php elseif ($_SESSION['user']['status'] === 'client') : ?>
                            <li><a href="compte" class="grey-text"> ESPACE CLIENT</a></li>
                        <?php endif; ?>
                        <li><a href="" class="logoutButton grey-text">DECONNEXION</a></li>
                    </ul>
                <?php endif; ?>
                <li><a href="compte"> + </a></li>
                <li class="liNav">
                    <div class="input-field" id="headerSearch">
                        <input type="text" class="input_index article_search"
                               placeholder="RECHERCHE">
                    </div>
                    <!--AUTOCOMPLETION RESULTATS-->
                    <ul class="result">
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <!--SIDE NAV-->
    <ul class="sidenav" id="mobile-demo">
        <li><a href="home">Home</a></li>
        <li><a href="compte">Compte</a></li>
        <li><a href="compte"> Déposer une annonce </a></li>
        <?php if (isset($_SESSION['user'])) : ?>
            <li><a class="logoutButton"> Se déconnecter </a></li>
        <?php endif; ?>
        <li>
            <div class="input-field" id="headerSearch">
                <input type="text" class="input_index article_search"
                       placeholder="RECHERCHE">
            </div>
            <!--AUTOCOMPLETION RESULTATS-->
            <ul class="result">
            </ul>
        </li>
    </ul>

    <!--TITLE-->
    <div id="secondNav" class="grey darken-3 nav-center">
        <div class="nav-wrapper">
            <a href="home">CAVE OF WONDERS</a>
            <p class=" grey-text text-lighten-2 "><em>eternity in luxury</em></p>
        </div>
    </div>

</header>
<?php if (isset($_SESSION['user'])) : ?>
    <ul class="collapsible" id="notification_dropdownContainer">
        <li>
            <div class="collapsible-header"></div>
            <div class="collapsible-body disabled" id="notification_dropdown"></div>
        </li>
    </ul>
<?php endif;?>


