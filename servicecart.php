<?php
session_start();

// Check if the cart session is already set; if not, initialize it
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $serviceName = $_POST['service_name'];
    $servicePrice = $_POST['service_price'];
    $serviceDate = $_POST['service_date']; // Example: 2024-09-30
    $serviceTime = $_POST['service_time']; // Example: 14:00

    // Add the service to the cart
    $_SESSION['cart'][] = [
        'name' => $serviceName,
        'price' => $servicePrice,
        'date' => $serviceDate,
        'time' => $serviceTime
    ];

    // Redirect back to the services page or to the cart page
    header('Location: cart.php'); // Redirect to the cart page
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Service</title>
</head>
<body>
    <h1>Book a Service</h1>
    <form action="service.php" method="post">
        <label for="service_name">Service Name:</label>
        <input type="text" id="service_name" name="service_name" required><br>
        <label for="service_price">Price:</label>
        <input type="text" id="service_price" name="service_price" required><br>
        <label for="service_date">Date:</label>
        <input type="date" id="service_date" name="service_date" required><br>
        <label for="service_time">Time:</label>
        <input type="time" id="service_time" name="service_time" required><br>
        <input type="submit" value="Add to Cart">
    </form>
    <a href="cart.php">View Cart</a>
</body>
</html>
