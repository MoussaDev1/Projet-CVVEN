<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Logements</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php echo view('templates/header.php'); ?>    
    <div class="container mt-5">
        <h1>Liste des Logements</h1>
        <!-- Formulaire de réservation -->
        
        <!-- Liste des logements -->
        <table class="table mt-5">
            <thead>
                <tr>
                    <th scope="col">Lieu</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Taille</th>
                    <th scope="col">Type</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logements as $logement): ?>
                <tr>
                    <td><?= $logement['lieu'] ?></td>
                    <td><?= $logement['prix_logement'] ?></td>
                    <td><?= $logement['taille_logement'] ?>m²</td>
                    <td><?= $logement['type_logement'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <form action="<?php echo base_url('affichage/create-reservation'); ?>" method="post">
        <div class="form-group">
            <label for="date_debut_reservation">Date de début :</label>
            <!-- Utilisation de PHP pour obtenir la date du jour -->
            <input type="date" class="form-control" id="date_debut_reservation" name="date_debut_reservation" 
                   value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="form-group">
            <label for="date_fin_reservation">Date de fin :</label>
            <input type="date" class="form-control" id="date_fin_reservation" name="date_fin_reservation"
                   min="<?php echo date('Y-m-d'); ?>" >
        </div>
        <div class="form-group">
            <label for="id_logement">Choisir un logement :</label>
            <select class="form-control" id="id_logement" name="id_logement">
                <?php foreach ($logements as $logement): ?>
                    <option value="<?php echo $logement['id']; ?>"><?php echo $logement['lieu']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Réserver</button>
    </form>

        <br>
    </div>
</body>
</html>
