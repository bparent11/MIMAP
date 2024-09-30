<?php
error_reporting(E_ALL); // Affiche toutes les erreurs
ini_set('display_errors', 1); // Assure que les erreurs sont affichées
session_start();
require_once(__DIR__ . '/../db_connection.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>MIMAP</title>
    <link rel="icon" href="images/nv.png">
    <link href="styles/style.css" rel="stylesheet" >
    <link href="styles/welcome.css" rel="stylesheet">
</head>

<?php 
$postData = $_POST;
?>

<?php
/*CONNEXION*/
if (isset($postData['email']) && isset($postData['mdp'])) {
    if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
        $errorMessage='Il faut un email valide pour vous connecter.';
    } 
    else {
        $sql = "SELECT user_id, mdp, email, username FROM users";
        $stmt = $pdo->query($sql);

        $users = $stmt->fetchAll();

        foreach ($users as $user) {
            if (
                ($user['email'] === $postData['email'] &&
                password_verify($postData['mdp'], $user['mdp']))
            ) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['username'] = $user['username'];
                header('Location: index.php');
                exit();
            }
        }
    }
}

if (!isset($_SESSION['user_id'])) {
    $_SESSION['connexion_failed'] = True;
    $_SESSION['errorMessage'] ="L'email ou le mot de passe n'est pas valide.";
    header('Location: welcome.php');
    exit();
}

/*CONNEXION*/
?>