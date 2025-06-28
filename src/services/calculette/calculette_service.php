<?php 

function calculate($first_number = 0, $second_number = 0, $operator = "add") {

    $result = 0;

    switch($operator){
        case "add":
            $result = $first_number + $second_number;
            break;
        case "subtract":
            $result = $first_number - $second_number;
            break;
        case "multiply":
            $result = $first_number * $second_number;
            break;
        case "divide":
            $result = $second_number == 0 ? $result = "Erreur: Il n'est pas possible de diviser par zéro" : $first_number / $second_number;
            break;
        default:
            $result = "Erreur: Impossible d'effectuer votre calcul, veuillez effectuer une nouvelle demande";
    }

    return $result;
}