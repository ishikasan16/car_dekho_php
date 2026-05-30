<?php

session_start();



include '../common/config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username='$username' LIMIT 1";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) === 1) {
        $row = mysqli_fetch_assoc($res);
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $row['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid credentials";
        }
    } else {
        $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body{font-family:Arial;background:#f5f6fa;}
        .box{width:360px;margin:100px auto;background:#fff;padding:25px;border-radius:8px}
        h2{text-align:center;margin-bottom:20px}
        input{width:100%;padding:10px;margin-bottom:15px}
        button{width:100%;padding:10px;background:#ff3b3f;color:#fff;border:2px solid black}
        .err{color:red;text-align:center}
    </style>
</head>
<body>
<div class="box">
    <h2>Admin Login</h2>
    <?php if($error) echo "<p class='err'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>
