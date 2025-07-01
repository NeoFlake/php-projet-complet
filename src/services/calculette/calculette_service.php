<?php

include __DIR__ . "/../../repositories/calculette_repositorie.php";

function calculate($first_number = 0, $second_number = 0, $operator = "add")
{

    $result = "Erreur: Impossible d'effectuer votre calcul, veuillez effectuer une nouvelle demande";

    if ($first_number != "" && $second_number != "") {
        switch ($operator) {
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
        }
    }

    return $result;
}

// Fonction permettant de conditionner l'affichage selon le signe entrée par l'utilisateur
function fixSignus($operator)
{
    $result = "+";
    switch ($operator) {
        case "subtract":
            $result = "-";
            break;
        case "multiply":
            $result = "x";
            break;
        case "divide":
            $result = "/";
            break;
    }
    return $result;
}

function save_calcul($operation){
    $result = "Échec de la sauvegarde du calcul : ";
    try {
        save_new_calcul($operation);
        $result = true;
    } catch(PDOException $pdo_error){
        $result .= "Erreur fatale (" . $pdo_error->getMessage() . "), veuillez réessayer";
    }
    return $result;
}

function get_all_calcul_by_id($id){
    $result = "Échec de réception de l'historique des calculs : ";
    try {
        $result = get_by_id($id);
    } catch (PDOException $pdo_error){
        $result .= "Erreur fatale (" . $pdo_error->getMessage() . "), veuillez réessayer";
    } catch(Error $error) {
        $result . $error->getMessage();
    }
    return $result;
}
