<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oyinmobile";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  echo $conn;
  die("Connection failed: " . mysqli_connect_error());
}

//mysqli_close($conn);