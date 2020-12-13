<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Ajout année</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="add.css">
    <link rel="stylesheet" href="navbar.css">
</head>
  <?php include "../includes/header.php"; ?>
    <body>
        <title>Ajouter une année</title>

        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        -->
        <?php include "./navbar_admin.php"; ?>

        <div class="add_object">
          
          
          <div class="container">
          <div class="container">
          <form action="add_year.php" method="post" class="needs-validation" novalidate>
          <div class="form-row">
              <div class="form-row">
                <div class="col-md-6">
                  <label for="validationTooltip01">Label</label>
                  <input type="text" name="label" class="form-control" id="validationTooltip01">
                </div>
                <div class="col-md-3">
                  <label for="validationTooltip02">Année</label>
                  <input type="number" max="9999" name="year" class="form-control" id="validationTooltip02" required>
                  <div class="invalid-tooltip">
                    Veuillez mettre une année.
                  </div>
                </div>
              </div>
          </div>
          <button class="btn btn-primary" type="submit">Valider</button>
          </form>
          </div>
          <div class="container">
          <?php

            if (!empty($_POST['year'])){
              echo "<p>";

              if(empty($_POST['label'])){
                $label = str_replace("'","\'",$_POST['year']);
              }
              else{
                $label = str_replace("'","\'",$_POST['label']);
              }
            

              $sql1 = "SELECT `annee` FROM annee WHERE `annee`=" . $_POST['year'];                

              if (mysqli_num_rows(mysqli_query($con, $sql1))==0){
                
                $sql2 = "INSERT INTO annee(labelAnnee,annee) VALUES ('" . $label . "', '" . $_POST['year'] . "')";

                if (mysqli_query($con, $sql2)) {
                  echo "L'année " . $_POST['year'] . " (" . str_replace("\'","'",$label) . ") a bien été rajouté!\n";
                } else {
                  echo "Erreur: " . $sql2 . "" . mysqli_error($con) . "\n";
                }

              }
              else {
                echo "L'année " . $_POST['year'] . " est déjà dans la BDD.\n";
              }
              echo "</p>";
            }
          ?>
          </div>
          </div>
        </div>
    </body>
</html>
