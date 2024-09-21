<?php
// Start session
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection details
$host = 'localhost';
$dbname = 'cleanpro';
$dbuser = 'root';
$dbpass = '';
$port = 3307;

// Create connection
$conn = new mysqli($host, $dbuser, $dbpass, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$serviceName = $_POST['service_name'];
$serviceDescription = $_POST['service_description'];
$servicePrice = $_POST['service_price'];

// Prepare and execute SQL statement
$sql = $conn->prepare("INSERT INTO services (service_name, service_description, service_price) VALUES (?, ?, ?)");
$sql->bind_param("ssd", $serviceName, $serviceDescription, $servicePrice);

if ($sql->execute()) {
    // Redirect to a success page or show a success message
    header("message=Service added successfully");
    exit();
} else {
    // Handle errors
    echo "Error: " . $sql->error;
}

// Close connection
$sql->close();
$conn->close();
?>
