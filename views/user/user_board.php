<?php

session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

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

    $deleting_step = $_SESSION["deleting_step"] ?? null;

    $historique_calculette = $_SESSION["historique_calculette"] ?? null;

    unset($_SESSION["fail_udpate"], $_SESSION["displayed_zone"], $_SESSION["deleting_step"], $_SESSION["historique_calculette"]);
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
        <div class="row">
            <div class="col-4">
                <div class="mt-5">
                    <span>Vous êtes inscrit depuis le <?php echo format_date($date_of_creation) ?></span>
                </div>
                <form action="../../src/controllers/calculette/calculette_controller.php" method="post">
                    <div class="mt-3 row">
                        <div class="col-5">
                            <div class="row">
                                <button class="btn btn-primary" name="display_zone" value="calcul_history">Historique calculette</button>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="row">
                                <button class="btn btn-success col-9 offset-1">Historique conjugaison</button>
                            </div>
                        </div>
                    </div>
                </form>
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
                        case "calcul_history": ?>
                        <div class="mb-3">
                            <span>Historique de vos utilisations de la calculette :</span>
                        </div>
                        <ul>
                        <?php foreach($historique_calculette as $calcul){ ?>
                            <li><?php 
                            $result = "Le " . (new DateTime($calcul["date_of_creation"]))->format('d/m/Y \à H\h i\m\i\n s\s\e\c') 
                            . " vous avez fait le calcul " . $calcul["first_number"] . " ";
                            switch($calcul["operator"]){
                                case "add":
                                    $result .= "+";
                                    break;
                                case "subtract":
                                    $result .= "-";
                                    break;
                                case "multiply":
                                    $result .= "x";
                                    break;
                                case "divide":
                                    $result .= "/";
                                    break;
                            }
                            $result .= " " . $calcul["second_number"] . " = " . $calcul["result"];
                            echo $result ?></li>
                        <?php } ?>
                        </ul>
                        <?php break;
                        case "modify_user":
                ?>
                            <?php if (isset($date_of_last_modify)) { ?>
                                <div class="row">
                                    <span>Dernière modification : <?php echo format_date($date_of_last_modify) ?></span>
                                </div>
                            <?php } ?>
                            <form action="../../src/controllers/user/user_controller.php" method="post" class="mt-3">
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
                            <?php
                            if (isset($fail_update)) { ?>
                                <div class="mt-3">
                                    <span> <?php echo $fail_update ?></span>
                                </div>
                            <?php }
                            break;
                        case "delete_user": ?>
                            <form action="../../src/controllers/user/user_controller.php" method="post">
                                <div class="row ms-1">
                                    <span><?php echo isset($deleting_step) ? "Procédure de destruction de compte en cours" : "Voulez-vous vraiment détruire votre compte" ?></span>
                                    <div class="mt-3">
                                        <button class="btn btn-warning col-2" name="delete_first_step" value="validated" <?php echo isset($deleting_step) ? "disabled" : null ?>>Oui</button>
                                        <button class="btn btn-success col-2 ms-3" name="delete_first_step" value="aborted" <?php echo isset($deleting_step) ? "disabled" : null ?>>Non</button>
                                    </div>
                                </div>
                            </form>
                            <?php if (isset($deleting_step) and $deleting_step > 1) { ?>
                                <form action="../../src/controllers/user/user_controller.php" method="post">
                                    <div class="row ms-1">
                                        <span class="mt-3"><?php echo ($deleting_step > 2) ? "Identité confirmé" : "Confirmez votre identité pour continuer la procédure" ?></span>
                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <label for="username" class="form-label">Pseudonyme </label>
                                                <input type="text" id="username" name="username" class="form-control" <?php echo $deleting_step > 2 ? "disabled" : null ?> />
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                <label for="password" class="form-label">Mot de passe</label>
                                                <input type="password" id="password" name="password" class="form-control" <?php echo $deleting_step > 2 ? "disabled" : null ?> />
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn btn-warning col-2 ms-3" name="delete_second_step" value="confirmed" <?php echo $deleting_step > 2 ? "disabled" : null ?>>Confirmer</button>
                                        </div>
                                    </div>
                                </form>
                            <?php }
                            if ($deleting_step > 2) { ?>
                                <form action="../../src/controllers/user/user_controller.php" method="post">
                                    <div class="row ms-1 mt-5">
                                        <span class="mt-3">Écrivez "CONFIRMER DESTRUCTION" pour terminer la procédure de destruction</span>
                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <input type="text" id="total_destruction" name="total_destruction" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn btn-danger col-4 ms-3" name="delete_last_step" value="confirmed">Détruire définitivement</button>
                                        </div>
                                    </div>
                                </form>
                            <?php } ?>
                <?php break;
                    }
                } ?>
            </div>
        </div>
    </div>
    <?php include "../partial/_bootstrap_body.php" ?>
</body>

</html>