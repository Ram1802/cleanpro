<!-- Manage Users Section -->
<div id="manage-users" class="content-section">
    <h2>Manage Users</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="manage-user-list">
            <!-- User data will be loaded here -->
        </tbody>
    </table>
</div>

<script>
// Add this in the same loadDashboardData function
data.users.forEach(user => {
    const tr = document.createElement('tr');
    tr.innerHTML = `<td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>
                        <button onclick="updateUser('${user.email}')">Update</button>
                        <button onclick="deleteUser('${user.email}')">Delete</button>
                        <button onclick="viewUser('${user.email}')">View Details</button>
                    </td>`;
    document.getElementById('manage-user-list').appendChild(tr);
});

// Add these functions for actions
function updateUser(email) {
    // Redirect to update user page with the user's email
    window.location.href = `update_user.php?email=${email}`;
}

function deleteUser(email) {
    // Call delete user API
    if (confirm('Are you sure you want to delete this user?')) {
        fetch(`delete_user.php?email=${email}`, { method: 'POST' })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('User deleted successfully');
                    loadDashboardData(); // Reload users
                } else {
                    alert('Failed to delete user');
                }
            })
            .catch(error => console.error('Error deleting user:', error));
    }
}

function viewUser(email) {
    // Redirect to view user details page
    window.location.href = `view_user.php?email=${email}`;
}
</script>
