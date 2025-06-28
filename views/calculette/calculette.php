<?php

session_start();

$first_number = $_SESSION["first_number"] ?? 0;
$second_number = $_SESSION["second_number"] ?? 0;
$operator = $_SESSION["operator"] ?? "add";
$result = $_SESSION["result"] ?? null;
$signus = $_SESSION["signus"] ?? "+";

// Après affectation on unset les paramètres pour éviter les problèmes de redondances des valeurs
unset($_SESSION['first_number'], $_SESSION['second_number'], $_SESSION['operator'], $_SESSION['result']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculette</title>
    <?php include "../partial.php/bootstrap_header.php" ?>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center mt-5">
            <h1>Ma première calculette</h1>
        </div>
        <div class="mt-5">
            <form action="../../src/controllers/calculette/calculette_controller.php" method="post">
                <div class="d-flex justify-content-center">
                    <div class="row ">
                        <div class="col-2 offset-2">
                            <input type="number" name="first_number" class="form-control" value=<?php echo $first_number ?> />
                        </div>
                        <div class="col-2">
                            <select name="operator" class="form-select text-center">
                                <option value="add" <?php echo $operator == "add" ? "selected" : "" ?>>+</option>
                                <option value="subtract" <?php echo $operator == "subtract" ? "selected" : "" ?>>-</option>
                                <option value="multiply" <?php echo $operator == "multiply" ? "selected" : "" ?>>x</option>
                                <option value="divide" <?php echo $operator == "divide" ? "selected" : "" ?>>/</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <input type="number" name="second_number" class="form-control" value=<?php echo $second_number ?> />
                        </div>
                        <button class="col-2 btn btn-info">Calculer</button>
                    </div>
                </div>
            </form>
            <?php
            if(isset($result)){
                echo "<div class=\"d-flex justify-content-center mt-5\">";
                if(is_string($result)){
                    echo $result;
                } else {
                    echo $first_number . " " . $signus . " " . $second_number . " = " . $result;
                }
                echo "</div>";
            }
            ?>
        </div>
    </div>
    <?php include "../partial.php/bootstrap_body.php" ?>
</body>

</html>