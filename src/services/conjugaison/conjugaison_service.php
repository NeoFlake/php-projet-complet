<?php

include __DIR__ . "/../../repositories/conjugaison_repositorie.php";

function conjuguer($verb = "conjuguer", $temps = "present")
{

    $result = "Erreur: Impossible de conjuguer ";
    if ($verb != "") {
        if (substr($verb, -2, 2) == "er" and $verb != "aller") {
            $result = ["je ", "tu ", "il / elle ", "nous ", "vous ", "ils / elles "];
            switch ($temps) {
                case "present":
                    $verb = substr($verb, 0, strlen($verb) - 1);
                    $result[0] .= $verb;
                    $result[1] .= $verb . "s";
                    $result[2] .= $verb;
                    $result[3] .= (substr($verb, -2, 1) == "g" ? $verb . "ons" : (substr($verb, -2, 1) == "c" ?
                        substr($verb, 0, strlen($verb) - 2) . "çons" : substr($verb, 0, strlen($verb) - 1) . "ons"));
                    $result[4] .= $verb . "z";
                    $result[5] .= $verb . "nt";
                    break;
                case "futur":
                    $result[0] .= $verb . "ai";
                    $result[1] .= $verb . "as";
                    $result[2] .= $verb . "a";
                    $result[3] .= $verb . "ons";
                    $result[4] .= $verb . "ez";
                    $result[5] .= $verb . "ont";
                    break;
                case "imparfait":
                    $verb = substr($verb, -3, 1) == "g" ? substr($verb, 0, strlen($verb) - 1) : (substr($verb, -3, 1) == "c" ?   substr($verb, 0, strlen($verb) - 3) . "ç" : substr($verb, 0, strlen($verb) - 2));
                    $result[0] .= $verb . "ais";
                    $result[1] .= $verb . "ais";
                    $result[2] .= $verb . "ait";
                    $result[3] .= $verb . "ions";
                    $result[4] .= $verb . "iez";
                    $result[5] .= $verb . "aient";
                    break;
            }
        } else {
            $result .= "car le verbe entré qui est \"" . $verb . "\" n'est pas un verbe du premier groupe";
        }
    } else {
        $result .= "car vous n'avez pas entré de verbe";
    }

    return $result;
}

function save_log_of_conjugaison($conjugaison_to_save)
{
    $result = "Échec de la sauvegarde de la conjugaison : ";
    try {
        $id_transaction = save_new_conjugaison($conjugaison_to_save);

        if ($id_transaction !== false) {
            foreach ($conjugaison_to_save["table_de_conjugaison"] as $index => $ligne_de_conjugaison) {
                save_new_row_of_conjugaison($id_transaction, $index, $ligne_de_conjugaison);
            }
            $result = true;
        }
    } catch (PDOException $pdo_error) {
        $result .= "Erreur fatale (" . $pdo_error->getMessage() . "), veuillez réessayer";
    }
    return $result;
}

function get_all_conjugaison_by_id($id)
{
    $result = "Échec de réception de l'historique des conjugaisons : ";
    try {
        $db_answer = get_by_id($id);
        $actual_verb = "";
        $part_of_result = [];
        foreach ($db_answer as $row_answer) {
            if ($row_answer["verb"] !== $actual_verb) {
                // On initialise une seule fois les infos générales
                $part_of_result = [
                    "verb" => $row_answer["verb"],
                    "temps" => $row_answer["temps"],
                    "date_of_creation" => $row_answer["date_of_creation"],
                    "conjugaisons" => []
                ];

                $actual_verb = $part_of_result["verb"];
            }

            array_push($part_of_result["conjugaisons"], $row_answer["conjugaison"]);

            if (count($part_of_result["conjugaisons"]) === 6) {
                if(is_string($result)){
                    $result = [];
                }
                ksort($part_of_result["conjugaisons"]);
                $part_of_result["conjugaisons"] = array_values($part_of_result["conjugaisons"]);
                array_push($result, $part_of_result);
            }
        }

        return $result;

    } catch (PDOException $pdo_error) {
        $result .= "Erreur fatale (" . $pdo_error->getMessage() . "), veuillez réessayer";
    } catch (Error $error) {
        $result .= $error->getMessage();
    }

    return $result;
}
