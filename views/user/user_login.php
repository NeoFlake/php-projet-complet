<?php

session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$username = $_SESSION["username"] ?? "";
$fail_connexion = $_SESSION["fail_connexion"] ?? null;

if (isset($_SESSION["username_logged"])) {
    header("location: ./user_board.php");
}

unset($_SESSION['username'], $_SESSION["fail_connexion"]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion utilisateur</title>
    <?php include "../partial/shared/_bootstrap_header.php" ?>
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
    <?php include "../partial/shared/_bootstrap_body.php" ?>
</body>

</html>