<?php
session_start()
?>

<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <title>MIMAP</title>
    <link rel="icon" href="images/nv.png">
    <link href="styles/style.css" rel="stylesheet">
    <link href="styles/ajout.css" rel="stylesheet">
</head>


<body>
    <header>
        <?php require_once(__DIR__ . '\templates\footer-header.php'); ?>
    </header>

    <main>
            <h1>
                Ajouter un nouveau lieu de souvenir
            </h1>
        <section class="section-ajout">
            <form method="post" action="traitement-ajout.php" enctype="multipart/form-data">
                <fieldset class="form-ajout">
                <legend>Grave un souvenir dans ta MIMAP !</legend>
                    <p>
                    <label for="Country">C'était dans quel pays ?</label><input type="text" name="Country" id="Country" required>
                    </p>
                    <p>
                    <label for="City">La ville ?</label><input type="text" name="City" id="City" required>
                    </p>
                    <p>
                    <label for="Place">L'endroit ?</label><input type="text" name="Place" id="Place" required>
                    </p>
                    <p>
                    <label for="date">La date ?</label><input type="date" name="date" id="date" required>  
                    </p>
                    <p>
                    <label for="PSEUDO">C'était avec ?</label><input type="text" name="PSEUDO" id="PSEUDO" required>
                    </p>
                    <p>
                    <label for="best-moment">Le moment marquant ?</label><textarea name="best-moment" id="best-moment" required></textarea>
                    </p>
                    <p>
                    <label for="picture">La photo illustrative !</label><input type="file" id="picture" name="picture">
                    </p>
                    <p>
                    <label for="submit"></label><input type="submit" value="Je m'en souviendrais !">
                    </p>
                </fieldset>
            </form>
        </section>
    </main>

    <footer class="grey-background">
        <?php require_once(__DIR__ . '\templates\footer.php'); ?>
    </footer>
</body>

</html>