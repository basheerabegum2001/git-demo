<?php
$host = "localhost";
$user = "root";
$pass = ""; // or your password if any
$dbname = "inventory_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
