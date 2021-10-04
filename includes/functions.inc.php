<?php

function emptyInputSignup($firstname, $lastname, $email, $pwd, $pwdrepeat)
{
    $result;
    if (empty($firstname) || empty($lastname) || empty($email) || empty($pwd) || empty($pwdrepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function invalidEmail($email)
{
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function pwdMatch($pwd, $pwdrepeat)
{
    $result;
    if ($pwd !== $pwdrepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function emailExists($conn, $email)
{
    $sql = "SELECT * FROM users WHERE user_email = ?;";
    // Initialize a new prepared statement
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}
function createUser($conn, $firstname, $lastname, $email, $pwd)
{
    $sql = "INSERT INTO users (firstname, lastname, user_email, user_password) VALUES (?, ?, ?, ?);";
    // Initialize a new prepared statement
    $stmt = mysqli_stmt_init($conn);
    // check if the statement will fail
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    loginUser($conn, $email, $pwd);
    header("location: ../index.php?error=none");
    exit();
}
function emptySearch($imei)
{
    $result;
    if (empty($imei)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function emptyInputLogin($email, $pwd)
{
    $result;
    if (empty($email) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function emptyInputAddphone($phone_name, $curr_owner, $prev_owner, $imei, $purchased_from, $date_purchased, $reported_stolen, $phone_image)
{
    $result;
    if (empty($phone_name) || empty($curr_owner) || empty($prev_owner) || empty($imei) || empty($purchased_from) || empty($date_purchased) || empty($reported_stolen) || empty($phone_image)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function emptyInputUpdatephone($phone_name, $curr_owner, $reported_stolen)
{
    $result;
    if (empty($phone_name) || empty($curr_owner)  || empty($reported_stolen)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function loginUser($conn, $email, $pwd)
{
    $emailExists = emailExists($conn, $email);

    if ($emailExists == false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $emailExists["user_password"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd) {
        session_start();
        $_SESSION["user_email"] = $emailExists["user_email"];
        $_SESSION["firstname"] = $emailExists["firstname"];
        $_SESSION["lastname"] = $emailExists["lastname"];
        $_SESSION["user_id"] = $emailExists["user_id"];
        $_SESSION["is_admin"] = $emailExists["is_admin"];
        header("location: ../index.php");
        exit();
    } else {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
}
function createPhone($conn, $user_id, $phone_name, $curr_owner, $prev_owner, $imei, $purchased_from, $date_purchased, $reported_stolen, $phone_image)
{
    $sql = "INSERT INTO phones (user_id, phone_name, curr_owner, prev_owner, imei, purchased_from, date_purchased, reported_stolen, phone_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
    // Initialize a new prepared statement
    $stmt = mysqli_stmt_init($conn);
    // check if the statement will fail
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../addphone.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssssss", $user_id, $phone_name, $curr_owner, $prev_owner, $imei, $purchased_from, $date_purchased, $reported_stolen, $phone_image);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../myphones.php?error=none");
    exit();
}
function updatePhone($conn, $id, $phone_name, $curr_owner, $imei, $purchased_from, $reported_stolen)
{

    $sql = "UPDATE phones SET phone_name = ?, curr_owner = ?, purchased_from = ?, reported_stolen = ? WHERE id = ? and imei = ?;";
    // Initialize a new prepared statement
    $stmt = mysqli_stmt_init($conn);
    // check if the statement will fail
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../updatephone.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssss", $phone_name, $curr_owner, $purchased_from, $reported_stolen, $id, $imei);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../myphones.php?error=none");
    exit();
}
function updateUserAccess($conn, $user_id, $is_admin)
{
    $sql = "UPDATE users SET is_admin = ? WHERE user_id = ?;";
    // Initialize a new prepared statement
    $stmt = mysqli_stmt_init($conn);
    // check if the statement will fail
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../users.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $is_admin, $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../users.php?error=none");
    exit();
}
function deletePhone($conn, $id, $imei, $phone_image)
{
    $sql = "DELETE FROM phones WHERE id = ? and imei = ?;";
    // Initialize a new prepared statement
    $stmt = mysqli_stmt_init($conn);
    // check if the statement will fail
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../myphones.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $id, $imei);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    // delete image in phone_uploads folder
    $path = $phone_image;
    if (!unlink($path)) {
        header("location: ../myphones.php?error=errordeletingimage");
        exit();
    } else {
        header("location: ../myphones.php?error=none");
        exit();
    }
}
function deleteUser($conn, $user_id)
{

    $sqlUser = "DELETE FROM users WHERE user_id = ?;";
    // Initialize a new prepared statement
    $stmt = mysqli_stmt_init($conn);
    // check if the statement will fail
    if (!mysqli_stmt_prepare($stmt, $sqlUser)) {
        header("location: ../users.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../users.php?error=none");
    exit();
}
