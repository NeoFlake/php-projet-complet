<?php

include "../../repositories/users.php";

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

function format_date($date)
{
    $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
    $formatter->setPattern('dd MMMM yyyy');
    return $formatter->format(new DateTime($date));
}
