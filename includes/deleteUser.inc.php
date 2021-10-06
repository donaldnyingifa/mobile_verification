<?php

if (isset($_POST["delete"])) { //check if user accessed the form the proper way

    $user_id = $_GET["user_id"];

    require_once 'dbh.inc.php'; // Database handler
    require_once 'functions.inc.php';


    deleteUser($conn, $user_id);
} else {
    header("location: ../users.php");
    exit();
}
