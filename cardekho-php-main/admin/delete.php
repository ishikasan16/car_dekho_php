<?php
session_start();
require_once("../common/config.php");

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($conn, "DELETE FROM car_enquiry WHERE id=$id");
}

header("Location: dashboard.php");
exit;
