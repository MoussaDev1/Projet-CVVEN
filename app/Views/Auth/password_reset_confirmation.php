<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Password Reset Confirmation</title>
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

            .alert {
                margin-top: 20px;
            }

            .alert-success {
                color: green;
            }

            .alert-danger {
                color: red;
            }
        </style>
    </head>
    <body>

        <div class="form-container">
            <h2>Reinitialisation</h2>
            <form action="<?= site_url('Auth/password_reset_confirmation'); ?>" method="post">
                <label for="password_reset">Veuillez entrer votre nouveau mot de passe:</label>
                <input type="password" id="password_reset" name="password_reset" required>
                <input type="submit" value="Envoyer">
            </form>
        </div>

        <script>
            // Fonction pour masquer la form-container
            function clearPage() {
                var formContainer = document.getElementsByClassName('form-container')[0];
                formContainer.hidden = true;
            }

            // Exécuter la fonction après que le DOM a été chargé
            document.addEventListener('DOMContentLoaded', function () {
<?php if (session()->getFlashdata('success_message') || session()->getFlashdata('error_message')) : ?>
                    clearPage();
<?php endif; ?>
            });
        </script>

        <?php if (session()->getFlashdata('success_message')) : ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success_message');
            session()->remove('success_message');
            ?>
                
                <a href="<?= site_url('Auth/view/login') ?>"> Retourner à la page de Login </a>
            </div>
        <?php elseif (session()->getFlashdata('error_message')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error_message');
        session()->remove('error_message');
        ?>
                <a href="<?= site_url('Auth/view/login') ?>"> Retourner à la page de Login </a>
            </div>
        <?php endif; ?>

    </body>
</html>