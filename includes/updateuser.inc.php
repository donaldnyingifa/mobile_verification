<?php

if (isset($_POST["update"])) { //check if user accessed the form the proper way
    
    $user_id = $_GET["user_id"];
    $is_admin = $_GET["is_admin"]; 
    
    require_once 'dbh.inc.php'; // Database handler
    require_once 'functions.inc.php';

    updateUserAccess($conn, $user_id, $is_admin);
} 
else {
    header("location: ../users.php");
    exit();
}