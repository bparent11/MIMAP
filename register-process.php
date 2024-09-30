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
/*INSCRIPTION*/
if (isset($postData['email']) && isset($postData['username']) && isset($postData['mdp']) && isset($postData['mdp-2'])) {
    $email = $postData['email'];
    $username = $postData['username'];
    $_SESSION['email_used']=False;
    $_SESSION['username_used']=False;

    $sql = "SELECT COUNT(*) FROM users WHERE email= :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $count_email = $stmt->fetchColumn();

    $sql = "SELECT COUNT(*) FROM users WHERE username= :username";    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username]);
    $count_username = $stmt->fetchColumn();
    
    /*vérif mail pas déjà utilisé, pseudo, puis mdp correspondent*/

    if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
        $errorMessage='Il faut un email valide pour vous connecter.';
        header('Location: register.php');
        exit();
    }

    else if ($count_email > 0) {
        $_SESSION['email_used'] = True;
        $_SESSION['errorMessage'] ="L'email utilisé est déjà associé à un compte MIMAP.";
        header('Location: register.php');
        exit();
    }

    else if ($count_username > 0) {
        $_SESSION['username_used'] = True;
        $_SESSION['errorMessage'] ="Le pseudonyme utilisé est déjà associé à un compte MIMAP.";
        header('Location: register.php');
        exit();
    }

    else if (!($postData['mdp']===$postData['mdp-2'])) {
        $_SESSION['mismatching-mdp'] = True;
        $_SESSION['errorMessage'] ="Les mots de passe ne correspondent pas !";
        header('Location: register.php');
        exit();
    }

    else {
        $postData['mdp'] = password_hash($postData['mdp'], PASSWORD_DEFAULT);
        $sql="INSERT INTO users(username, email, mdp) VALUES (:username, :email, :mdp)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $postData['username']);
        $stmt->bindParam(':email', $postData['email']);
        $stmt->bindParam(':mdp', $postData['mdp']);
        $stmt->execute();
        header('Location: index.php');
        exit();
    }
}

else {
    header('Location: register.php');
    exit();
}
/*INSCRIPTION*/
?>