<?php
error_reporting(E_ALL); // Affiche toutes les erreurs
ini_set('display_errors', 1); // Assure que les erreurs sont affichées
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: welcome.php');
}
?>