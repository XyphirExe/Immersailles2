<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Ajout niveau</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="add.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="../js/image-picker-0.3.1/image-picker/image-picker.css">
    <style type="text/css">
            .thumbnails li img{
                max-width: 700px;
            }

            ul.thumbnails.image_picker_selector{
              overflow: inherit;
            }

            .thumbnails {
              padding-top: 56.25%;
            }
        </style>
</head>
  <?php include "../includes/header.php"; ?>
    <body>
        <title>Ajouter un niveau</title>

        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        -->
        <?php include "./navbar_admin.php"; ?>

        <script src="../js/image-picker-0.3.1/image-picker/image-picker.min.js"></script>

        <div class="add_object">
          
          
          <div class="container">
          <div class="container">
          <form action="add_level.php" method="post" class="needs-validation" novalidate>
          <div class="form-row">
              <div class="form-row">
                <div class="col-md-6">
                  <label for="validationTooltip01">Nom</label>
                  <input type="text" name="name" class="form-control" id="validationTooltip01">
                </div>
                <div class="col-md-6">
                  <label for="validationTooltip02">Label</label>
                  <input type="text" name="label" class="form-control" id="validationTooltip02">
                </div>
                <div class="col-md-3">
                <select class="image-picker show-labels show-html" name="picture">

                  <?php

                    $directory = "../images/plans";
                    $images = glob("$directory/*.{jpg,png,jpeg,JPG,PNG,JPEG}", GLOB_BRACE);
                    $imageNo = 0;

                    foreach($images as $image)
                    {
                      echo '<option data-img-label="' . basename(htmlspecialchars($image)) . '" data-img-src="' . htmlspecialchars($image) . '" value="' . htmlspecialchars($image) . '">Picture ' . ++$imageNo . "</option>";
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

            if (!empty($_POST['name']) && !empty($_POST['label']) && !empty($_POST['picture'])){
              echo "<p>";
            

              $sql1 = "SELECT * FROM niveau WHERE `labelNiveau`='" . $_POST['label'] . "' AND `nomNiveau`='" . $_POST['name'] . "' AND `lienCarte`='" . $_POST['picture'] . "'";                

              if (mysqli_num_rows(mysqli_query($con, $sql1))==0){
                
                $sql2 = "INSERT INTO `niveau` (`labelNiveau`, `lienCarte`, `nomNiveau`) VALUES ('" . htmlspecialchars($_POST['label']) . "', '" . htmlspecialchars($_POST['picture']) . "', '" . htmlspecialchars($_POST['name']) . "')";

                if (mysqli_query($con, $sql2)) {
                  echo "Le niveau " . $_POST['name'] . ' (<a href="' . $_POST['picture'] . '" target="_blank">' . $_POST['picture'] . "</a>) a bien été rajouté! (Label : " . $_POST['label'] . " )";
                } else {
                  echo "Erreur: " . $sql2 . "" . mysqli_error($con) . "\n";
                }

              }
              else {
                echo "Le niveau " . $_POST['name'] . ' (<a href="' . $_POST['picture'] . '" target="_blank">' . $_POST['picture'] . "</a>) est déjà dans la BDD. (Label : " . $_POST['label'] . " )";
              }
              echo "</p>";
            }
          ?>
          </div>
          </div>
        </div>
        <script>$("select").imagepicker({
          show_label: true;
        });</script>
    </body>
</html>
