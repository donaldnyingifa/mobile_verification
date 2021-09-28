<?php

if (isset($_POST["update"])) { //check if user accessed the form the proper way

    $id = $_POST["id"];
    $phone_name = $_POST["phone_name"];
    $imei = $_POST["imei"];
    $purchased_from = $_POST["purchased_from"];
    $reported_stolen = $_POST["reported_stolen"];
    $curr_owner = $_POST["curr_owner"];

    require_once 'dbh.inc.php'; // Database handler
    require_once 'functions.inc.php';

    if (emptyInputUpdatephone($phone_name, $curr_owner, $reported_stolen) !== false) {
        header("location: ../addphone.php?error=emptyinput");
        exit();
    }

    updatePhone($conn, $id, $phone_name, $curr_owner, $imei, $purchased_from, $reported_stolen);
} else {
    header("location: ../myphones.php");
    exit();
}
