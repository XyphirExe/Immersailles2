<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Objets</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="add.css">
    <link rel="stylesheet" href="navbar.css">
    <style>
        table,
        td {
            border: 1px solid #333;
            border-collapse: collapse;
        }

        thead,
        tfoot {
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
  <?php include "../includes/header.php"; ?>
    <body>
        <title>Objets</title>


        <?php include "./navbar_admin.php"; ?>
        <div class="container">
            <a href="add_object.php"><h1>Rajouter un objet</h1></a>
        </div>

        <div class="container">

        <?php
            if(isset($_POST['Supprimer'])){
                if(!empty($_POST['to_delete'])){
                    foreach($_POST['to_delete'] as $selected){
                        
                        $sql_delete_get = "SELECT * FROM objetHistorique WHERE `idOH`=" . $selected;
                        
                        $nameWD = "";
                        $idWD = "";
                        if ($result = $con->query($sql_delete_get)) {
                            if ($row = $result->fetch_assoc()){
                                $nameWD = $row["nameWD"];
                                $idWD = $row["idWD"];
                            }
                        }

                        $sql_delete = "DELETE FROM objetHistorique WHERE `idOH`=" . $selected;

                        if (mysqli_query($con, $sql_delete)) {
                            echo "L'objet \"" . $nameWD . "\" (" . $idWD . ") a bien été supprimé!";
                            echo "<br>";
                        } else {
                           echo "*** L'objet \"" . $nameWD . "\" (" . $idWD . ") n'a pas pu être supprimé.";
                           echo "<br>";
                        }                        
                    }
                }
            }
        ?>
            <form action="objects.php" method="post">
            <table id="myTable">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>ID</th>
                        <th>Lien</th>
                        <th class="noExport">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM objetHistorique";
                        
                        if ($result = $con->query($sql)) {
                            while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row["nameWD"]; ?></td>
                        <td><?php echo $row["idWD"]; ?></td>
                        <td><?php echo "<a href=\"https://www.wikidata.org/wiki/" . $row["idWD"] . "\"  target=\"_blank\">https://www.wikidata.org/wiki/" . $row["idWD"] . "</a>"; ?></td>
                        <td>
                            <input type="checkbox" name="to_delete[]" value="<?php echo $row["idOH"]; ?>">
                        </td>
                    </tr>
                    <?php
                            }
                        }
                        else{
                            echo "Erreur avec la BDD\n";
                        }
                    ?>
                    
                </tbody>
                <tfoot>
            <tr class="table100-foot">
                <th class="column1">Nom</th>
                <th class="column2">ID</th>
                <th class="column3">Lien</th>
                <th class="column4"></th>
            </tr>
        </tfoot>
            </table>
            <input type="submit" name="Supprimer" value="Supprimer">
            </form>
            
            <script defer>

            $(document).ready(function(){
                // Setup - add a text input to each footer cell
                $('#myTable tfoot th').each( function () {
                    var title = $(this).text();
                    if (title != "") {
                        $(this).html( '<input type="text" placeholder="'+title+'" />' );   
                    }
                } );             

                $('#myTable').DataTable({
                    'initComplete': function () {
                        var r = $('#myTable tfoot tr');
                        r.find('th').each(function(){
                            $(this).css('padding', 8);
                        });
                        $('#myTable thead').append(r);
                        $('#search_0').css('text-align', 'center');
                        // Apply the search
                        this.api().columns().every( function () {
                            var that = this;
            
                            $( 'input', this.footer() ).on( 'keyup change clear', function () {
                                if ( that.search() !== this.value ) {
                                    that
                                        .search( this.value )
                                        .draw();
                                }
                            } );
                        } );
                    },
                    "orderClasses": false,
                    'lengthMenu': [ [10, 25, 50, 75, -1], [10, 25, 50, 75, "All"] ],
                    'dom': 'Birftlp',
                    'buttons': [
                        {
                            extend: 'csvHtml5',
                            text: 'CSV',
                            exportOptions: {
                                columns: "thead th:not(.noExport)"
                            },
                            action: function(e, dt, button, config) {
                                var d = new Date();
                                config.messageBottom = "EXTRAIT DU " + d.getDate() + "/" + (d.getMonth() + 1) + "/" + d.getFullYear();
                                config.title = "Objets Historiques";
                                config.filename = "objets_historiques_" + d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear();
                                $.fn.dataTable.ext.buttons.csvHtml5.action.call(this,e, dt, button, config);
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            text: 'Excel',
                            exportOptions: {
                                columns: "thead th:not(.noExport)"
                            },
                            action: function(e, dt, button, config) {
                                var d = new Date();
                                config.messageBottom = "EXTRAIT DU " + d.getDate() + "/" + (d.getMonth() + 1) + "/" + d.getFullYear();
                                config.title = "Objets Historiques";
                                config.filename = "objets_historiques_" + d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear();
                                $.fn.dataTable.ext.buttons.excelHtml5.action.call(this,e, dt, button, config);
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: 'PDF',
                            exportOptions: {
                                columns: "thead th:not(.noExport)"
                            },
                            action: function(e, dt, button, config) {
                                var d = new Date();
                                config.messageBottom = "EXTRAIT DU " + d.getDate() + "/" + (d.getMonth() + 1) + "/" + d.getFullYear();
                                config.title = "Objets Historiques";
                                config.filename = "objets_historiques_" + d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear();
                                $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this,e, dt, button, config);
                            }
                        }
                    ],"language": {
                        "decimal":        "",
                        "emptyTable":     "Pas d'informations",
                        "info":           "Affichage de _START_ à _END_ des _TOTAL_ entrées",
                        "infoEmpty":      "Affichage de 0 à 0 des 0 entrées",
                        "infoFiltered":   "(filtré des _MAX_ entrées totales)",
                        "infoPostFix":    "",
                        "thousands":      ",",
                        "lengthMenu":     "Afficher _MENU_ entrées",
                        "loadingRecords": "Chargement...",
                        "processing":     "Traitement...",
                        "search":         "Chercher:",
                        "zeroRecords":    "Pas d'enregistrements valables trouvés",
                        "paginate": {
                            "first":      "Premier",
                            "last":       "Dernier",
                            "next":       "Suivant",
                            "previous":   "Précédent"
                        },
                        "aria": {
                            "sortAscending":  ": activer pour trier la colonne de manière ascendante",
                            "sortDescending": ": activer pour trier la colonne de manière descendante"
                        }
                    }
            });
            });
        </script>

        </div>