<?php

session_start();

unset($_SESSION["username_logged"]);

header("location: ../../../views/user/user_login.php");