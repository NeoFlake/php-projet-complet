<div class="mb-3">
    <span>Historique de vos calculs :</span>
</div>
<?php if (isset($calcul_historic_null)) { ?>
    <div><?php echo $calcul_historic_null ?></div>
<?php } else if (isset($historique_calculette)) { ?>
    <ul>
        <?php foreach ($historique_calculette as $calcul) { ?>
            <li class="mt-3"><?php
                                $result = "Le " . (new DateTime($calcul["date_of_creation"]))->format('d/m/Y \à H\h i\m\i\n s\s\e\c')
                                    . " vous avez fait le calcul " . $calcul["first_number"] . " ";
                                switch ($calcul["operator"]) {
                                    case "add":
                                        $result .= "+";
                                        break;
                                    case "subtract":
                                        $result .= "-";
                                        break;
                                    case "multiply":
                                        $result .= "x";
                                        break;
                                    case "divide":
                                        $result .= "/";
                                        break;
                                }
                                $result .= " " . $calcul["second_number"] . " = " . $calcul["result"];
                                echo $result ?></li>
        <?php } ?>
    </ul>
<?php } ?>