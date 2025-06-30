<?php

session_start();

$username = $_SESSION["username"] ?? "";
$fail_connexion = $_SESSION["fail_connexion"] ?? null;

unset($_SESSION['username'], $_SESSION["fail_connexion"]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion utilisateur</title>
    <?php include "../partial/_bootstrap_header.php" ?>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center mt-5">
            <h1>Connexion</h1>
        </div>
        <div class="d-flex justify-content-center mt-5">
            <form action="../../src/controllers/user/user_controller.php" method="post">
                <div class="row">
                    <div class="col-12">
                        <label for="username" class="form-label">Pseudonyme </label>
                        <input type="text" id="username" name="username" class="form-control" value="<?php echo $username ?>" />
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <label for="password" class="form-label">Password </label>
                        <input type="password" id="password" name="password" class="form-control" />
                    </div>
                </div>
                <div class="row mt-5 d-flex justify-content-center">
                    <button class="btn btn-primary col-10">Connexion</button>
                </div>
            </form>
        </div>
        <div class="d-flex justify-content-center mt-5">
            <span>Vous n'avez pas de compte ? <a href="./user_creation.php">Inscrivez-vous</a></span>
        </div>
        <div class="d-flex justify-content-center mt-5">
            <div class="d-flex justify-content-center mt-5">
                <span> <?php echo $fail_connexion ?></span>
            </div>
        </div>
    </div>
    <?php include "../partial/_bootstrap_body.php" ?>
</body>

</html>