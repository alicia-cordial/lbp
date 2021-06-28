<!--<header>
    <p>Header</p>
    <a href="home">Home</a>
    <a href="compte">Compte</a>
    <?php /*if (isset($_SESSION['user']['id'])) : */ ?>
    <a href="sessiondestroy.php">Déconnexion</a>
    <?php /*endif; */ ?>
<section id="mainAutocompletion">
<div class="form_recherche">

<form id="form_autocomplete" class="form_autocomplete"  method="get" >
        <input type="text" name="search" class="input_index" id="article_search" placeholder="Que recherchez-vous ?">
      </form>
</div>

<div>
    <div id="result"></div>
</div>
</section>
</header>-->

<header class="grey darken-3">
    <nav class="grey darken-3 z-depth-0">
        <div class="nav-wrapper">
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="nav-center hide-on-med-and-down">
                <?php if (!isset($_SESSION['user'])) : ?>
                    <li class="liNav"><a class="grey-text" href="compte">COMPTE</a></li>
                <?php else : ?>
                    <li class="liNav"><a class="grey-text dropdown-trigger" href="" data-target='compteDropdown'>COMPTE</a></li>
                    <ul id='compteDropdown' class='dropdown-content'>
                        <li><a href="compte" class="grey-text">COMPTE</a></li>
                        <li><a href="" class="logoutButton grey-text">DECONNEXION</a></li>
                    </ul>
                <?php endif; ?>
                <li><a href="compte"> + </a></li>
                <li class="liNav">
                    <form id="form_autocomplete" class="form_autocomplete" method="get">
                        <div class="input-field">
                            <input type="text" name="search" class="input_index" id="article_search"
                                   placeholder="RECHERCHE">
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
        <li><a href="home">Home</a></li>
        <li><a href="compte">Compte</a></li>
        <li><a href=""> Déposer une annonce </a></li>
        <?php if (isset($_SESSION['user'])) : ?>
            <li><a class="logoutButton"> Se déconnecter </a></li>
        <?php endif; ?>
        <li>
            <div class="form_recherche">
                <form id="form_autocomplete" class="form_autocomplete" method="get">
                    <div class="input-field">
                        <input type="search" name="search" class="input_index" id="article_search"
                               placeholder="Recherche">
                        <i class="material-icons">close</i>
                    </div>
                </form>
            </div>
        </li>
    </ul>

    <div id="secondNav" class="grey darken-3 nav-center">
        <div class="nav-wrapper">
            <a href="home">CAVE OF WONDERS</a>
            <p class=" grey-text text-lighten-2 "><em>eternity in luxury</em></p>
        </div>
    </div>

</header>