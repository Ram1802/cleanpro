<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Service - CleanPro Services</title>
    <link rel="stylesheet" href="styles/styles.css">
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
        <h2>Remove Service</h2>
        <form action="delete_service_process.php" method="post">
            <label for="service-id">Service ID:</label>
            <input type="text" id="service-id" name="service_id" required>
            <button type="submit">Remove Service</button>
        </form>
    </main>
</body>
</html>
