<?php
session_start();
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

<body class="main-with-img">
    <main>
        <section>
            <form method="post" action="login.php">
                <fieldset class="form-ajout">
                <legend>Connexion</legend>
                    <p>
                    <label for="email">Adresse mail</label><input type="email" name="email" id="email" class="connexion" required>
                    </p>
                    <p>
                    <label for="mdp">Mot de passe</label><input type="password" name="mdp" id="mdp" class="connexion" required>
                    </p>
                    <p>
                    <label for="submit"></label><input type="submit" value="Connexion" id="submit">
                    </p>
                    <p>
                    <a href="register.php" alt="register">Pas encore de compte ? Inscris-toi !</a>
                    </p>
                    <?php if (isset($_SESSION['connexion_failed']) && $_SESSION['connexion_failed']): ?>
                        <p class="connexion-inscription-failed">
                            <?php echo htmlspecialchars($_SESSION['errorMessage']); ?>
                        </p>
                        <?php
                        unset($_SESSION['connexion_failed']);
                        unset($_SESSION['errorMessage']);
                        ?>
                    <?php endif;?>
                </fieldset>
            </form>
        </section>
    </main>

    <footer class="fixed-bottom">
        <nav>
            <a href=us.php class="left">Qui sommes-nous ?</a>
            <img src="images/nv.png" alt="logo">
            <a href=contact.php class="right">Contact</a>
        </nav>
    </footer>
</body>
