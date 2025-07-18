<?php

session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include "../../src/services/user/user_service.php";

if (!isset($_SESSION["username_logged"]) or !isset($_SESSION["user"])) {
    header("location: ./user_login.php");
} else {
    $username_logged = $_SESSION["username_logged"];
    $first_name = $_SESSION["user"]["first_name"] ?? "";
    $last_name = $_SESSION["user"]["last_name"] ?? "";
    $date_of_creation = $_SESSION["user"]["date_of_creation"] ?? "";
    $date_of_last_modify = $_SESSION["user"]["date_of_last_modify"] !== $_SESSION["user"]["date_of_creation"] ? $_SESSION["user"]["date_of_last_modify"] : null;
    $displayed_zone = $_POST["display_zone"] ?? $_SESSION["displayed_zone"] ?? null;
    $fail_update = $_SESSION["fail_udpate"] ?? null;
    $calcul_historic_null = $_SESSION["calcul_historic_null"] ?? null;
    $conjugaison_historic_null = $_SESSION["conjugaison_historic_null"] ?? null;

    $deleting_step = $_SESSION["deleting_step"] ?? null;

    $historique_calculette = $_SESSION["historique_calculette"] ?? null;

    $historique_conjugaison = $_SESSION["historique_conjugaison"] ?? null;

    unset(
        $_SESSION["fail_udpate"],
        $_SESSION["displayed_zone"],
        $_SESSION["deleting_step"],
        $_SESSION["historique_calculette"],
        $_SESSION["calcul_historic_null"],
        $_SESSION["historique_conjugaison"],
        $_SESSION["conjugaison_historic_null"]
    );
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de l'utilisateur</title>
    <?php include "../partial/shared/_bootstrap_header.php" ?>
</head>

<body>
    <div class="container">
        <?php include "../partial/shared/_navbar.php" ?>
        <div class="d-flex justify-content-center mt-5">
            <h1>Tableau de bord de <?php echo $first_name . " " . $last_name ?></h1>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="mt-5">
                    <span>Vous êtes inscrit depuis le <?php echo format_date($date_of_creation) ?></span>
                </div>
                <div class="mt-3 row">
                    <form action="../../src/controllers/calculette/calculette_controller.php" method="post" class="col-5">
                        <div class="row">
                            <button class="btn btn-primary" name="display_zone" value="calcul_history">Historique calculette</button>
                        </div>
                    </form>
                    <form action="../../src/controllers/conjugaison/conjugaison_controller.php" method="post" class="col-7">
                        <div class="row">
                            <button class="btn btn-success col-9 offset-1" name="display_zone" value="conjugaison_history">Historique conjugaison</button>
                        </div>
                    </form>
                </div>
                <form action="./user_board.php" method="post">
                    <div class="mt-3 row">
                        <div class="col-5">
                            <div class="row">
                                <button class="btn btn-warning" name="display_zone" value="modify_user">Modifier compte</button>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="row">
                                <button class="btn btn-danger col-9 offset-1" name="display_zone" value="delete_user">Supprimer compte</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-8 mt-5">
                <!-- Zone multifonction pour afficher les 4 options différentes -->
                <?php if (isset($displayed_zone)) {
                    switch ($displayed_zone) {
                        case "calcul_history":
                            include "../partial/user_board/_calcul_history_partial.php";
                            break;
                        case "conjugaison_history":
                            include "../partial/user_board/_conjugaison_history_partial.php";
                            break;
                        case "modify_user":
                            include "../partial/user_board/_modify_user_partial.php";
                            break;
                        case "delete_user":
                            include "../partial/user_board/_delete_user_partial.php";
                            break;
                    }
                } ?>
            </div>
        </div>
    </div>
    <?php include "../partial/shared/_bootstrap_body.php" ?>
</body>

</html>