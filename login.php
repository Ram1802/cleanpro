<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$host = 'localhost'; // or your server name
$dbname = 'cleanpro';
$dbuser = 'root'; // or your MySQL username
$dbpass = ''; // or your MySQL password
$port = 3307; // Default MySQL port is 3306

// Create connection
$conn = new mysqli($host, $dbuser, $dbpass, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare and execute the query to select the admin record
        $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // Verify the password (consider using password_hash() and password_verify())
            if ($password === $row['password']) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $row['username'];  // Store username in session
                header('Location: admin_dashboard.php');
                exit();
            } else {
                echo "Invalid email or password.";
            }
        } else {
            echo "Invalid email or password.";
        }

        $stmt->close();
    } else {
        echo "Please fill in both fields.";
    }
}
?>
