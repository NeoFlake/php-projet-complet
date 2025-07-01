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
        $select = "INSERT INTO users (username, password, first_name, last_name, date_of_creation, date_of_last_modify) VALUES
        (
        :username,
        :password,
        :first_name,
        :last_name,
        CURDATE(),
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

function user_updating($new_user_to_insert)
{
    $pdo = get_connection();
    try {
        $update = "UPDATE users
        SET username = :username,
        password = :password,
        first_name = :first_name,
        last_name = :last_name,
        date_of_last_modify = CURDATE()
        WHERE id= :id";

        $query = $pdo->prepare($update);
        $query->bindValue(":username", $new_user_to_insert["username"]);
        $query->bindValue(":password", $new_user_to_insert["password"]);
        $query->bindValue(":first_name", $new_user_to_insert["first_name"]);
        $query->bindValue(":last_name", $new_user_to_insert["last_name"]);
        $query->bindValue(":id", $new_user_to_insert["id"]);

        $query->execute();
    } catch (PDOException $error) {
        throw new PDOException($error->getMessage());
    }
}

function delete_user_by_id($id) {
    $pdo = get_connection();
    try {
        $delete = "DELETE FROM users
        WHERE id = :id";

        $query = $pdo->prepare($delete);
        $query->bindValue(":id", $id);

        $query->execute();
    } catch (PDOException $error) {
        throw new PDOException($error->getMessage());
    }
}
