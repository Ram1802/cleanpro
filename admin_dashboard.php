<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

// Create connection
$conn = new mysqli($host, $dbuser, $dbpass, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch total services
$totalServicesQuery = "SELECT COUNT(*) as totalServices FROM services";
$totalServicesResult = $conn->query($totalServicesQuery);
$totalServicesRow = $totalServicesResult->fetch_assoc();
$totalServices = $totalServicesRow['totalServices'];

// Fetch pending requests
$pendingRequestsQuery = "SELECT COUNT(*) as pendingRequests FROM requests WHERE status = 'pending'";
$pendingRequestsResult = $conn->query($pendingRequestsQuery);
$pendingRequestsRow = $pendingRequestsResult->fetch_assoc();
$pendingRequests = $pendingRequestsRow['pendingRequests'];

// Fetch total users
$totalUsersQuery = "SELECT COUNT(*) as totalUsers FROM users";
$totalUsersResult = $conn->query($totalUsersQuery);
$totalUsersRow = $totalUsersResult->fetch_assoc();
$totalUsers = $totalUsersRow['totalUsers'];

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CleanPro Services</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header Styles */
        header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 24px;
        }

        nav {
            display: flex;
            align-items: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            margin-left: 20px;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            padding: 20px;
            height: calc(100vh - 70px);
            position: fixed;
            top: 70px;
            left: 0;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 15px;
        }

        .sidebar ul li a {
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            display: block;
            padding: 10px;
            background-color: #495057;
            border-radius: 5px;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: 250px;
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            flex: 1;
        }

        /* Section hiding */
        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        /* Widgets */
        .dashboard-widgets {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .widget {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            width: 30%;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .widget h3 {
            margin-bottom: 10px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .sidebar {
                width: 100%;
                position: relative;
            }
        }
    </style>
</head>
<body>

    <header>
        <button class="menu-toggle" onclick="toggleSidebar()">☰ Menu</button>
        <h1>Admin Dashboard</h1>
        <nav>
            <a href="change_password.php">Change Password</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <ul>
                <li><a href="#" onclick="showSection('dashboard')">Dashboard</a></li>
                <li><a href="#" onclick="showSection('add-service')">Add New Service</a></li>
                <li><a href="#" onclick="showSection('update-service')">Update Service</a></li>
                <li><a href="#" onclick="showSection('delete-service')">Remove Service</a></li>
                <li><a href="view_users.php">View Users</a></li>
                <li><a href="manage_users.php">Manage Users</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <!-- Dashboard Section -->
            <div id="dashboard" class="content-section active">
                <h2>Admin Dashboard</h2>
                <div class="dashboard-widgets">
                    <div class="widget">
                        <h3>Total Users</h3>
                        <p><?php echo $totalUsers; ?></p>
                    </div>
                    <div class="widget">
                        <h3>Total Services</h3>
                        <p><?php echo $totalServices; ?></p>
                    </div>
                    <div class="widget">
                        <h3>Pending Requests</h3>
                        <p><?php echo $pendingRequests; ?></p>
                    </div>
                </div>
            </div>

            <!-- Add Service Section -->
            <div id="add-service" class="content-section">
                <h2>Add New Service</h2>
                <form action="add_service_process.php" method="post">
                    <label for="service-name">Service Name:</label>
                    <input type="text" id="service-name" name="service_name" required>
                    <label for="service-description">Description:</label>
                    <textarea id="service-description" name="service_description" required></textarea>
                    <label for="service-price">Price:</label>
                    <input type="number" id="service-price" name="service_price" required>
                    <button type="submit">Add Service</button>
                </form>
            </div>

            <!-- Update Service Section -->
            <div id="update-service" class="content-section">
                <h2>Update Service</h2>
                <form action="update_service_process.php" method="post">
                    <label for="service-id">Service ID:</label>
                    <input type="text" id="service-id" name="service_id" required>
                    <label for="new-service-name">New Service Name:</label>
                    <input type="text" id="new-service-name" name="new_service_name">
                    <label for="new-service-description">New Description:</label>
                    <textarea id="new-service-description" name="new_service_description"></textarea>
                    <label for="new-service-price">New Price:</label>
                    <input type="number" id="new-service-price" name="new_service_price">
                    <button type="submit">Update Service</button>
                </form>
            </div>

            <!-- Delete Service Section -->
            <div id="delete-service" class="content-section">
                <h2>Remove Service</h2>
                <form action="delete_service_process.php" method="post">
                    <label for="service-id-delete">Service ID:</label>
                    <input type="text" id="service-id-delete" name="service_id" required>
                    <button type="submit">Remove Service</button>
                </form>
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }

        function showSection(sectionId) {
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => {
                if (section.id === sectionId) {
                    section.classList.add('active');
                } else {
                    section.classList.remove('active');
                }
            });
        }
    </script>
</body>
</html>
