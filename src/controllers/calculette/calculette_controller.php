<?php

if(str_contains($_SERVER['HTTP_REFERER'], "calculette.php") and $_SERVER['REQUEST_METHOD'] == 'POST'){
    $first_number = $_POST["first_number"];
    $second_number = $_POST["second_number"];
    $operator = $_POST["operator"];
}