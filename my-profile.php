<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verify if the user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.html');
    exit();
}

// Fetch user data from the session or database
// Assuming user data is stored in session for simplicity
$username = $_SESSION['user'];
// Retrieve additional user details from the database if needed
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - CleanPro Services</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #495057;
            margin: 0;
            padding: 0;
        }

        .profile-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .profile-container p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .profile-container a {
            color: #007bff;
            text-decoration: none;
        }

        .profile-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>My Profile</h1>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
        <!-- Add more user information here -->
        <p><a href="edit-profile.php">Edit Profile</a></p>
    </div>
</body>
</html>
