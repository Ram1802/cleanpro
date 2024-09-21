<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Debugging statement
echo '<pre>'; print_r($_SESSION); echo '</pre>'; // Check session variables

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "cleanpro";
$port = 3307;

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    die('User not logged in. Please log in first.');
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    $success_message = '';

    // Get user input
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $user_id = $_SESSION['user_id']; // Assuming user ID is stored in session

    // Fetch current password from database
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    // Verify current password
    if (!password_verify($current_password, $hashed_password)) {
        $errors['current_password'] = 'Current password is incorrect.';
    }

    // Validate new password
    if (strlen($new_password) < 6) {
        $errors['new_password'] = 'New password must be at least 6 characters long.';
    }

    // Confirm new password
    if ($new_password !== $confirm_password) {
        $errors['confirm_password'] = 'New password and confirm password do not match.';
    }

    // Update password if no errors
    if (empty($errors)) {
        $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $new_hashed_password, $user_id);
        if ($stmt->execute()) {
            $success_message = 'Password changed successfully.';
        } else {
            $errors['general'] = 'An error occurred while updating the password.';
        }
        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #28a745;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Change Password</h1>
        <?php if (!empty($success_message)) { echo "<div class='message success'>$success_message</div>"; } ?>
        <?php if (!empty($errors)) { foreach ($errors as $error) { echo "<div class='message error'>$error</div>"; } } ?>
        <form method="POST" action="">
            <label for="current_password">Current Password:</label>
            <input type="password" id="current_password" name="current_password" required>
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>
            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <button type="submit">Change Password</button>
        </form>
    </div>
</body>
</html>
