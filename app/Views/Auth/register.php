<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaire Client</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
            }

            form {
                background-color: #fff;
                border-radius: 8px;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 300px;
            }

            h2 {
                text-align: center;
                color: #333;
            }

            label {
                display: block;
                margin-bottom: 8px;
                color: #555;
            }

            input {
                width: 100%;
                padding: 8px;
                margin-bottom: 16px;
                box-sizing: border-box;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            input[type="submit"] {
                background-color: #4caf50;
                color: #fff;
                cursor: pointer;
            }

            input[type="submit"]:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>



        <form method="post" action="<?= site_url('Auth/registerForm') ?>">

            <label for="nom_utilisateur">Nom d'utilisateur </label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur" required maxlength="50">

            <label for="password">Mot de passe </label>
            <input type="password" id="password" name="password" required>

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required maxlength="50">

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required maxlength="50">

            <label for="telephone">Téléphone :</label>
            <input type="tel" id="telephone" name="telephone" required>

            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" required maxlength="50">

            <label for="adressemail">Adresse Email :</label>
            <input type="email" id="adressemail" name="adressemail" required maxlength="50">

            <label for="date_client">Date de Naissance :</label>
            <input type="date" id="date_client" name="date_client" required>

            <input type="submit" value="Soumettre">
        </form>

    </body>
</html>