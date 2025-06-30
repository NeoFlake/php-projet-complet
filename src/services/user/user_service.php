<?php

include __DIR__ . "/../../repositories/user_repositorie.php";

function save_new_user($username, $password, $first_name, $last_name)
{

    $result = "Échec de création de l'utilisateur : ";

    if ($username == "" or $password == "") {
        $result .= "Absence de pseudonyme ou de mot de passe";
    } else {
        $first_name == "" ? $first_name = "Thomas" : null;
        $last_name == "" ? $last_name = "Anderson" : null;
        try {
            get_user_by_username($username);
            $result .= "Un utilisateur avec ce pseudonyme existe déjà";
        } catch (PDOException $pdoError) {
            $result .= "Erreur fatale lors du processus de vérification de la création de compte -> " . $pdoError->getMessage();
        } catch (Exception $error) {
            try {
                save_user($username, $password, $first_name, $last_name);
                $result = true;
            } catch (PDOException $saveError) {
                $result .= "Erreur fatale lors du processus de sauvegarde du nouveau compte -> " . $saveError->getMessage();
            }
        }
    }

    return $result;
}

function get_user($username)
{

    $result = "Échec de récupération de l'utilisateur : ";

    try {
        $result = get_user_by_username($username);
    } catch (PDOException $pdoError) {
        $result .= "Erreur fatale lors du processus de vérification de la création de compte -> " . $pdoError->getMessage();
    } catch (Exception $error) {
        $result .= $error->getMessage();
    }

    return $result;
}

function user_login($username, $password)
{

    $result = "Échec de connexion : ";

    if ($username === "") {
        $result .= "Pseudonyme sans valeur; veuillez valoriser";
    } else if ($password === "") {
        $result .= "Mot de passe sans valeur; veuillez valoriser";
    } else {
        try {
            $user = get_user_by_username($username);
            if ($user["password"] === $password) {
                $result = $user;
            } else {
                $result .= "Le mot de passe est incorrect";
            }
        } catch (PDOException $pdo_error) {
            $result .= "Erreur Fatale lors de la demande de connexion; veuillez réessayer (" . $pdo_error->getMessage() . ")";
        } catch (Exception $error) {
            $result .= "L'utilisateur n'existe pas";
        }
    }

    return $result;
}

function update_user($old_values, $new_values)
{
    $result = "Échec de la mise à jour du profil : ";
    $verified_login = user_login($old_values["username"], $new_values["old_password"]);

    if (is_string($verified_login)) {
        $result .= "Votre ancien mot de passe est invalide; veuillez réessayer";
    } else {
        // Vérification de la disponibilité du username si celui-ci a été modifié
        if ($old_values["username"] !== $new_values["username"] or $new_values["username"] === "") {
            if ($new_values["username"] === "") {
                $result .= "Veuillez renseigner un pseudonyme s'il vous plait";
            } else {
                try {
                    get_user_by_username($new_values["username"]);
                    $updating_user = second_part_of_update_user($old_values, $new_values);
                    is_string($updating_user) ? $result .= $updating_user : $result = $updating_user;
                } catch (Error $error) {
                    $result .= "Le pseudonyme souhaité est déjà utilisé; veuillez en choisir un autre";
                } catch (PDOException $pdoError) {
                    $result .= "Erreur Fatale lors du traîtement de la mise à jour profil, veuillez réessayer";
                }
            }
        } else {
            $updating_user = second_part_of_update_user($old_values, $new_values);
            is_string($updating_user) ? $result .= $updating_user : $result = $updating_user;
        }
    }

    return $result;
}

function second_part_of_update_user($old_values, $new_values){

    $result = "";

    if (isset($new_values["new_password"]) and $new_values["confirm_password"] !== "" and $new_values["new_password"] !== $new_values["confirm_password"]) {
                $result .= "Votre nouveau mot de passe ne correspond pas à sa confirmation";
            }
            $new_user_to_insert = [
                "id" => $old_values["id"],
                "username" => $new_values["username"],
                "password" => (isset($new_values["new_password"]) and $new_values["confirm_password"] !== "") ? $new_values["new_password"] : $old_values["password"],
                "first_name" => $new_values["first_name"] !== "" ? $new_values["first_name"] : "Thomas",
                "last_name" => $new_values["last_name"] !== "" ? $new_values["last_name"] : "Anderson",
            ];

            try {
                user_updating($new_user_to_insert);
                $result = get_user_by_username($new_user_to_insert["username"]);
            } catch (PDOException $error) {
                $result .= "Erreur Fatale, la mise à jour de l'utilisateur a échoué (" . $error->getMessage() . "); veuillez réessayez";
            }

    return $result;
}

function format_date($date)
{
    $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
    $formatter->setPattern('dd MMMM yyyy');
    return $formatter->format(new DateTime($date));
}
