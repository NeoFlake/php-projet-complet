<?php if (isset($date_of_last_modify)) { ?>
    <div class="row">
        <span>Dernière modification : <?php echo format_date($date_of_last_modify) ?></span>
    </div>
<?php } ?>
<form action="../../src/controllers/user/user_controller.php" method="post" class="mt-3">
    <div class="row">
        <div class="col-6">
            <label for="username" class="form-label">Pseudonyme </label>
            <input type="text" id="username" name="new_username" class="form-control" value="<?php echo $username_logged ?>" />
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-6">
            <label for="password" class="form-label">Ancien Mot de passe (obligatoire pour modification)</label>
            <input type="password" id="password" name="old_password" class="form-control" />
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-6">
            <label for="password" class="form-label">Nouveau Mot de passe</label>
            <input type="password" id="password" name="new_password" class="form-control" />
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-6">
            <label for="password" class="form-label">Confirmer Mot de passe</label>
            <input type="password" id="password" name="confirm_password" class="form-control" />
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-6">
            <label for="first_name" class="form-label">Prénom </label>
            <input type="text" id="first_name" name="new_first_name" class="form-control" value="<?php echo $first_name ?>" />
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-6">
            <label for="last_name" class="form-label">Nom de Famille </label>
            <input type="text" id="last_name" name="new_last_name" class="form-control" value="<?php echo $last_name ?>" />
        </div>
    </div>
    <div class="row mt-5 ms-1">
        <button class="btn btn-primary col-3" name="modify_user_button" value="validated">Modifier</button>
    </div>
</form>
<?php
if (isset($fail_update)) { ?>
    <div class="mt-3">
        <span> <?php echo $fail_update ?></span>
    </div>
<?php }
