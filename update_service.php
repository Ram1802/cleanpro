<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Service - CleanPro Services</title>
    
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <ul>
            <li><a href="admin_dashboard.php">Dashboard</a></li>
            <li><a href="manage_services.php">Manage Services</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="admin-content">
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
    </main>
</body>
</html>
