<?php
include 'config.php';

/* Fetch latest header settings */
$headerQuery = "SELECT * FROM header_settings ORDER BY id DESC LIMIT 1";
$headerResult = mysqli_query($conn, $headerQuery);
$header = mysqli_fetch_assoc($headerResult);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CarDekho Clone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<header class="main-header">
    <div class="container header-flex">

        <!-- LOGO -->
        <div class="logo">
            <a href="index.php">
                <?= htmlspecialchars($header['logo_text'] ?? 'CarDekho') ?>
            </a>
        </div>

        <!-- SEARCH -->
        <div class="search-box">
            <input 
                type="text" 
                placeholder="<?= htmlspecialchars($header['search_placeholder'] ?? 'Search cars') ?>">
        </div>

        <!-- MENU -->
        <nav class="nav-menu">
            <ul>
                <li>
                    <a href="index.php">
                        <?= htmlspecialchars($header['menu_new_cars'] ?? 'New Cars') ?>
                    </a>
                </li>

                <li>
                    <a href="index.php">
                        <?= htmlspecialchars($header['menu_used_cars'] ?? 'Used Cars') ?>
                    </a>
                </li>

                <li>
                    <a href="car-form.php">
                        <?= htmlspecialchars($header['menu_enquiry'] ?? 'Car Enquiry') ?>
                    </a>
                </li>

                <li>
                    <a href="admin/login.php" class="login-btn">
                        <?= htmlspecialchars($header['admin_text'] ?? 'Admin') ?>
                    </a>
                </li>
            </ul>
        </nav>

    </div>
</header>
