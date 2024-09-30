<?php
session_start()
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIMAP</title>
    <link rel="icon" href="images/nv.png">
    <link href="styles/style.css" rel="stylesheet">
    <link href="styles/accueil.css" rel="stylesheet">
</head>

<body>
    <header> 
        <?php require_once(__DIR__ . '\templates\footer-header.php'); ?>
    </header>

    <main>
        <section>
            <?php
                echo "<h1>Bienvenue sur la MIMAP " . htmlspecialchars($_SESSION['username']) . " !</h1>";
            ?>
            <p>
                Site dédié aux mimous.
            </p>
            <p>
                Ce site permet de récolter les informations sur des lieux déjà visités par les mimous, en sauvegardant notamment la date ou la période, le motif et une image du séjour !
            </p>
        </section>

        <section>
            <p>
                Vous trouverez ce type de carte, exemple ci-dessous avec la carte de l'Europe.
            </p>
            <div class="img-exemple">
                <img src="images/carte-europe-vierge.jpg" alt="Vous trouverez ce type de carte" class="img-exemple-border">
            </div>
            <p>
                Les points bleus représentent les lieux visités.
            </p>
        </section>
    </main>

    <footer class="grey-background">
        <?php require_once(__DIR__ . '\templates\footer.php'); ?>
    </footer>
</body>
</html>