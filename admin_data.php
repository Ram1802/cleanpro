<?php
// Start the session if needed
session_start();

// Verify if the admin is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}

// Database connection details
$host = 'localhost';
$dbname = 'cleanpro';
$dbuser = 'root';
$dbpass = ''; 
$port = 3307; 

// Create a new database connection
$conn = new mysqli($host, $dbuser, $dbpass, $dbname, $port);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize response array
$response = array();

// Query to get total users
$totalUsersQuery = "SELECT COUNT(*) as totalUsers FROM users";
$totalUsersResult = $conn->query($totalUsersQuery);
$totalUsersRow = $totalUsersResult->fetch_assoc();
$response['totalUsers'] = $totalUsersRow['totalUsers'];

// Query to get total services
$totalServicesQuery = "SELECT COUNT(*) as totalServices FROM services";
$totalServicesResult = $conn->query($totalServicesQuery);
$totalServicesRow = $totalServicesResult->fetch_assoc();
$response['totalServices'] = $totalServicesRow['totalServices'];

// Query to get pending requests
$pendingRequestsQuery = "SELECT COUNT(*) as pendingRequests FROM requests WHERE status = 'pending'";
$pendingRequestsResult = $conn->query($pendingRequestsQuery);
$pendingRequestsRow = $pendingRequestsResult->fetch_assoc();
$response['pendingRequests'] = $pendingRequestsRow['pendingRequests'];

// Query to get recent activities
$recentActivitiesQuery = "SELECT activity FROM activities ORDER BY activity_date DESC LIMIT 5";
$recentActivitiesResult = $conn->query($recentActivitiesQuery);
$recentActivities = array();
while($row = $recentActivitiesResult->fetch_assoc()) {
    $recentActivities[] = $row['activity'];
}
$response['recentActivities'] = $recentActivities;

// Query to get user data for 'View Users'
$response['users'] = array();
$usersQuery = "SELECT name, email FROM users";
$usersResult = $conn->query($usersQuery);
while ($userRow = $usersResult->fetch_assoc()) {
    $response['users'][] = $userRow;
}

// Output the data as JSON
header('Content-Type: application/json');
echo json_encode($response);

// Close the connection
$conn->close();
?>
