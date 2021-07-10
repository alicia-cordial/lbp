<?php

if (isset($_GET['id'])) {
    $model = new Shop();
    $id = htmlspecialchars($_GET['id']);
    $articles = $model->selectArticlesCategorie($id);

    $article = $model->showAllarticlesCat($id);
    if(!$articles) {
        header('location: home');
    }
   
}



?>
  <?php foreach ($article as $art) : ?>
        <?php if ($art['visible'] == 1) : ?>
            <div class="col s12 m7">
                <div class="card small horizontal">
                    <div class="card-image">
                        <img src="img/articles/<?= $art['photo'] ?>">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content articleCard">
                            <span class="card-title"> <a class="grey-text goldHover" href="article?id=<?= $art['id_article'] ?>"><?= $art['titre'] ?></a></span>
                            <p><?= $art['prix'] ?> €</p>
                            
                        </div>
                        <div class="card-action">
                            <a class="grey-text" href="article?id=<?= $art['id_article'] ?>">Voir fiche</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>




<h3>FILTRES</h3>

     <!-- Page Content -->
     <form id="form3">
    <div>
        <div>
            <div>                    
                <div>
                    <p>Prix</p>
                    <p class="range-field">
                        <input type="range" id="test5" min="0" max="100000" />
                    </p>

                </div> 
                </div>
               
    

                <div>
     <p>titres</p>
     <?php foreach ($model->selectArticlesCategorie($id) as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= $cat['titre'] ?></option>
                    <?php endforeach;?>
                    <div>
                        <label>
                        <input type="checkbox"  />
                        <span value="<?php echo $cat['titre']; ?>"  > <?php echo $cat['titre']; ?></span>
                        </label>
                    </div>
                  
                    </div>
                </div>
                <div class="list-group">
     <p>Ville</p>
                
                    <div>
                    <label>
                        <input type="checkbox"  />
                        <span value="<?php echo $cat['ville']; ?>"  > <?php echo $cat['ville']; ?></span>
                    </label>
                    </div>
               
                </div>
    <div class="list-group">
     <p>État objet</p>
                
                    <div>
                    <label>
                        <input type="checkbox"  />
                        <span value="<?php echo $cat['etat_objet']; ?>"  > <?php echo $cat['etat_objet']; ?></span>
                    </label>
                    </div>
               
                </div>

            </div>
            <button type="submit">Submit</button>

     </form>

     <div id='search_section'>
     </div>