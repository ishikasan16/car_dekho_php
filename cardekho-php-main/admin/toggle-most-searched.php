<?php
session_start();
include '../common/config.php';

$id = intval($_GET['id']);

$result = mysqli_query($conn, "SELECT status FROM most_searched_cars WHERE id=$id");
$row = mysqli_fetch_assoc($result);

$newStatus = ($row['status'] === 'active') ? 'inactive' : 'active';

mysqli_query($conn, "UPDATE most_searched_cars SET status='$newStatus' WHERE id=$id");

header("Location: manage-most-searched.php");
exit;
