<?php

if (isset($_POST["delete"])) { //check if user accessed the form the proper way
    
    $id = $_GET["id"];
    $imei = $_GET["imei"];
    $phone_image = $_GET["phone_image"];

    require_once 'dbh.inc.php'; // Database handler
    require_once 'functions.inc.php';


    deletePhone($conn, $id, $imei, $phone_image);
} 
else {
    header("location: ../myphones.php");
    exit();
}