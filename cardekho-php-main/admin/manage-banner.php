<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

include '../common/config.php';

/* Handle form submit */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title    = mysqli_real_escape_string($conn, $_POST['title']);
    $subtitle = mysqli_real_escape_string($conn, $_POST['subtitle']);

    $imageName = $_FILES['image']['name'];
    $imageTmp  = $_FILES['image']['tmp_name'];

    $uploadPath = "../assets/images/banners/" . $imageName;

    if (move_uploaded_file($imageTmp, $uploadPath)) {

        // Optional: sab banners ko inactive kar do
        mysqli_query($conn, "UPDATE banners SET status='inactive'");

        $sql = "INSERT INTO banners (title, subtitle, image, status)
                VALUES ('$title', '$subtitle', '$imageName', 'active')";

        mysqli_query($conn, $sql);

        header("Location: ../index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Banners</title>
    <style>
        body {
            font-family: Arial;
            background: #f5f6fa;
            padding: 40px;
        }
        table {
            width: 100%;
            background: #fff;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        th {
            background: #ff3b3f;
            color: #fff;
        }
        img {
            border-radius: 4px;
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
            text-decoration: none;
        }
    </style>
</head>

<body>

<h2>Manage Banners</h2>
<a href="dashboard.php">⬅ Back to Dashboard</a>

<br><br>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Subtitle</th>
        <th>Image</th>
        <th>Action</th>
    </tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM banners ORDER BY id DESC");

while ($row = mysqli_fetch_assoc($result)) {
?>
    <tr>
        <td><?= $row['id'] ?></td>

        <td>
            <?= htmlspecialchars($row['title']) ?>

            <?php if ($row['status'] === 'active') { ?>
                <strong style="color:green;"> (ACTIVE)</strong>
            <?php } ?>
        </td>

        <td><?= htmlspecialchars($row['subtitle']) ?></td>

        <td>
            <img src="../assets/images/banners/<?= $row['image'] ?>" width="120">
        </td>

        <td>
            <a href="set-active-banner.php?id=<?= $row['id'] ?>"
               style="color:green; margin-right:10px;">
               Set Active
            </a>

            <a href="delete-banner.php?id=<?= $row['id'] ?>&img=<?= $row['image'] ?>"
               onclick="return confirm('Delete this banner?')"
               style="color:red;">
               Delete
            </a>
        </td>
    </tr>
<?php } ?>

</table>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Banner Title" required>
    <input type="text" name="subtitle" placeholder="Banner Subtitle" required>
    <input type="file" name="image" required>
    <button type="submit">Upload Banner</button>
</form>

</body>
</html>
