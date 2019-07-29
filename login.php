<?php
require_once("vendor/autoload.php");
session_start();
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

if (!empty($_SESSION['authenticated'])) {
    header('Location: index.php');
    die();
}

$password = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST["password"])) {
        $password = $_POST["password"];
        if ($password == getenv("LOGIN_PASSWORD")) {
            $_SESSION["authenticated"] = true;
            header('Location: index.php');
        } else {
            header('Location: login.php?invalid');
        }
    } else {
        header('Location: login.php?invalid');
    }
} else {
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Login</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

        <!-- Bootstrap core CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <style>
            html,
            body {
                height: 100%;
            }

            body {
                display: -ms-flexbox;
                display: -webkit-box;
                display: flex;
                -ms-flex-align: center;
                -ms-flex-pack: center;
                -webkit-box-align: center;
                align-items: center;
                -webkit-box-pack: center;
                justify-content: center;
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #f5f5f5;
            }

            .form-signin {
                width: 100%;
                max-width: 330px;
                padding: 15px;
                margin: 0 auto;
            }

            .form-signin .checkbox {
                font-weight: 400;
            }

            .form-signin .form-control {
                position: relative;
                box-sizing: border-box;
                height: auto;
                padding: 10px;
                font-size: 16px;
            }

            .form-signin .form-control:focus {
                z-index: 2;
            }

            .form-signin input[type="email"] {
                margin-bottom: -1px;
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
            }

            .form-signin input[type="password"] {
                margin-bottom: 10px;
                border-top-left-radius: 0;
                border-top-right-radius: 0;
            }
        </style>
    </head>

    <body class="text-center">
    <form class="form-signin" method="post">
        <?php
        if (isset($_GET['invalid'])) { ?>
            <div class="alert alert-danger">Invalid Login Details</div>
        <?php }
        ?>
        <h1 class="h3 mb-3 font-weight-normal">Please Login</h1>
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
    </body>
    </html>

<?php } ?>
