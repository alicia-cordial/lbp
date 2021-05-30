<?php
session_start();
require_once('../models/Database.php');
require_once('../models/UserModel.php');
$model = new UserModel();


if (isset($_POST['action']) && $_POST['action'] === 'showConversation') {
    $messages = $model->selectMessagesConversation($_POST['idDestinataire'], $_SESSION['user']['id']);
    echo json_encode($messages, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

