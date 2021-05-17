<?php
require_once('../models/Database.php');
require_once('../models/UserModel.php');
$model = new UserModel();

/*INSCRIPTION*/
if (isset($_POST['form']) && $_POST['form'] === 'inscription') {
    if (!empty($_POST['status']) && !empty($_POST['login']) && !empty($_POST['zip']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password2'])) {
        $status = htmlspecialchars($_POST['status']);
        $login = htmlspecialchars($_POST['login']);
        $zip = htmlspecialchars($_POST['zip']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['password2']);
        $errors = [];
        $userExists = $model->userExists($login, $email);


//VERIFICATIONS
        if (!empty($userExists)) {
            $errors[] = 'Cet email est déjà lié à un compte.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Cet email n\'est pas valide';
        }
        if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
            $errors[] = 'Le mot de passe n\'est pas suffisamment sécurisé.';
        }
        if ($password != $password2) {
            $errors[] = 'Les mots de passe sont différents.';
        }

        if (empty($errors)) {
            $hashedpassword = password_hash($password, PASSWORD_BCRYPT);
            $insert = $model->insertUser($status, $login, $zip, $email, $hashedpassword);
            if ($insert) {
                $result = ['success'];
            } else {
                $result = ['Un problème est survenu.'];
            }
            echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } else {
            echo json_encode($errors, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    } else {
        $errors = ['Veuillez remplir tous les champs SVP'];
        echo json_encode($errors, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}


/*CONNEXION*/
if (isset($_POST['form']) && $_POST['form'] === 'connexion') {
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        $userExists = $model->userExists($login, $login);

        if (!empty($userExists)) {
            if (password_verify($password, $userExists["mdp"]) || $password === $userExists["mdp"]) {
                session_start();
                $_SESSION['user'] = $userExists['identifiant'];
                $_SESSION['id'] = $userExists['id'];
                $result = ['success'];
            } else {
                $result = ['Vérifiez votre mot de passe'];
            }
            echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } else {
            $error = ['Vérifiez votre login ou email'];
            echo json_encode($error, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    } else {
        $errors = ['Veuillez remplir tous les champs SVP'];
        echo json_encode($errors, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}