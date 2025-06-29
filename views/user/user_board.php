<?php

session_start();

if (!isset($_SESSION["username_logged"])) {
    header("location: ../../../views/user/user_creation.php");
    die();
} else {
    $username_logged = $_SESSION["username_logged"];
    $first_name = $_SESSION["first_name"];
    $last_name = $_SESSION["last_name"];
    $date_of_creation = strtotime($_SESSION["date_of_creation"]); // -> On transforme la string de date en format date pure
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de l'utilisateur</title>
    <?php include "../partial.php/bootstrap_header.php" ?>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center mt-5">
            <h1>Tableau de bord de <?php echo $first_name . " " . $last_name ?></h1>
        </div>
        <div class="mt-5">
            <span>Vous êtes inscrit depuis le <?php echo $date_of_creation ?></span>
        </div>
        <div class="mt-3 row">
            <div class="col-2">
                <div class="row">
                    <button class="btn btn-primary col-11">Historique calculette</button>
                </div>
            </div>
            <div class="col-3">
                <div class="row">
                    <button class="btn btn-success col-7">Historique conjugaison</button>
                </div>
            </div>
        </div>
        <div class="mt-3 row">
            <div class="col-2">
                <div class="row">
                    <button class="btn btn-warning col-11">Modifier compte</button>
                </div>
            </div>
            <div class="col-3">
                <div class="row">
                    <button class="btn btn-danger col-7">Supprimer compte</button>
                </div>
            </div>
        </div>
    </div>
    <?php include "../partial.php/bootstrap_body.php" ?>
</body>

</html>