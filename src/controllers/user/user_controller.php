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
            $_SESSION["first_name"] = $user["first_name"];
            $_SESSION["last_name"] = $user["last_name"];
            $_SESSION["date_of_creation"] = format_date($user["date_of_creation"]);
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
        $_SESSION["first_name"] = $logged["first_name"];
        $_SESSION["last_name"] = $logged["last_name"];
        $_SESSION["date_of_creation"] = format_date($logged["date_of_creation"]);
        header("location: ../../../views/user/user_board.php");
    } else {
        $_SESSION["username"] = $username;
        $_SESSION["fail_connexion"] = $logged;
        header("location: ../../../views/user/user_login.php");
    }
    die();
}
