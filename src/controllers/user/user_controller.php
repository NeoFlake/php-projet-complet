<?php

include "../../services/user/user_service.php";

session_start();

if (str_contains($_SERVER['HTTP_REFERER'], "user_creation.php") and $_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = htmlentities($_POST["username"]);
    $password = htmlentities($_POST["password"]);
    $first_name = htmlentities($_POST["first_name"]);
    $last_name = htmlentities($_POST["last_name"]);

    $saved = save_new_user($username, $password, $first_name, $last_name);

    if ($saved === true) {
        $user = get_user($username);
        if (is_string($user)) {
            $_SESSION["username"] = $username;
            $_SESSION["first_name"] = $first_name;
            $_SESSION["last_name"] = $last_name;
            $_SESSION["fail_creation"] = $saved;
            header("location: ../../../views/user/user_creation.php");
        } else {
            $_SESSION["username_logged"] = $user["username"];
            $_SESSION["user"] = $user;
            header("location: ../../../views/user/user_board.php");
        }
    } else {
        $_SESSION["username"] = $username;
        $_SESSION["first_name"] = $first_name;
        $_SESSION["last_name"] = $last_name;
        $_SESSION["fail_creation"] = $saved;
        header("location: ../../../views/user/user_creation.php");
    }
    die();
}

if (str_contains($_SERVER['HTTP_REFERER'], "user_login.php") and $_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = htmlentities($_POST["username"]);
    $password = htmlentities($_POST["password"]);

    $logged = user_login($username, $password);

    if (!is_string($logged)) {
        $_SESSION["username_logged"] = $logged["username"];
        $_SESSION["user"] = $logged;
        header("location: ../../../views/user/user_board.php");
    } else {
        $_SESSION["username"] = $username;
        $_SESSION["fail_connexion"] = $logged;
        header("location: ../../../views/user/user_login.php");
    }
    die();
}

if (str_contains($_SERVER['HTTP_REFERER'], "user_board.php") and $_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['modify_user_button']) and $_POST['modify_user_button'] === "validated") {

    $old_values = $_SESSION["user"];

    $new_values = [
        "username" => htmlentities($_POST["new_username"]),
        "old_password" => htmlentities($_POST["old_password"]),
        "new_password" => htmlentities($_POST["new_password"]),
        "confirm_password" => htmlentities($_POST["confirm_password"]),
        "first_name" => htmlentities($_POST["new_first_name"]),
        "last_name" => htmlentities($_POST["new_last_name"])
    ];

    $updated = update_user($old_values, $new_values);

    if (!is_string($updated)) {
        $_SESSION["user"] = $updated;
    } else {
        $_SESSION["fail_udpate"] = $updated;
    }

    $_SESSION["displayed_zone"] = "modify_user";

    header("location: ../../../views/user/user_board.php");
    die();
}

if (str_contains($_SERVER['HTTP_REFERER'], "user_board.php") and $_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['delete_first_step']) and  $_POST['delete_first_step']=== "validated" or $_POST['delete_first_step'] === "aborted") {

    if ($_POST['delete_first_step'] === "validated") {
        $_SESSION["displayed_zone"] = "delete_user";
        $_SESSION["deleting_step"] = 2;
    }

    header("location: ../../../views/user/user_board.php");
    die();
}

if (str_contains($_SERVER['HTTP_REFERER'], "user_board.php") and $_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['delete_second_step']) and $_POST['delete_second_step'] === "confirmed") {

    $username = htmlentities($_POST["username"]);
    $password = htmlentities($_POST["password"]);

    $logged = user_login($username, $password);

    if (!is_string($logged)) {
        $_SESSION["displayed_zone"] = "delete_user";
        $_SESSION["deleting_step"] = 3;
    }

    header("location: ../../../views/user/user_board.php");
    die();
}

if (str_contains($_SERVER['HTTP_REFERER'], "user_board.php") and $_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['delete_last_step']) and $_POST['delete_last_step'] === "confirmed") {

    $total_destruction = htmlentities($_POST["total_destruction"]);

    if (verify_total_destruction_condition($total_destruction) === true) {
        $deleted_user = delete_user($_SESSION["user"]);

        if(!is_string($deleted_user)){
            unset($_SESSION["user"]);
            unset($_SESSION["username_logged"]);
            header("location: ../../../views/user/user_login.php");
        }
        header("location: ../../../views/user/user_board.php");
    } else {
        header("location: ../../../views/user/user_board.php");
    }

    die();
}
