<?php

session_start();

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
                            <input type="number" name="first_number" class="form-control" />
                        </div>
                        <div class="col-2">
                            <select name="operator" class="form-select text-center">
                                <option value="add">+</option>
                                <option value="subtract">-</option>
                                <option value="multiply">x</option>
                                <option value="divide">/</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <input type="number" name="second_number" class="form-control" />
                        </div>
                        <button class="col-2 btn btn-info">Calculer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include "../partial.php/bootstrap_body.php" ?>
</body>

</html>