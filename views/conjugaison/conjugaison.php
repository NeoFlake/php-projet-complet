<?php

session_start();

$temps = $_SESSION["temps"] ?? "present";
$verb = $_SESSION["verb"] ?? "";
$table_de_conjugaison = $_SESSION["table_de_conjugaison"] ?? null;

// Après affectation on unset les paramètres pour éviter les problèmes de redondances des valeurs
unset($_SESSION["temps"], $_SESSION["verb"], $_SESSION["table_de_conjugaison"]);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conjugaison</title>
    <?php include "../partial/_bootstrap_header.php" ?>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center mt-5">
            <h1>Conjugaison du premier groupe</h1>
        </div>
        <div class="mt-5">
            <form action="../../src/controllers/conjugaison/conjugaison_controller.php" method="post">
                <div class="d-flex justify-content-center">
                    <div class="row ">
                        <div class="col-5">
                            <input type="text" name="verb" class="form-control" placeholder="Entrez un verbe..." value="<?php echo $verb ?>" />
                        </div>
                        <div class="col-4">
                            <select name="temps" class="form-select text-center">
                                <option value="present" <?php echo $temps == "present" ? "selected" : "" ?>>au présent</option>
                                <option value="futur" <?php echo $temps == "futur" ? "selected" : "" ?>>au futur</option>
                                <option value="imparfait" <?php echo $temps == "imparfait" ? "selected" : "" ?>>à l'imparfait</option>
                            </select>
                        </div>
                        <button class="col-3 btn btn-success">Conjuguer</button>
                    </div>
                </div>
            </form>
        </div>
        <?php
        if (isset($table_de_conjugaison)) {
            echo "<div class=\"row d-flex justify-content-center mt-5\">";
            if (is_string($table_de_conjugaison)) {
                echo $table_de_conjugaison;
            } else {
                echo "<span class=\"col-4\">";
                echo "Le verbe \"" . $verb . "\" conjugué " . ($temps == "imparfait" ? "à l'" : "au ") . $temps . " donne : ";
                echo "</span>";
                echo "<div class=\"d-flex justify-content-center mt-3\">";
                echo "<ol>";
                foreach($table_de_conjugaison as $ligne_de_conjugaison){
                    echo "<li>" . $ligne_de_conjugaison . "</li>";
                }
                echo "</ol>";
                echo "</div>";
            }
            echo "</div>";
        }
        ?>
    </div>
    <?php include "../partial/_bootstrap_body.php" ?>
</body>

</html>