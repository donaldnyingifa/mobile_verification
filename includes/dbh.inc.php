<?php

$servername = "localhost";
$username = "id17724478_root";
$password = "3ruo}x$SkIo8B#eQ";
$dbname = "id17724478_mobile";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  echo $conn;
  die("Connection failed: " . mysqli_connect_error());
}

//mysqli_close($conn);