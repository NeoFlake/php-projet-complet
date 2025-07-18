<form action="../../src/controllers/user/user_controller.php" method="post">
    <div class="row ms-1">
        <span><?php echo isset($deleting_step) ? "Procédure de destruction de compte en cours" : "Voulez-vous vraiment détruire votre compte" ?></span>
        <div class="mt-3">
            <button class="btn btn-warning col-2" name="delete_first_step" value="validated" <?php echo isset($deleting_step) ? "disabled" : null ?>>Oui</button>
            <button class="btn btn-success col-2 ms-3" name="delete_first_step" value="aborted" <?php echo isset($deleting_step) ? "disabled" : null ?>>Non</button>
        </div>
    </div>
</form>
<?php if (isset($deleting_step) and $deleting_step > 1) { ?>
    <form action="../../src/controllers/user/user_controller.php" method="post">
        <div class="row ms-1">
            <span class="mt-3"><?php echo ($deleting_step > 2) ? "Identité confirmé" : "Confirmez votre identité pour continuer la procédure" ?></span>
            <div class="row mt-3">
                <div class="col-6">
                    <label for="username" class="form-label">Pseudonyme </label>
                    <input type="text" id="username" name="username" class="form-control" <?php echo $deleting_step > 2 ? "disabled" : null ?> />
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-6">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control" <?php echo $deleting_step > 2 ? "disabled" : null ?> />
                </div>
            </div>
            <div class="mt-3">
                <button class="btn btn-warning col-2 ms-3" name="delete_second_step" value="confirmed" <?php echo $deleting_step > 2 ? "disabled" : null ?>>Confirmer</button>
            </div>
        </div>
    </form>
<?php }
if ($deleting_step > 2) { ?>
    <form action="../../src/controllers/user/user_controller.php" method="post">
        <div class="row ms-1 mt-5">
            <span class="mt-3">Écrivez "CONFIRMER DESTRUCTION" pour terminer la procédure de destruction</span>
            <div class="row mt-3">
                <div class="col-6">
                    <input type="text" id="total_destruction" name="total_destruction" class="form-control" />
                </div>
            </div>
            <div class="mt-3">
                <button class="btn btn-danger col-4 ms-3" name="delete_last_step" value="confirmed">Détruire définitivement</button>
            </div>
        </div>
    </form>
<?php } ?>