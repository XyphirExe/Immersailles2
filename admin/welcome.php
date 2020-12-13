<html lang="fr" dir="ltr">
    <?php include "../includes/header.php"; ?>
    <body>
        <title>Accueil</title>


        <?php include "./navbar_admin.php"; ?>

        <div class="page-header">
            <h1>Hello, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bienvenue au back office!</h1>
        </div>
    </body>
</html>
