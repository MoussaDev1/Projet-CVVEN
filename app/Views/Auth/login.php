<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion</title>
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

            .forgot-password {
                text-align: right;
                color: #555;
            }
        </style>
    </head>
    <body>

        <?php if (session()->get('error_login')) : ?>
            <p><?= session()->get('error_login'); ?> !</p>
        <?php endif; ?>

        <form action="<?= site_url('Auth/connexion') ?>" method="post">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <div>
                <a href="<?= site_url('Auth/view/register') ?>">S'inscrire</a>
            </div>

            <div class="forgot-password">
                <?php echo '<p><a href="' . site_url('Auth/view/reset_password') . '">Mot de passe oublié</a></p>' ?>
            </div>


            <input type="submit" value="Se connecter">
        </form>

    </body>
</html>
