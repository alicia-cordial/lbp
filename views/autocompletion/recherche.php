<?php
include("models/Database.php");
// Afficher les résultats de recherche provenant du formulaire de l'index
if(isset($_GET['search'])){

  $search = $_GET['search'];

  $query = $db->query("SELECT * FROM article WHERE titre LIKE '%$search%'");
  ?>



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
  }else{
    //header('Location:home.php');
  echo "erreur";
  } ?>
 </main>

 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>