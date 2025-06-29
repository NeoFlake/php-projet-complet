<?php

include __DIR__ . '/../config/connection.php';

function get_user_by_username($username)
{
    $pdo = get_connection();

    try {
        $select = "SELECT * FROM users WHERE username= :username";

        $query = $pdo->prepare($select);
        $query->bindValue(":username", $username);
        $query->execute();

        $result = $query->fetch();

        if ($result) {
            return $result;
        } else {
            throw new Exception("Aucun utilisateur avec ce pseudonyme n'existe");
        }
    } catch (PDOException $error) {
        throw new PDOException($error->getMessage());
    }
}

function save_user($username, $password, $first_name, $last_name)
{
    $pdo = get_connection();
    try {
        $select = "INSERT INTO * users (username, password, first_name, last_name, date_of_creation) VALUES
        (
        :username,
        :password,
        :first_name,
        :last_name,
        CURDATE()
        )";

        $query = $pdo->prepare($select);
        $query->bindValue(":username", $username);
        $query->bindValue(":password", $password);
        $query->bindValue(":first_name", $first_name);
        $query->bindValue(":last_name", $last_name);
        
        $query->execute();
    } catch (PDOException $error) {
        throw new PDOException($error->getMessage());
    }
}
