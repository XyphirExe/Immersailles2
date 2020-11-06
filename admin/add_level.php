<?php
    if (!isset($_POST['year']) || empty($_POST['year']) ) {
        header("Location: add_year.php");
    }
 ?>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Add Map</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="add.css">
        <link rel="stylesheet" href="navbar.css">
    </head>
    <body>
        <div class="add_map">
            <form enctype="multipart/form-data" class="needs-validation" novalidate="" method="post" action="add_point.php">
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label for="validationCustom01">Label de la période/année</label>
                  <input type="text" class="form-control" id="validationCustom01" value="<?php
                        echo htmlspecialchars($_POST['year']);
                    ?>" placeholder="Année/période" name="year" required readonly>
                  <div class="invalid-feedback">
                    Veuillez renseigner une période/année
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationCustom02">Last name</label>
                  <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Otto" required>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationCustomUsername">Username</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                    </div>
                    <input type="text" name="file" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                      Please choose a username.
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationCustom03">City</label>
                  <input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
                  <div class="invalid-feedback">
                    Please provide a valid city.
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="validationCustom04">State</label>
                  <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
                  <div class="invalid-feedback">
                    Please provide a valid state.
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="validationCustom05">Zip</label>
                  <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
                  <div class="invalid-feedback">
                    Please provide a valid zip.
                  </div>
                </div>
              </div>
              <div class="form-row">
                 <div class="col-md-12 mb-3">
                 <label for="validationCustom06">File</label>
                  <div class="custom-file">
                    <input type="file" accept="image/*" class="custom-file-input" id="validatedCustomFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                    <div class="invalid-feedback">Invalid custom file feedback</div>
                  </div>
                </div>
              </div>
              <button class="btn btn-primary" type="submit">Submit form</button>
            </form>

            <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
              'use strict';
              window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                  form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                      event.preventDefault();
                      event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                  }, false);
                });
              }, false);
            })();
            </script>
        </div>
    </body>
</html>
