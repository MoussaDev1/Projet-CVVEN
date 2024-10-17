<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            height: 100vh;
        }
        
        table {
            width: 70%;
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
        <h1><u>Mes réservations</u></h1>
        <br>
        <table>
            <tr>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Adresse du logement</th>
                <th>Taille du logement</th>
                <th>Type du logement</th>
                <th>Prix total de la réservation</th>
                <th>État de validation</th>
                <th>Annuler la réservation</th>
            </tr>
            <?php
            // Inclure le fichier de connexion à la base de données
            include 'connexion.php';

            // Requête SQL pour récupérer les réservations avec toutes les informations nécessaires
            $sql = "SELECT 
                        r.date_debut_reservation, 
                        r.date_fin_reservation, 
                        l.adresse_logement, 
                        l.taille_logement, 
                        l.type_logement, 
                        r.prix_reservation, 
                        r.validation_reservation
                    FROM reservation r
                    INNER JOIN logement l ON r.id_logement = l.id_logement";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Afficher les données de chaque réservation
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["date_debut_reservation"] . "</td>";
                    echo "<td>" . $row["date_fin_reservation"] . "</td>";
                    echo "<td>" . $row["adresse_logement"] . "</td>";
                    echo "<td>" . $row["taille_logement"] . "</td>";
                    echo "<td>" . $row["type_logement"] . "</td>";
                    echo "<td>" . $row["prix_reservation"] . "</td>";
                    echo "<td>" . ($row["validation_reservation"] == 1 ? "Validée" : "Non validée") . "</td>";
                    echo "<td><button>Annuler</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Aucune réservation trouvée</td></tr>";
            }
            ?>
        </table>
    </center>
</body>
</html>
