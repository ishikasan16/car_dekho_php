<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

include '../common/config.php';

$id = intval($_GET['id']);
$image = $_GET['img'];

/* Delete image from folder */
$imagePath = "../assets/images/banners/" . $image;
if (file_exists($imagePath)) {
    unlink($imagePath);
}

/* Delete from DB */
mysqli_query($conn, "DELETE FROM banners WHERE id=$id");

header("Location: manage-banner.php");
exit;
