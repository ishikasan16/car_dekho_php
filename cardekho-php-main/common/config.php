<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "cardekho_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed");
}
?>
