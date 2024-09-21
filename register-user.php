<?php
session_start();
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "cleanpro";
$port = 3307;

// Create a new connection using mysqli
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Registration Request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $address = $_POST['address'];

    // Validate password match
    if ($password !== $confirm_password) {
        die('Passwords do not match.');
    }

    // Check if email already exists
    $checkEmailStmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailStmt->store_result();

    if ($checkEmailStmt->num_rows > 0) {
        die('Email already exists.');
    }

    $checkEmailStmt->close();

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL statement using mysqli
    $stmt = $conn->prepare("INSERT INTO users (email, name, mobile, password, address) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $email, $name, $mobile, $hashedPassword, $address);

    // Execute statement
    if ($stmt->execute()) {
        $_SESSION['user'] = $name; // Store the user's name in the session
        $stmt->close();  // Close the statement
        header('Location: login.php'); // Redirect to homepage after registration
        exit();
    } else {
        $stmt->close();  // Close the statement
        die('Registration failed: ' . $stmt->error);
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CleanPro Services</title>
    <style>
        /* styles/styles.css */
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 1rem;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 0.5rem 0 0.25rem;
            font-weight: bold;
            color: #555;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"],
        input[type="file"] {
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            width: 100%;
        }

        button {
            background: #28a745;
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
            width: 100%;
        }

        button:hover {
            background: #218838;
        }

        p {
            margin: 1rem 0;
            color: #555;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form action="register-user.php" method="post" enctype="multipart/form-data"> <!-- Add enctype for file uploads -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="mobile">Mobile Number:</label>
            <input type="text" id="mobile" name="mobile" required pattern="\d{10}" title="Please enter a valid 10-digit mobile number">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <button type="submit" name="register">Register</button>
        </form>
        <p>Already have an account? <a href="login.html">Login here</a></p>
    </div>
</body>
</html>
