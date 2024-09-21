<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $subscription_type = $_POST['subscription_type'];
    $price = $_POST['price'];

    $query = "INSERT INTO subscriptions (user_id, subscription_type, price) VALUES ('$user_id', '$subscription_type', '$price')";
    
    if (mysqli_query($conn, $query)) {
        echo "Subscription added successfully!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
