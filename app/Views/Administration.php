<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Administration</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                height: 100vh;
            }
            
            table {
                width: 95%;
                background-color: #F5F5DC;
                border-collapse: collapse;
            }
            
            table th {
                background-color: #FFAB4A;
            }
            
            th, td {
                border: 3px solid black;
                text-align: center;
            }
            .reservationNonValidee {
                color: red;
            }
            .reservationValidee {
                color: green;
            }
        </style>
    </head>
    <body>
        <?php echo view('templates/header.php'); ?>
        <center>
            <h1><u>Administration</u></h1>
            <br>
            <form action="<?php site_url("Administration/index") ?>" method="post">
                <label>ID du client</label>
                <input type="text" name="idClient">
                <input type="submit" value="Filtrer">
            </form>
            <br>
            <table>
                <tr>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>ID du client</th>
                    <th>Nom du client</th>
                    <th>Prénom du client</th>
                    <th>Adresse mail du client</th>
                    <th>Adresse du logement</th>
                    <th>Taille du logement</th>
                    <th>Type du logement</th>
                    <th>Prix total de la réservation</th>
                    <th>État de validation</th>
                    <th>Faire valider</th>
                </tr>
                <?php
                    if (isset($header)) {
                        foreach($header as $row1) {
                            echo("<tr>");
                            foreach($row1 as $row2) {
                                echo "<td>".$row2."</td>";
                            }
                            echo("</tr>");
                        }
                    }
                ?>
            </table>
        </center>
    </body>
</html>