<?php
error_reporting(E_ALL); // Affiche toutes les erreurs
ini_set('display_errors', 1); // Assure que les erreurs sont affichées
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: welcome.php');
}
require_once(__DIR__ . '/../db_connection.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>MIMAP</title>
    <link rel="icon" href="images/nv.png">
    <link href="styles/style.css" rel="stylesheet">
    <link href="styles/map.css" rel="stylesheet">
</head>

<body>
    <header>
        <?php require_once(__DIR__ . '\templates\footer-header.php'); ?>
    </header>

    <main>
        <section>
            <h1>
                Sélectionne un continent et visualise tes meilleurs souvenirs !
            </h1>

            <form class="select-box">
                <select id="choix">
                    <option value="tout-voir">Tout voir</option>
                    <option value="europe">Europe</option>
                    <option value="north-america">Amérique du Nord</option>
                    <option value="south-america">Amérique du Sud</option>
                    <option value="afrique">Afrique</option>
                    <option value="asie">Asie</option>
                    <option value="autres">Autres</option>
                </select>
            </form>

            <!-- peut sûrement gérer l'affichage selon si on a cliqué sur tel ou tel bouton, avec une supervariable-->
        </section>
        <section>
            <!--foreach location sur tel user_id (selon continent selectionné), mettre lieu et date, la photo et le texte du souvenir à côté-->
            <?php
            $sql = 'SELECT country, city, place, quand, with_who, best_moment, picture_path FROM places WHERE author_id=? ORDER BY quand DESC';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $_SESSION['user_id']
            ]);
            $places=$stmt->fetchAll();
            ?>
            <section><hr class='top-line'></section>
            <?php
            foreach($places as $place) {
                echo "<section class='memory-section'>";
                echo "<h2>" . $place["country"] . ", " . $place['city'] . "</h2>";
                echo "<h3>" . $place["place"] . ", le " . $place["quand"] . " avec " . $place["with_who"] . " !</h3>";
                echo "<p><img src='/uploads/" . basename($place["picture_path"]) . "' alt='photo_du_souvenir' class='pictures-map'></p>";                
                echo "<p class='best-moment'>" . $place["best_moment"] . "</p>";
                echo "</section>";
                echo "<section><hr class='picture-line'></section>";
            }
            ?>
        </section>
    </main>

    <footer class="grey-background">
        <?php require_once(__DIR__ . '\templates\footer.php'); ?>
    </footer>
</body>

</html>