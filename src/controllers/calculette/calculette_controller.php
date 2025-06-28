<?php

include "../../services/calculette/calculette_service.php";

session_start();

// Travail métier lors de la soumission du formulaire de calcul lors de la calculette
if(str_contains($_SERVER['HTTP_REFERER'], "calculette.php") and $_SERVER['REQUEST_METHOD'] == 'POST'){
    // Stockage valeurs pour transmission au service
    $first_number = $_POST["first_number"];
    $second_number = $_POST["second_number"];
    $operator = $_POST["operator"];
    // Stockage valeurs pour retour à la vue
    $_SESSION["first_number"] = $first_number;
    $_SESSION["second_number"] = $second_number;
    $_SESSION["operator"] = $operator;
    // Exécution de la méthode du service pour calcul
    $_SESSION["result"] = calculate($first_number, $second_number, $operator);
    // Redirection vers la vue adéquate
    header("location: ../../../views/calculette.php");
    die();
}