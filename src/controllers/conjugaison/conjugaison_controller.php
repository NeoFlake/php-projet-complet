<?php

include "../../services/conjugaison/conjugaison_service.php";

session_start();

if(str_contains($_SERVER['HTTP_REFERER'], "conjugaison.php") and $_SERVER['REQUEST_METHOD'] == 'POST'){
    $verb = htmlentities($_POST["verb"]);
    $temps = $_POST["temps"];
    // Exécution de la méthode du service pour calcul
    $_SESSION["table_de_conjugaison"] = conjuguer($verb, $temps);
    $_SESSION["temps"] = $temps;
    $_SESSION["verb"] = $verb;
    // Redirection vers la vue adéquate
    header("location: ../../../views/conjugaison/conjugaison.php");
     die();
}

if(str_contains($_SERVER['HTTP_REFERER'], "user_board.php") and $_SERVER['REQUEST_METHOD'] == 'POST'){

    $historique_conjugaison = get_all_conjugaison_by_id($_SESSION["user"]["id"]);
    if(!is_string($historique_conjugaison)){
        $_SESSION["displayed_zone"] = "conjugaison_history";
        $_SESSION["historique_conjugaison"] = $historique_conjugaison;
    } 
    header("location: ../../../views/user/user_board.php");
    // Redirection vers la vue adéquate
    die();
}