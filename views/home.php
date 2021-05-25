<main>

<div class="form_rechercheavancee">

<form id="form_autocompleteavancee" class="form_autocompleteavancee"  method="get">
    <label for="cat">Categories</label>
    <select id="cat" name="cat"> 
        <option>Voiture</option>
        <option>Bijoux</option>
        <option>Vêtements</option>
    </select>
    <input type="text" name="search_all" class="input_index" id="search_all" placeholder="Que recherchez-vous ?">
    <input type="text" name="search_zip" class="search_zip" id="search_zip" placeholder="Quelle région?">    
</form>



<form id="form_usersearch" class="form_usersearch"  method="get">
    <input type="text" name="search_user" class="input_user" id="search_user" placeholder="Qui recherchez-vous ?">
    <input type="text" name="search_zip" class="search_zip" id="search_zip" placeholder="Quelle région?">    
</form>


</div>

<div>
    <div id="result_search"></div>
</div>

</main>
