<?php

if (isset($_POST["submit"])) { //check if user accessed the form the proper way
    if ($_POST["user_id"]) {
        $user_id = $_POST["user_id"];
        $phone_name = $_POST["phone_name"];
        $curr_owner = $_POST["curr_owner"];
        $prev_owner = $_POST["prev_owner"];
        $imei = $_POST["imei"];
        $purchased_from = $_POST["purchased_from"];
        $date_purchased = $_POST["date_purchased"];
        $reported_stolen = $_POST["reported_stolen"];


        $phone_image = $_FILES["phone_image"];

        $image_name = $_FILES["phone_image"]["name"];
        $image_tmp_name = $_FILES["phone_image"]["tmp_name"];
        $image_size = $_FILES["phone_image"]["size"];
        $image_error = $_FILES["phone_image"]["error"];
        $image_type = $_FILES["phone_image"]["type"];

        $image_ext = explode('.', $image_name);
        $image_actual_ext = strtolower(end($image_ext));

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($image_actual_ext, $allowed)) {
            if ($image_error === 0) {
                if ($image_size < 2000000) {
                    $new_image_name = $user_id . "." . $imei . "." . $image_actual_ext;
                    $image_destination = '../phone_uploads/' . $new_image_name;

                    move_uploaded_file($image_tmp_name, $image_destination);

                    require_once 'dbh.inc.php'; // Database handler
                    require_once 'functions.inc.php';

                    if (emptyInputAddphone($phone_name, $curr_owner, $prev_owner, $imei, $purchased_from, $date_purchased, $reported_stolen, $image_destination) !== false) {
                        header("location: ../addphone.php?error=emptyinput");
                        exit();
                    }

                    createPhone($conn, $user_id, $phone_name, $curr_owner, $prev_owner, $imei, $purchased_from, $date_purchased, $reported_stolen, $image_destination);
                } else {
                    header("location: ../addphone.php?error=toobig");
                    exit();
                }
            } else {
                header("location: ../addphone.php?error=errorupload");
                exit();
            }
        } else {
            header("location: ../addphone.php?error=wrongtype");
            exit();
        }
    } else {
        header("location: ../addphone.php?error=nouser");
        exit();
    }
} else {
    header("location: ../addphone.php");
    exit();
}
