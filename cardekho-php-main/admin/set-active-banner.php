<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

include '../common/config.php';

$id = intval($_GET['id']);

/* Step 1: sab banners inactive */
mysqli_query($conn, "UPDATE banners SET status='inactive'");

/* Step 2: selected banner active */
mysqli_query($conn, "UPDATE banners SET status='active' WHERE id=$id");

/* Back to manage banner page */
header("Location: manage-banner.php");
exit;
?>
