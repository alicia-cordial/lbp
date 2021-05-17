

<main id="form" class="main_index">
      <form id="form_autocomplete" class="form_autocomplete" action="home.php" method="get">
        <input type="text" name="search" class="input_index" id="article" placeholder="Que recherchez-vous ?">
      </form>

           <?php
       while ($donnees = $query->fetch()){ ?>

         <article id="recherche" class="recherche_cont">

           <section class="recherche_nom">
           <h2> <?php echo $donnees['titre']; ?> </h2>
           </section>

           <section class="recherche_desc">
           <p> <?php echo substr($donnees['description'], 0, 200) . "... <br>" ; ?>
           <?php echo "<a href='element.php?id=". $donnees['id'] ."'> Lien vers l'article </a>" ."<br>"; ?> </p>
           </section>
         
          </article>
<?php
   }
?>


      <section id="element_article">

          <h2> <?php echo $article['titre']; ?> </h2>   
          <p> <?php echo $article['description']; ?> </p>
</section>
</main>
  
  