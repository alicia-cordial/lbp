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

        <th>Zip</th>
        <th>Date Inscription</th>
        <th>Titre</th>
        <th>Mail</th>

    </tr>
    </thead>

    <tbody>
   
        <tr>
            <td><?= $users['identifiant']; ?></td>
            
            <td><?= $users['zip']; ?></td>
            <td><?= $users['date_inscription']; ?></td>
            <td>       
                        <?php foreach ($model->showAllarticles($id) as $art): ?>
                            <p value="<?= $art['id'] ?>"><?= $art['titre'] ?></p>
                        <?php endforeach; ?>
                    </select></td>
                    <td><a id =" <?= $users['id'] ?>" class='contactUser' href='#ex1' rel='modal:open'>Contacter le vendeur</a> </td>
        </tr>

  
    </tbody>
</table><div id="ex1" class="modal">
    <div id="idDestinataire" value="<?= $users['id']; ?>"></div>
    <div id="nameDestinataire" value="<?= $users['identifiant']; ?>"></div>
            <form id='newMessage'>
                <input placeholder='votre message' required>
                <button type='submit'>Envoyer</button>
        </form>
    <div id="infoMessage"></div>
        <a href="#" rel="modal:close">Close</a>
    </div>
