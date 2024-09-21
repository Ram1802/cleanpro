
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to login page with a message
    header("Location: login.php?message=Please log in to book a service.");
    exit();
}

// Ensure user_id is set in the session
if (!isset($_SESSION['username'])) {
    die("User ID is missing. Please log in again.");
}

// Database connection
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "cleanpro";
$port = 3307;

// Create a new connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data from the form
$serviceType = $_POST['service-type'];
$serviceDate = $_POST['service-date'];
$serviceTime = $_POST['service-time'];
$customerName = $_POST['customer-name'];
$customerContact = $_POST['customer-contact'];
$serviceLocation = $_POST['service-location'];

// Validate and sanitize input data
$serviceType = $conn->real_escape_string($serviceType);
$serviceDate = $conn->real_escape_string($serviceDate);
$serviceTime = $conn->real_escape_string($serviceTime);
$customerName = $conn->real_escape_string($customerName);
$customerContact = $conn->real_escape_string($customerContact);
$serviceLocation = $conn->real_escape_string($serviceLocation);

// Prepare SQL statement to insert booking
$sql = "INSERT INTO bookings (user_id, service_type, service_date, service_time, customer_name, customer_contact, service_location) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Bind parameters (assuming `user_id` is available in session)
$userId = $_SESSION['username'];
$stmt->bind_param("issssss", $userId, $serviceType, $serviceDate, $serviceTime, $customerName, $customerContact, $serviceLocation);

// Execute the statement
if ($stmt->execute()) {
    // Redirect to a payment page or confirmation page
    header("Location: paymentmethod.html");
    exit();
} else {
    die("Booking failed: " . $stmt->error);
}

$stmt->close();
$conn->close();
