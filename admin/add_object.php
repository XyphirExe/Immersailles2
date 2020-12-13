<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Ajout objet</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="add.css">
    <link rel="stylesheet" href="navbar.css">
</head>
  <?php include "../includes/header.php"; ?>
    <body>
        <title>Ajouter un objet</title>

        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        -->
        <?php include "./navbar_admin.php"; ?>

        <div class="add_object">
          
          
          <div class="container">
          <div class="container">
          <form action="add_object.php" method="post">
          <div class="form-row">
              <div class="col-md-3 mb-3">
              <label for="validationDefault01">ID Wikidata</label>
              <input type="text" class="form-control" id="validationDefault01" name="idWD" required>
              </div>
          </div>
          <button class="btn btn-primary" type="submit">Valider</button>
          </form>
          </div>
          <div class="container">
          <?php
            if (isset($_POST['idWD'])&&!empty($_POST['idWD'])){
              echo "<p>";
              $jsdata = @file_get_contents("https://www.wikidata.org/wiki/Special:EntityData/" . htmlspecialchars($_POST['idWD']) . ".json");
              if ($jsdata == TRUE){

                $sql1 = "SELECT `idWD` FROM objetHistorique WHERE `idWD` LIKE '" . $_POST['idWD'] . "'";

                $js = json_decode($jsdata, true);
                $nom = str_replace("'","\'",$js['entities'][$_POST["idWD"]]['labels']['fr']['value']);
                

                if (mysqli_num_rows(mysqli_query($con, $sql1))==0){
                  
                  $sql2 = "INSERT INTO objetHistorique(idWD,nameWD) VALUES ('" . $_POST['idWD'] . "', '" . $nom . "')";

                  if (mysqli_query($con, $sql2)) {
                    echo "L'objet \"" . str_replace("\'","'",$nom) . "\" a bien été rajouté!\n";
                  } else {
                    echo "Erreur: " . $sql2 . "" . mysqli_error($con) . "\n";
                  }

                }
                else {
                  echo "L'objet \"" . str_replace("\'","'",$nom) . "\" est déjà dans la BDD.\n";
                }

              }
              else {
                  echo "Je n'ai pas trouvé d'objet ayant l'ID : " . htmlspecialchars($_POST['idWD']) . ".\n";
              }
              echo "</p>";
            }
          ?>
          </div>
          </div>
        </div>
    </body>
</html>
