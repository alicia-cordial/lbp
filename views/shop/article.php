<?php var_dump($_GET);?>
<main id="mainAutocompletion">

<h2>RESULTATS RECHERCHE</h2>

         <article class="recherche_cont">

           <section class="recherche_nom">
           <h2> <?php echo $searchone['titre']; ?> </h2>
           </section>

           <section class="recherche_desc">
           <p> <?php echo substr($searchone['description'], 0, 200) . "... <br>" ; ?>
           <?php echo "<a href='element.php?id=". $donnees['id'] ."'> Lien vers l'article </a>" ."<br>"; ?> </p>
           </section>
         
          </article>
 
    </main>