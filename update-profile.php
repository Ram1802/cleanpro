<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: login.php');
    exit();
}

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Create a new connection using mysqli
    $conn = new mysqli("localhost", "root", "", "cleanpro", 3307);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update user profile
    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $email, $phone, $_SESSION['userId']);
    
    if ($stmt->execute()) {
        header('Location: edit-profile.php?message=Profile updated successfully');
    } else {
        header('Location: edit-profile.php?message=Error updating profile');
    }
    
    $stmt->close();
    $conn->close();
    exit();
}
?>
