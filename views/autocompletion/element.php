<?php

include("models/Database.php");

    $id = $_GET['id'];
    $req = $pdo->prepare(" SELECT * FROM article WHERE id = '$id' ");
    $req->execute();
    $article = $req->fetch();

var_dump($article);
?>


<main class="main_element">

        <section id="element_article">
            <h2> <?php echo $article['titre']; ?> </h2>
            <p> <?php echo $article['description']; ?> </p>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>