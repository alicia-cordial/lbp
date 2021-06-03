<main>

<span id="formVendeur">Vendeur</span>
    <section id="objet" class="form">

        <form id="form_objet" class="form_index"  method="post">
            <label for="nom">Categories</label>
            <select id="nom" name="nom"> 
                <option>Voiture</option>
                <option>Bijoux</option>

                <option>Vêtements</option>
            </select>
            <input type="text" name="titre" id="titre" placeholder="Que recherchez-vous ?">
            <input type="text" name="zip" id="zip" placeholder="Quelle région?">  

          
        <button type="submit" name="submit" value="submit">Submit</button>

        </form>


        <div class="formInfo">
            <div id="message_form"></div>
        </div>

    </section>



    <span id="formObjet">Objet</span>

    <section id="vendeur">
    
        
        <form id="form_vendeur" class="form_index"  method="get">
            <input type="text" name="user" id="user" placeholder="Qui recherchez-vous ?">
           <!-- <input type="text" name="zip" id="zip" placeholder="Quelle région?">    -->
        </form>
       
    </section>
</div>

<div>
    <div id="message"></div>
</div>


</main>

<!-- <input type="range" min="1" max="10000" value="10" class="sliderRange" id="sliderRange">
            <p>Value: <span id="demo"></span></p>-->
