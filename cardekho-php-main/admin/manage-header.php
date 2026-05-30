<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

include '../common/config.php';

/* Handle form submit */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $logo_text = mysqli_real_escape_string($conn, $_POST['logo_text']);
    $search_placeholder = mysqli_real_escape_string($conn, $_POST['search_placeholder']);
    $menu_new = mysqli_real_escape_string($conn, $_POST['menu_new']);
    $menu_used = mysqli_real_escape_string($conn, $_POST['menu_used']);
    $menu_enquiry = mysqli_real_escape_string($conn, $_POST['menu_enquiry']);

    $sql = "INSERT INTO header_settings 
            (
                logo_text,
                search_placeholder,
                menu_new_cars,
                menu_used_cars,
                menu_enquiry
            )
            VALUES
            (
                '$logo_text',
                '$search_placeholder',
                '$menu_new',
                '$menu_used',
                '$menu_enquiry'
            )";

    mysqli_query($conn, $sql);

    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Header</title>
    <style>
        body {
            font-family: Arial;
            background: #f5f6fa;
            padding: 40px;
        }
        form {
            background: #fff;
            padding: 25px;
            max-width: 500px;
            border-radius: 6px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }
        button {
            background: #ff3b3f;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        a {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<h2>Manage Header</h2>
<a href="dashboard.php">⬅ Back to Dashboard</a>

<form method="POST">
    <input type="text" name="logo_text" placeholder="Logo Text (e.g. CarDekho)" required>
    <input type="text" name="search_placeholder" placeholder="Search Placeholder" required>
    <input type="text" name="menu_new" placeholder="Menu: New Cars" required>
    <input type="text" name="menu_used" placeholder="Menu: Used Cars" required>
    <input type="text" name="menu_enquiry" placeholder="Menu: Car Enquiry" required>

    <button type="submit">Save Header</button>
</form>

</body>
</html>
