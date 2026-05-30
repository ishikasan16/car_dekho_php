<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

include '../common/config.php';

/* ================= ADD LATEST CAR ================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $car_name = mysqli_real_escape_string($conn, $_POST['car_name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $launch_year = mysqli_real_escape_string($conn, $_POST['launch_year']);

    $imageName = $_FILES['image']['name'];
    $imageTmp  = $_FILES['image']['tmp_name'];

    $uploadPath = "../assets/images/cars/" . $imageName;

    if (move_uploaded_file($imageTmp, $uploadPath)) {

        $sql = "INSERT INTO latest_cars (car_name, price, launch_year, image)
                VALUES ('$car_name', '$price', '$launch_year', '$imageName')";
        mysqli_query($conn, $sql);

        header("Location: manage-latest-cars.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Latest Cars</title>
    <style>
        body { font-family: Arial; background:#f5f6fa; padding:40px; }
        table { width:100%; background:#fff; border-collapse:collapse; margin-bottom:30px; }
        th, td { padding:12px; border:1px solid #ddd; }
        th { background:#ff3b3f; color:#fff; }
        img { border-radius:4px; }
        form { background:#fff; padding:25px; max-width:500px; border-radius:6px; }
        input, button { width:100%; padding:10px; margin-top:10px; }
        button { background:#ff3b3f; color:#fff; border:none; cursor:pointer; }
        a { text-decoration:none; }
    </style>
</head>
<body>

<h2>Manage Latest Cars</h2>
<a href="dashboard.php">⬅ Back to Dashboard</a>

<br><br>

<!-- ================= LATEST CARS LIST ================= -->
<table>
    <tr>
        <th>ID</th>
        <th>Car Name</th>
        <th>Price</th>
        <th>Launch Year</th>
        <th>Image</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM latest_cars ORDER BY id DESC");
while ($row = mysqli_fetch_assoc($result)) {
?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['car_name']) ?></td>
        <td><?= htmlspecialchars($row['price']) ?></td>
        <td><?= htmlspecialchars($row['launch_year']) ?></td>
        <td>
            <img src="../assets/images/cars/<?= $row['image'] ?>" width="100">
        </td>
        <td><?= $row['status'] ?></td>
        <td>
            <a href="toggle-latest-car.php?id=<?= $row['id'] ?>"
               style="color:green; margin-right:10px;">
               Toggle Status
            </a>

            <a href="delete-latest-car.php?id=<?= $row['id'] ?>&img=<?= $row['image'] ?>"
               onclick="return confirm('Delete this car?')"
               style="color:red;">
               Delete
            </a>
        </td>
    </tr>
<?php } ?>
</table>

<!-- ================= ADD FORM ================= -->
<form method="POST" enctype="multipart/form-data">
    <h3>Add Latest Car</h3>
    <input type="text" name="car_name" placeholder="Car Name" required>
    <input type="text" name="price" placeholder="Expected Price (₹12 - 18 Lakh)" required>
    <input type="text" name="launch_year" placeholder="Launch Year (2024)" required>
    <input type="file" name="image" required>
    <button type="submit">Add Latest Car</button>
</form>

</body>
</html>
