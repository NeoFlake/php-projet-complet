<?php

include __DIR__ . '/../config/connection.php';

function save_new_conjugaison($conjugaison_to_save)
{
    $pdo = get_connection();
    try {
        $insert = "INSERT INTO conjugaison_usage (id_user, verb, temps, date_of_creation) VALUES
        (
        :id_user,
        :verb,
        :temps,
        NOW()
        )";

        $query = $pdo->prepare($insert);
        $query->bindValue(":id_user", $conjugaison_to_save["id_user"]);
        $query->bindValue(":verb", $conjugaison_to_save["verb"]);
        $query->bindValue(":temps", $conjugaison_to_save["temps"]);
        $query->execute();

        return $pdo->lastInsertId();
    } catch (PDOException $error) {
        throw new PDOException($error->getMessage());
    }
}

function save_new_row_of_conjugaison($id_transaction, $index, $ligne_de_conjugaison){
    $pdo = get_connection();
    try {
        $insert = "INSERT INTO resultat_conjugaison (id_conjugaison, place_in_table, conjugaison) VALUES
        (
        :id_conjugaison,
        :place_in_table,
        :conjugaison
        )";

        $query = $pdo->prepare($insert);
        $query->bindValue(":id_conjugaison", $id_transaction);
        $query->bindValue(":place_in_table", intval($index) + 1);
        $query->bindValue(":conjugaison", $ligne_de_conjugaison);
        $query->execute();

    } catch (PDOException $error) {
        throw new PDOException($error->getMessage());
    }
}

function get_by_id($id)
{
    $pdo = get_connection();
    try {
        $select = "SELECT * FROM conjugaison_usage AS us
        JOIN resultat_conjugaison AS res ON res.id_conjugaison = us.id 
        WHERE id_user= :id_user 
        ORDER BY us.date_of_creation DESC";

        $query = $pdo->prepare($select);
        $query->bindValue(":id_user", $id);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        } else {
            throw new Exception("Aucun utilisateur avec ce pseudonyme n'existe");
        }

    } catch (PDOException $error) {
        throw new PDOException($error->getMessage());
    }
}
