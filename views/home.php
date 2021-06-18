<?php


   $model = new Shop();

    //var_dump($model->get_cat());


if(isset($_POST['submit'])){
    $model = new Shop();

      $articles = $model->selectResearch($search);

    $nom = htmlspecialchars($_POST['nom']);
    $titre = htmlspecialchars($_POST['titre']);    
    $zip = htmlspecialchars($_POST['zip']);



    //$articles = $model->selectObject($nom, $zip, $titre);
  
    
    echo '<pre>';
    var_dump($articles);
 
    echo'</pre>';
    }


    ?>

   
<main>

    <section id="objet" class="form">

    <span id="formVendeur">Vendeur</span>

        <form id="form_objet" class="form_index"  method="post" >

            <label for="nom">Categories</label>
          
            <select name="rechercher" id="nom">
                        <option value="">--Options--</option>
                        <?php foreach ($model->get_Cat() as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= $cat['nom'] ?></option>
                        <?php endforeach; ?>
                    </select>

            <input type="text" name="rechercher"  id="titre" placeholder="Que recherchez-vous ?">
            
            <input type="text" name="rechercher"  id="zip" placeholder="Quelle région?">  

            <input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="65000" />
                    <p id="price_show">1000 - 65000</p>
                    <div id="price_range"></div>
                </div>    
                <div class="list-group">

            <button type="submit" name="submit" value="submit">Submit</button>

        </form>

            <div id="message_form"></div>


    </section>


    <section id="vendeur">
        <span id="formObjet">Objet</span>
        <form id="form_vendeur" class="form_index" method="get">
            <input type="text" name="user" id="user" placeholder="Qui recherchez-vous ?">

        </form>
        <div>
            <div id="message"></div>
        </div>
    </section>

</main>
