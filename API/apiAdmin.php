<?php

session_start();
require_once('../models/Database.php');
require_once('../models/AdminModel.php');
$model = new AdminModel();


if (isset($_POST['action']) && $_POST['action'] === 'showUsers') {
    $users = $model->showUsers($_POST['choice']);
    if (!empty($users)) {
        echo json_encode($users, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode('none', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
