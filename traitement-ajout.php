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
</head>

<?php 
$postData = $_POST;
?>

<?php

if ($_FILES) {
    if (!($_FILES['picture']['error'])) {
        $valid_extensions = ['jpg', 'jpeg', 'png', 'HEIC'];
        $fileInfo = pathinfo($_FILES['picture']['name']);
        $extension = $fileInfo['extension'];
        if (in_array($extension, $valid_extensions, true)) {
            /*gérer la récupération de l'image*/
        }
        else {
            $_SESSION['wrong_extension'] = True;
        }
    }
    else {
        $_SESSION['error_happened'] = True; /*renvoyer ça sur la page ajout.php*/
    }
}

/*gérer l'insertion de toutes les infos dans la DB, que y ai l'image ou non (et donc mettre le truc "(isset($_FILES)) en sortie du code ci-dessous)*/
if ($_POST) { /*il faut que j'unset la variable $_POST de la connexion (et même de manière générale dès que y en a plus besoin je pense qu'il faut unset les supervariables), inscription etc après que ça a été fini, pour pas que ça soit validé alors que c'est pas vrai */
    $sql='INSERT INTO places(country, city, place, quand, with_who, best_moment, picture_path, author_id) VALUES (:country, :city, :place, :quand, :with_who, :best_moment, :picture_path, :author_id)';
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':country', $postData['Country']);
    $stmt->bindParam(':city', $postData['City']);
    $stmt->bindParam(':place', $postData['Place']);
    $stmt->bindParam(':quand', $postData['date']);
    $stmt->bindParam(':with_who', $postData['PSEUDO']);
    $stmt->bindParam(':best_moment', $postData['best-moment']);
    $stmt->bindParam(':author_id', $_SESSION['user_id']);

    if ($_FILES) {
        if (!($_FILES['picture']['error'])) {
            $valid_extensions = ['jpg', 'jpeg', 'png', 'HEIC'];
            $fileInfo = pathinfo($_FILES['picture']['name']);
            $extension = $fileInfo['extension'];
            if (in_array($extension,$valid_extensions, true)) {
                $uploadDir = __DIR__ . '/../uploads/';
                $newFileName = uniqid() . '.' . $extension;
                move_uploaded_file($_FILES['picture']['tmp_name'], $uploadDir . $newFileName);
                $fullPath = strval($uploadDir . $newFileName);
                $stmt->bindParam(':picture_path', $fullPath);
            }
            else {
                $_SESSION['wrong_extension'] = True; /*renvoyer ça sur la page ajout.php*/
                header('Location: ajout.php');
                exit();
            }
        }
        else {
            $_SESSION['error_happened'] = True; /*renvoyer ça sur la page ajout.php*/
            header('Location: ajout.php');
            exit();
        }
    }

    else {
        $stmt->bindParam(':picture_path', "no_file_shared");
    }

    $stmt->execute();
    header('Location: map.php');
    exit();
}


else {
    header('Location: welcome.php');
    exit();
}
?>