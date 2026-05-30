<?php
session_start();
include '../common/config.php';

$id = intval($_GET['id']);
$image = $_GET['img'];

$imagePath = "../assets/images/cars/" . $image;
if (file_exists($imagePath)) {
    unlink($imagePath);
}

mysqli_query($conn, "DELETE FROM latest_cars WHERE id=$id");

header("Location: manage-latest-cars.php");
exit;
