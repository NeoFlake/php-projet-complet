<?php

session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$username = $_SESSION["username"] ?? "";
$first_name = $_SESSION["first_name"] ?? "";
$last_name = $_SESSION["last_name"] ?? "";
$fail_creation = $_SESSION["fail_creation"] ?? null;

if(isset($_SESSION["username_logged"])){
    header("location: ./user_board.php");
}

unset($_SESSION['username'], $_SESSION['first_name'], $_SESSION['last_name'], $_SESSION["fail_creation"]);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création utilisateur</title>
    <?php include "../partial/_bootstrap_header.php" ?>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center mt-5">
            <h1>Création de compte</h1>
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
                        <label for="password" class="form-label">Mot de passe </label>
                        <input type="password" id="password" name="password" class="form-control" />
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <label for="first_name" class="form-label">Prénom </label>
                        <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo $first_name ?>" />
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <label for="last_name" class="form-label">Nom de Famille </label>
                        <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo $last_name ?>" />
                    </div>
                </div>
                <div class="row mt-5 d-flex justify-content-center">
                    <button class="btn btn-primary col-10">Créer</button>
                </div>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <span>Vous avez déjà un compte ? <a href="./user_login.php">Connectez-vous</a></span>
    </div>
    <div class="d-flex justify-content-center mt-5">
            <div class="d-flex justify-content-center mt-5">
                <span> <?php echo $fail_creation ?></span>
            </div>
        </div>
    <?php include "../partial/_bootstrap_body.php" ?>
</body>

</html>