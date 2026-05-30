<?php
include 'common/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = $_POST['name'];
    $phone   = $_POST['phone'];
    $email   = $_POST['email'];
    $address = $_POST['address'];

    
    if (isset($_POST['car_type'])) {
        $car_type = implode(", ", $_POST['car_type']);
    } else {
        $car_type = "";
    }

    $sql = "INSERT INTO car_enquiry (name, phone, email, address, car_type)
            VALUES ('$name', '$phone', '$email', '$address', '$car_type')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Enquiry submitted successfully!');
                window.location.href='car-form.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
