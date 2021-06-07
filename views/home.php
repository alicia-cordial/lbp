<?php
   $model = new Shop();

    //var_dump($model->get_cat());

    ?>
   
<main>




    <section id="objet" class="form">

    <span id="formVendeur">Vendeur</span>

        <form id="form_objet" class="form_index"  method="get" >

            <label for="nom">Categories</label>
          
            <select name="rechercher">
                        <option value="">--Options--</option>
                        <?php foreach ($model->get_Cat() as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= $cat['nom'] ?></option>
                        <?php endforeach; ?>
                    </select>

            <input type="text" name="titre"  id="rechercher" placeholder="Que recherchez-vous ?">
            
            <input type="text" name="zip"  id="rechercher" placeholder="Quelle région?">  

          
        <button type="submit" name="submit" value="submit">Submit</button>

        </form>
        <div class="formInfo">
            <div id="message_form"></div>
        </div>

    </section>


  


    

    <section id="vendeur">

    <span id="formObjet">Objet</span>
        
        <form id="form_vendeur" class="form_index"  method="get">
            <input type="text" name="user" id="user" placeholder="Qui recherchez-vous ?">
           
        </form>
        <div>
    <div id="message"></div>
</div>

    </section>
</div>



</main>
