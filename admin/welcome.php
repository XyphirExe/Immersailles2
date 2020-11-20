<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<html lang="fr" dir="ltr">
    <?php include "../includes/header.php"; ?>
    <body>
        <title>Accueil</title>


        <nav class="navbar navbar-expand-lg color-navbar color-font-navbar navbar-dark">
        <h1 class="navbar-brand">
          <img src="https://media.discordapp.net/attachments/756026556760981535/756519352311742594/logo_mini.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
          Immersailles Admin
        </h1>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Vue normale</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Données
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Années</a>
                  <a class="dropdown-item" href="#">Niveaux</a>
                  <a class="dropdown-item" href="#">Points</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Objets Historiques</a>
                </div>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher</button>
            </form>
          </div>
        </nav>

        </nav>

        <div class="page-header">
            <h1>Hello, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bienvenue au back office!</h1>
        </div>
    </body>
</html>
