<?php

session_start();

include "../../src/services/user/user_service.php";

if (!isset($_SESSION["username_logged"]) or !isset($_SESSION["user"])) {
    header("location: ./user_login.php");
    die();
} else {
    $username_logged = $_SESSION["username_logged"];
    $first_name = $_SESSION["user"]["first_name"] ?? "";
    $last_name = $_SESSION["user"]["last_name"] ?? "";
    $date_of_creation = $_SESSION["user"]["date_of_creation"] ?? "";
    $date_of_last_modify = $_SESSION["user"]["date_of_last_modify"] !== $_SESSION["user"]["date_of_creation"] ? $_SESSION["user"]["date_of_last_modify"] : null;
    $displayed_zone = $_POST["display_zone"] ?? $_SESSION["displayed_zone"] ?? null;
    $fail_update = $_SESSION["fail_udpate"] ?? null;

    unset($_SESSION["fail_udpate"], $_SESSION["displayed_zone"]);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de l'utilisateur</title>
    <?php include "../partial/_bootstrap_header.php" ?>
</head>

<body>
    <div class="container">
        <?php include "../partial/_navbar.php" ?>
        <div class="d-flex justify-content-center mt-5">
            <h1>Tableau de bord de <?php echo $first_name . " " . $last_name ?></h1>
        </div>
        <div class="mt-5">
            <span>Vous êtes inscrit depuis le <?php echo format_date($date_of_creation) ?></span>
        </div>
        <div class="row">
            <div class="col-4">
                <form action="./user_board.php" method="post">
                    <div class="mt-3 row">
                        <div class="col-5">
                            <div class="row">
                                <button class="btn btn-primary">Historique calculette</button>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="row">
                                <button class="btn btn-success col-9 offset-1">Historique conjugaison</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 row">
                        <div class="col-5">
                            <div class="row">
                                <button class="btn btn-warning" name="display_zone" value="modify_user">Modifier compte</button>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="row">
                                <button class="btn btn-danger col-9 offset-1">Supprimer compte</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-8">
                <?php if (isset($displayed_zone)) {
                    if ($displayed_zone === "modify_user") { ?>
                        <?php if (isset($date_of_last_modify)) { ?>
                            <div class="row">
                                <span>Dernière modification : <?php echo format_date($date_of_last_modify) ?></span>
                            </div>
                        <?php } ?>
                        <form action="../../src/controllers/user/user_controller.php" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <label for="username" class="form-label">Pseudonyme </label>
                                    <input type="text" id="username" name="new_username" class="form-control" value="<?php echo $username_logged ?>" />
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <label for="password" class="form-label">Ancien Mot de passe (obligatoire pour modification)</label>
                                    <input type="password" id="password" name="old_password" class="form-control" />
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <label for="password" class="form-label">Nouveau Mot de passe</label>
                                    <input type="password" id="password" name="new_password" class="form-control" />
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <label for="password" class="form-label">Confirmer Mot de passe</label>
                                    <input type="password" id="password" name="confirm_password" class="form-control" />
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <label for="first_name" class="form-label">Prénom </label>
                                    <input type="text" id="first_name" name="new_first_name" class="form-control" value="<?php echo $first_name ?>" />
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <label for="last_name" class="form-label">Nom de Famille </label>
                                    <input type="text" id="last_name" name="new_last_name" class="form-control" value="<?php echo $last_name ?>" />
                                </div>
                            </div>
                            <div class="row mt-5 ms-1">
                                <button class="btn btn-primary col-3" name="modify_user_button" value="validated">Modifier</button>
                            </div>
                        </form>
                    <?php }
                    if (isset($fail_update)) { ?>
                    <div class="mt-3">
                        <span> <?php echo $fail_update ?></span>
                    </div>
                <?php }
                }
                ?>
            </div>
        </div>
    </div>
    <?php include "../partial/_bootstrap_body.php" ?>
</body>

</html>