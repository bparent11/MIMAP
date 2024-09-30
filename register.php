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
    <link href="styles/register.css" rel="stylesheet">
</head>

<body class="main-with-img">
    <main>
        <section>
            <form method="post" action="register-process.php">
                <fieldset class="form-ajout">
                <legend>Inscription</legend>

                    <p>
                    <label for="email">Adresse mail</label><input type="email" name="email" id="email" class="connexion" required>
                    </p>
                    <?php if (isset($_SESSION['email_used']) && $_SESSION['email_used']): ?>
                        <p class="connexion-inscription-failed">
                            <?php echo htmlspecialchars($_SESSION['errorMessage']); ?>
                        </p>
                        <?php
                        unset($_SESSION['email_used']);
                        unset($_SESSION['errorMessage']);
                        ?>
                    <?php endif;?>
                    <p>
                    <label for="username">Pseudonyme</label><input type="text" name="username" id="username" class="connexion" required>
                    </p>
                    <?php if (isset($_SESSION['username_used']) && $_SESSION['username_used']): ?>
                        <p class="connexion-inscription-failed">
                            <?php echo htmlspecialchars($_SESSION['errorMessage']); ?>
                        </p>
                        <?php
                        unset($_SESSION['username_used']);
                        unset($_SESSION['errorMessage']);
                        ?>
                    <?php endif;?>
                    <p>
                    <label for="mdp">Mot de passe</label><input type="password" name="mdp" id="mdp" class="connexion" required>
                    </p>
                    <p>
                    <label for="mdp-2">Validation du mot de passe</label><input type="password" name="mdp-2" id="mdp-2" class="connexion" required>
                    </p>
                    <?php if (isset($_SESSION['mismatching-mdp']) && $_SESSION['mismatching-mdp']): ?>
                        <p class="connexion-inscription-failed">
                            <?php echo htmlspecialchars($_SESSION['errorMessage']); ?>
                        </p>
                        <?php
                        unset($_SESSION['mismatching-mdp']);
                        unset($_SESSION['errorMessage']);
                        ?>
                    <?php endif;?>
                    <p>
                    <label for="submit"></label><input type="submit" value="Je m'inscris !" id="submit">
                    </p>
                    <p>
                    <a href="welcome.php">J'ai déjà un compte !</a>
                    </p>
                </fieldset>
            </form>
        </section>
    </main>

    <footer class="fixed-bottom">
        <nav>
            <a href=us.php>Qui sommes-nous ?</a>
            <img src="images/nv.png" alt="logo" class="logo-box">
            <a href=contact.php>Contact</a>
        </nav>
    </footer>
</body>
