<?php
    /* Connexion à une base MySQL avec l'invocation de pilote */
    $host = 'sqletud.u-pem.fr';
    $dbname = 'ldelport_db';
    $user = 'ldelport';
    $password = 'Nfuu6yi6fx';

    $con = mysqli_connect($host, $user, $password, $dbname);

    if (!$con) {
        echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
        echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
        echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

?>
