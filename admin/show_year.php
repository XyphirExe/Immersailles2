<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Liste des salariés</h1>
    <br>
    <?php
    $sql = "SELECT `labelAnnee` FROM annee";
    try {
    $result=$dbh->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    } catch(PDOException $e)
    {
    echo $e->getMessage();
    }
    ?>
    Nombre d'enregistrements : <?php echo $result->rowCount(); ?>
    <br><br>
    <center>
    <table class="tftable" border="1">
    <tr><th>N°</th><th>Nom</th><th>Prénom</th><th>Titre</th><th>Date</th><th>Service</th></tr>

    <?php while ($row = $result->fetch()): ?>
    <tr>
    <td><?php echo htmlspecialchars($row['num']) ?></td>
    <td><?php echo htmlspecialchars($row['nom']) ?></td>
    <td><?php echo htmlspecialchars($row['prenom']) ?></td>
    <td><?php echo htmlspecialchars($row['titre']) ?></td>
    <td><?php echo htmlspecialchars($row['date_n']) ?></td>
    <td><?php echo htmlspecialchars($row['service']) ?></td>
    </tr>
    <?php endwhile; ?>

    </table>
    <center>
</body>
</html>