

<main class="main_recherche">
      <?php
       while ($donnees = $query->fetch()){ ?>
         <article class="recherche_cont">

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
 </main>
