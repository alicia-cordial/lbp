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
    </tr>
    </thead>

    <tbody>
    <?php foreach ($users as $user) {
        ?>
        <tr>
            <td><?= $user['identifiant']; ?></td>
            <td><?= $user['mail']; ?></td>
            <td><?= $user['zip']; ?></td>
            <td><?= $user['date_inscription']; ?></td>
        </tr>

    <?php } ?>

    </tbody>
</table>