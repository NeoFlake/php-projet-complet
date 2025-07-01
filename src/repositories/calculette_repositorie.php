<?php

include __DIR__ . '/../config/connection.php';

function save_new_calcul($operation)
{
    $pdo = get_connection();
    try {
        $insert = "INSERT INTO calculette_usage (id_user, first_number, second_number, operator, result, date_of_creation) VALUES
        (
        :id_user,
        :first_number,
        :second_number,
        :operator,
        :result,
        NOW()
        )";

        $query = $pdo->prepare($insert);
        $query->bindValue(":id_user", $operation["id_user"]);
        $query->bindValue(":first_number", $operation["first_number"]);
        $query->bindValue(":second_number", $operation["second_number"]);
        $query->bindValue(":operator", $operation["operator"]);
        $query->bindValue(":result", $operation["result"]);
        $query->execute();
        
    } catch (PDOException $error) {
        throw new PDOException($error->getMessage());
    }
}