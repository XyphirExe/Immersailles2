<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<nav class="navbar navbar-expand-lg color-navbar color-font-navbar navbar-dark">
    <img src="https://media.discordapp.net/attachments/756026556760981535/756519352311742594/logo_mini.png" class="d-inline-block align-top" alt="" loading="lazy">
    <h1>
    Immersailles Admin
    </h1>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/jszip-2.5.0/dt-1.10.22/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.3/fc-3.3.2/fh-3.1.7/kt-2.5.3/r-2.2.6/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.1/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/jszip-2.5.0/dt-1.10.22/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.3/fc-3.3.2/fh-3.1.7/kt-2.5.3/r-2.2.6/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.1/datatables.min.js"></script>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item <?php if(strpos($_SERVER['SCRIPT_NAME'],"/welcome.php")) { ?>active<?php   }  ?>">
        <a class="nav-link" href="welcome.php">Home</a>
        </li>
        <li class="nav-item <?php if(strpos($_SERVER['SCRIPT_NAME'],"/XXXXXXXXXXX.php")) { ?>active<?php   }  ?>">
        <a class="nav-link" href="#">Vue normale</a>
        </li>
        <?php
        
            if ($_SESSION["admin"]) {
        
        ?>
        <li class="nav-item dropdown <?php if(strpos($_SERVER['SCRIPT_NAME'],"/add_object.php") || strpos($_SERVER['SCRIPT_NAME'],"/objects.php") || strpos($_SERVER['SCRIPT_NAME'],"/add_year.php") || strpos($_SERVER['SCRIPT_NAME'],"/year.php")) { ?>active<?php   }  ?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Données
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item <?php if(strpos($_SERVER['SCRIPT_NAME'],"/add_year.php") || strpos($_SERVER['SCRIPT_NAME'],"/year.php")) { ?>active<?php   }  ?>" href="./year.php">Années</a>
            <a class="dropdown-item" href="./link_year_level.php">Liens Années Niveaux</a>
            <a class="dropdown-item" href="./level.php">Niveaux</a>
            <a class="dropdown-item" href="#">Points</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item <?php if(strpos($_SERVER['SCRIPT_NAME'],"/add_object.php") || strpos($_SERVER['SCRIPT_NAME'],"/objects.php")) { ?>active<?php   }  ?>" href="./objects.php">Objets Historiques</a>
        </div>
        </li>
        <li class="nav-item <?php if(strpos($_SERVER['SCRIPT_NAME'],"/add_object.php") || strpos($_SERVER['SCRIPT_NAME'],"/objects.php")) { ?>active<?php   }  ?>">
        <a class="nav-link" href="./register.php">Ajout Contributeur</a>
        <?php
        
            }else{

        ?>
        <li class="nav-item <?php if(strpos($_SERVER['SCRIPT_NAME'],"/add_object.php") || strpos($_SERVER['SCRIPT_NAME'],"/objects.php")) { ?>active<?php   }  ?>">
        <a class="nav-link" href="#">Objets Historiques</a>
        </li>
        <?php
        
            }

        ?>
    </ul>
    </div>
</nav>