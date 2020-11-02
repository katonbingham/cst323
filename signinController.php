<?php
//session_start();
include_once "Database.php";
include_once "SecurityService.php";

if (isset($_POST['inputEmail'],$_POST['inputPassword'])){
    $attemptedEmail = $_POST['inputEmail'];
    $attemptedPassword = $_POST['inputPassword'];

    $service = new SecurityService($attemptedEmail, $attemptedPassword);

    $loggedIn = $service->authenticate();

    if ($loggedIn) {
        $_SESSION['principal'] = true;
        include "loginSuccess.php";
    } else {
        $_SESSION['principal'] = false;
        include "loginFailed.php";

    }

}

