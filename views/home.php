<main>

<div class="form_rechercheavancee">


    <section id="objet">
    
    <span id="formVendeur">Vendeur</span>

        <form id="form_objet" class="form_index"  method="get">
            <label for="categorie">Categories</label>
            <select id="categorie" name="categorie"> 
                <option>Voiture</option>
                <option>Bijoux</option>
                <option>Vêtements</option>
            </select>
            <input type="text" name="titre" id="titre" placeholder="Que recherchez-vous ?">
            <input type="text" name="zip" id="zip" placeholder="Quelle région?">  

            <input type="range" min="1" max="10000" value="10" class="myslider" id="sliderRange">
            <p>Value: <span id="demo"></span></p>


        <button type="submit">Submit</button>
        

        </form>
</div>


    </section>

    <section id="vendeur">
    
    <span id="formObjet">Objet</span>
        
        <form id="form_vendeur" class="form_index"  method="post">
            <input type="text" name="user" id="user" placeholder="Qui recherchez-vous ?">
           <!-- <input type="text" name="zip" id="zip" placeholder="Quelle région?">    -->
        </form>

    </section>
</div>

<div>
    <div id="message"></div>
</div>

</main>
