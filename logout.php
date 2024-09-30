<?php
session_start(); // Démarre la session

// Vérifie si le formulaire de déconnexion a été soumis
if (isset($_POST['logout'])) {
    session_unset(); // Efface toutes les variables de session
    session_destroy(); // Détruit la session

    // Redirection après déconnexion
    header('Location: welcome.php');
    exit(); // Assure que le script s'arrête après la redirection
}
?>
