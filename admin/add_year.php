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
            <form role="form" class="needs-validation" novalidate method="POST" action="add_level.php">
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label for="validationCustom01">Label de la période/année</label>
                  <input type="text" class="form-control" id="validationCustom01" placeholder="Année/période" name="year" required>
                  <div class="invalid-feedback">
                    Veuillez renseigner une période/année
                  </div>
                </div>


              </div>


              <button class="btn btn-primary" type="submit">Suite</button>
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
