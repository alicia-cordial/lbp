<?php
session_start();
require_once('../models/Database.php');
require_once('../models/UserModel.php');
$model = new UserModel();


if (isset($_POST['action']) && $_POST['action'] === 'showConversation') {
    $messages = $model->selectMessagesConversation($_POST['idDestinataire'], $_SESSION['user']['id']);
    echo json_encode($messages, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

if (isset($_POST['action']) && $_POST['action'] === 'sendNewMessage') {
    $message = $model->sendNewMessage($_POST['idDestinataire'], $_SESSION['user']['id'], htmlspecialchars($_POST['messageContent']));
    echo json_encode($message, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

if (isset($_POST['action']) && $_POST['action'] === 'selectContacts') {
    $contacts = $model->selectContacts($_SESSION['user']['id']);
    if ($contacts) {
        echo json_encode($contacts, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode('none', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}