<?php

if (isset($_POST["submit"])) { //check if user accessed the form the proper way
    
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];

    require_once 'dbh.inc.php'; // Database handler
    require_once 'functions.inc.php';

    if (emptyInputSignup($firstname, $lastname, $email, $pwd, $pwdrepeat) !== false) {
        header("location: ../register.php?error=emptyinput");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../register.php?error=invalidemail");
        exit();
    }
    if (pwdMatch($pwd, $pwdrepeat) !== false) {
        header("location: ../register.php?error=pwddontmatch");
        exit();
    }
    if (emailExists($conn, $email) !== false) {
        header("location: ../register.php?error=emailexists");
        exit();
    }

    createUser($conn, $firstname, $lastname, $email, $pwd);
} 
else {
    header("location: ../register.php");
    exit();
}