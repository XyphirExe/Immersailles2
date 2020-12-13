<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Ajout liean année niveau</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="add.css">
    <link rel="stylesheet" href="navbar.css">
</head>
  <?php include "../includes/header.php"; ?>
    <body>

        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        -->
        <?php include "./navbar_admin.php"; ?>

        <div class="add_object">
          
          
          <div class="container">
          <div class="container">
          <form action="" method="post" id="form">
          <div class="form-row">
              <div class="form-row">
                <div class="col-md-6">
                  <h6>Année</h6>
                  <select id="year" name="year" form="form">
                    <?php
                        $sql = "SELECT * FROM annee";
                        
                        if ($result = $con->query($sql)) {
                            while ($row = $result->fetch_assoc()) { ?>

                          <option value="<?php echo $row["idAnnee"]?>"><?php echo $row["idAnnee"]?></option>
                    <?php
                            }
                        }
                        else{
                            echo "<p>";
                            echo "Erreur avec la BDD\n";
                            echo "<br>";
                            echo "</p>";
                        }
                    ?>
                  </select>
                </div>
                <div class="col-md-3">
                <h6>Niveau</h6>
                  <select id="level" name="level" form="form">
                  <?php
                        $sql = "SELECT * FROM niveau";
                        
                        if ($result = $con->query($sql)) {
                            while ($row = $result->fetch_assoc()) { ?>

                          <option value="<?php echo $row["idNiveau"]?>"><?php echo $row["idNiveau"]?></option>
                    <?php
                            }
                        }
                        else{
                            echo "<p>";
                            echo "Erreur avec la BDD\n";
                            echo "<br>";
                            echo "</p>";
                        }
                    ?>                    
                  </select>
                </div>
              </div>
          </div>
          <button class="btn btn-primary" type="submit">Valider</button>
          </form>
          </div>
          <div class="container">
          <?php

            if (!empty($_POST['year']) && !empty($_POST['level'])){
              echo "<p>";
            

              $sql1 = "SELECT * FROM anneeNiveau WHERE `idAnnee`=" . $_POST['year'] . " AND `idNiveau`=" . $_POST['level'];                

              if (mysqli_num_rows(mysqli_query($con, $sql1))==0){
                
                $sql2 = "INSERT INTO `anneeNiveau` (`idAnnee`, `idNiveau`) VALUES ('" . htmlspecialchars($_POST['year']) . "', '" . htmlspecialchars($_POST['level']) . "')";

                if (mysqli_query($con, $sql2)) {
                  echo "Le lien [ID Année : " . htmlspecialchars($_POST['year']) . " | ID Niveau : " . htmlspecialchars($_POST['level']) . " ] a bien été rajouté!\n";
                } else {
                  echo "Erreur: " . $sql2 . "" . mysqli_error($con) . "\n";
                }

              }
              else {
                echo "Ce lien est déjà dans la BDD.\n";
              }
              echo "</p>";
            }
          ?>
          </div>
          </div>
        </div>
    </body>
</html>
