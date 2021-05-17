<section id="recherche">
      <?php
      foreach ($this->recherche as $donnees)
       : ?>
         <article class="recherche_cont">

           <section class="recherche_nom">
           <h2> <?php echo $this->donnees['titre']; ?> </h2>
           </section>

           <section class="recherche_desc">
           <p> <?php echo substr($this->donnees['description'], 0, 200) . "... <br>" ; ?>
           <?php echo "<a href='recherche.php?id=". $donnees['id'] ."'> Lien vers l'article </a>" ."<br>"; ?> </p>
           </section>
         
          </article>
          <?php endforeach; ?>
 </section>

 <section id="element">
            <h2> <?php echo $article['titre']; ?> </h2>
            <p> <?php echo $article['description']; ?> </p>
  </section>
