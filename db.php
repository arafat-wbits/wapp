<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "weather";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function farentocel($celsius){
	return $farenhit = number_format($celsius * 1.8 + 32,2);
}

?>