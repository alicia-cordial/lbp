<?php

require_once("apiAutoloader.php");

if (isset($_POST['action']) && $_POST['action'] === 'showConversation') {
    $messages = $userModel->selectMessagesConversation($_POST['idDestinataire'], $_SESSION['user']['id']);
    echo json_encode($messages, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

if (isset($_POST['action']) && $_POST['action'] === 'sendNewMessage') {
    $message = $userModel->sendNewMessage($_POST['idDestinataire'], $_SESSION['user']['id'], htmlspecialchars($_POST['messageContent']));
    echo json_encode($message, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

if (isset($_POST['action']) && $_POST['action'] === 'selectContacts') {
    $contacts = $userModel->selectContacts($_SESSION['user']['id']);
    if ($contacts) {
        echo json_encode($contacts, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode('none', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}


if (isset($_POST['view'])) {

    $notifications = $userModel->fetchNotif($_SESSION['user']['id']);
    if (!empty($notifications)) {
        echo json_encode($notifications, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode('none', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    if ($_POST['view'] == 'yes') {
        $dismiss = $userModel->dismissNotif($_SESSION['user']['id']);
    }
}
//
//var_dump($_SESSION['user']['id']);
//var_dump($userModel->fetchNotif($_SESSION['user']['id']));