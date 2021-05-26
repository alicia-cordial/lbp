<main>

<div class="form_rechercheavancee">


    <section id="objet">
    
    <span id="form_vendeur">Vendeur</span>  

        <form id="form_autocompleteavancee" class="form_index"  method="post">
            <label for="nom">Categories</label>
            <select id="nom" name="nom"> 
                <option>Voiture</option>
                <option>Bijoux</option>
                <option>Vêtements</option>
            </select>
            <input type="text" name="titre" class="input_index" id="search_all" placeholder="Que recherchez-vous ?">
            <input type="text" name="zip" class="search_zip" id="search_zip" placeholder="Quelle région?">    
        <button type="submit" value="Submit">Submit</button>
        </form>

    </section>

    <section id="vendeur">
    
    <span id="form_objet">Objet</span>
        
        <form id="form_usersearch" class="form_index"  method="post">
            <input type="text" name="user" class="input_user" id="search_user" placeholder="Qui recherchez-vous ?">
            <input type="text" name="zip" class="search_zip" id="search_zip" placeholder="Quelle région?">    
            <button type="submit" value="submit">Submit</button>
        </form>

    </section>
</div>

<div>
    <div id="result_search"></div>
</div>

</main>
