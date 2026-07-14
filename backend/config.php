<?php 


$server = "127.0.0.1";
$username = "root";
$database = "facebook";
$password = "";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>