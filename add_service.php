<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Service - CleanPro Services</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="manage_services.php">Manage Services</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="admin-content">
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
    </main>
</body>
</html>
