<?php
if(isset($_GET['id'])){

    $model = new Shop();
  
    $id = htmlspecialchars($_GET['id']);
    $users = $model->showVendeur($id);
    //var_dump($users);
    }
    ?>
   
<h1>Profil Vendeur</h1>

<table>
    <thead>
    <tr>
        <th>Identifiant</th>
        <th>Mail</th>
        <th>Zip</th>
        <th>Date Inscription</th>
        <th>Titre</th>
   

    </tr>
    </thead>

    <tbody>
   
        <tr>
            <td><?= $users['identifiant']; ?></td>
            <td><?= $users['mail']; ?></td>
            <td><?= $users['zip']; ?></td>
            <td><?= $users['date_inscription']; ?></td>
            <td>       
                        <?php foreach ($model->showAllarticles($id) as $art): ?>
                            <p value="<?= $art['id'] ?>"><?= $art['titre'] ?></p>
                        <?php endforeach; ?>
                    </select></td>
            
        </tr>

  
    </tbody>
</table>