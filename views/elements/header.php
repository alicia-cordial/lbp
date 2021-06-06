<header>
    <p>Header</p>
    <a href="home">Home</a>
    <a href="compte">Compte</a>
    <?php if (isset($_SESSION['user']['id'])) : ?>
    <a href="sessiondestroy.php">Déconnexion</a>
    <?php endif; ?>
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
</header>