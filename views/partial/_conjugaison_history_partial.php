<div class="mb-3">
    <span>Historique de vos conjugaisons :</span>
</div>
<?php if (isset($conjugaison_historic_null)) { ?>
    <div><?php echo $conjugaison_historic_null ?></div>
<?php } else if (isset($historique_conjugaison)) { ?>
    <ul>
        <?php foreach ($historique_conjugaison as $conjugaison) { ?>
            <li class="mt-5"><?php
                                $result = "Le " . (new DateTime($conjugaison["date_of_creation"]))->format('d/m/Y \à H\h i\m\i\n s\s\e\c')
                                    . " vous avez conjugué le verbe \"" . $conjugaison["verb"] . ($conjugaison["temps"] === "imparfait" ? " à l'" : "\" au ") . $conjugaison["temps"] . " ce qui donne : ";
                                echo $result; ?>
                <ul class="list-unstyled">
                    <?php
                    foreach ($conjugaison["conjugaisons"] as $ligne_de_conjugaison) { ?>
                        <li>
                            <?php echo $ligne_de_conjugaison ?>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>
    </ul>
<?php } ?>