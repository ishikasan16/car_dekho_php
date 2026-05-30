<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include '../common/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Enquiries</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            padding: 30px;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            background: #fff;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 12px;
            border: 1px solid #ddd;
            font-size: 14px;
            text-align: left;
        }

        table th {
            background-color: #ff3b3f;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .admin-actions {
    display: flex;
    gap: 15px;              /* 👈 MAIN FIX (distance) */
    margin-bottom: 25px;
    flex-wrap: wrap;        /* small screen pe wrap ho jaaye */
}

.admin-btn {
    background: #000;
    color: #fff;
    padding: 10px 18px;
    text-decoration: none;
    border-radius: 5px;
    font-size: 14px;
    transition: 0.2s;
}

.admin-btn:hover {
    background: #333;
}

.admin-btn.logout {
    background: #ff3b3f;
}

.admin-btn.logout:hover {
    background: #e63235;
}

    </style>
</head>

<body>

    <!-- <h2>Car Enquiries</h2> -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2>Car Enquiries</h2>

        <div>

           <div class="admin-actions">
    <a href="manage-header.php" class="admin-btn">Manage Header</a>
    <a href="manage-banner.php" class="admin-btn">Manage Banner</a>
    <a href="manage-most-searched.php" class="admin-btn">Manage Most Searched Cars</a>
    <a href="manage-latest-cars.php" class="admin-btn">Manage Latest Cars</a>
    <a href="logout.php" class="admin-btn logout">Logout</a>
</div>

        </div>
    </div>



    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Car Type</th>
            <th>Date</th>
            <th>Action</th>
            <th>Status</th>
        </tr>

        <?php
        $sql = "SELECT * FROM car_enquiry ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);


        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td><?= $row['car_type'] ?></td>
                    <td><?= $row['created_at'] ?></td>

                    <td>
                        <form action="update.php" method="POST">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">

                            <select name="status">
                                <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="Approved" <?= $row['status'] == 'Approved' ? 'selected' : '' ?>>Approved</option>
                                <option value="Rejected" <?= $row['status'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                            </select>

                            <button type="submit">Update</button>
                        </form>
                    </td>

                    <td>
                        <a href="delete.php?id=<?= $row['id'] ?>"
                            onclick="return confirm('Are you sure you want to delete this enquiry?')" style="color:red;">
                            Delete
                        </a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='9'>No enquiries found</td></tr>";
        }
        ?>


    </table>

</body>

</html>