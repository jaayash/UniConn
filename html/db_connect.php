<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "uniconn";

$conn = new mysqli($server, $username, $password, $database, 3307);

if (!$conn) {
    die("Error: " . mysqli_connect_error());
}

$email = "";
$name = "";
$errors = array();
