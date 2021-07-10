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
                            <span class="card-title"> <a class="grey-text goldHover"
                                                         href="article?id=<?= $art['id_article'] ?>"><?= $art['titre'] ?></a></span>
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




    <!-- Page Content -->
    <div class="container">
        <div class="row">
     
            <div class="col-md-3">                    
    <div class="list-group">
     <h3>Prix</h3>
     <input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="65000" />
                    <p id="price_show">1000 - 65000</p>
                    <div id="price_range"></div>
                </div>    
                <div class="list-group">


     <h3>Titre</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
     <?php

                    $query = "SELECT DISTINCT(titre) FROM article WHERE visible = '1' ORDER BY article.id DESC";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($articles as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector brand" value="<?php echo $row['titre']; ?>"  > <?php echo $row['titre']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>


    <div class="list-group">
     <h3>État Objet</h3>
                    <?php

                    $query = "
                    SELECT DISTINCT(etat_objet) FROM article WHERE visible = '1' ORDER BY titre DESC
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($articles as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector ram" value="<?php echo $row['titre']; ?>" > <?php echo $row['titre']; ?> GB</label>
                    </div>
                    <?php    
                    }

                    ?>
                </div>

            </div>

            <div class="col-md-9">
             <br />
                <div class="row filter_data">

                </div>
            </div>
        </div>

    </div>
