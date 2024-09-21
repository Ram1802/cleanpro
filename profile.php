<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CleanPro Services - User Profile</title>
    <link rel="stylesheet" href="styles\styles.css">
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Bookings</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="profile-content">
        <h2>Welcome, [User's Name]</h2>
        <h3>Your Profile</h3>
        <p>Name: [User's Name]</p>
        <p>Address: [User's Address]</p>
        <p>Contact: [User's Contact Number]</p>

        <h3>Your Bookings</h3>
        <table>
            <tr>
                <th>Service</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>Home Deep Cleaning</td>
                <td>25/09/2024</td>
                <td>10:00 AM</td>
                <td>Confirmed</td>
            </tr>
            <tr>
                <td>Bathroom Cleaning</td>
                <td>18/09/2024</td>
                <td>2:00 PM</td>
                <td>Completed</td>
            </tr>
        </table>
    </main>
</body>
</html>
