<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Oubli de Mot de Passe</title>
        <link rel="stylesheet" href="styles.css">
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

            .form-container {
                background-color: #fff;
                border-radius: 8px;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 300px;
                text-align: center;
            }

            h2 {
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

            a {
                color: #555;
                text-decoration: none;
            }

            a:hover {
                color: #333;
            }
        </style>

    </head>
    <body>
        <div class="form-container">
            <h2>Oubli de Mot de Passe</h2>
            <form action="<?= site_url('Auth/forgetPassword'); ?>" method="post">
                <label for="email_reset">Adresse Email :</label>
                <input type="email" id="email_reset" name="email_reset" required>
                <input type="submit" value="Envoyer">
            </form>
            <p><a href="<?= site_url('Auth/view/login'); ?>">Retour à la page de connexion</a></p>
        </div>

    </body>
</html>

