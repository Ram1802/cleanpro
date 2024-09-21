document.addEventListener('DOMContentLoaded', function() {
    // Debugging output
    console.log('Checking login status...');
    var isLoggedIn = checkUserLoginStatus();
    console.log('Logged in:', isLoggedIn);

    if (isLoggedIn) {
        // Show user menu and account icon 
        document.getElementById('userMenu').style.display = 'block';
        document.getElementById('signupMenu').style.display = 'none';
        document.getElementById('accountIcon').style.display = 'block';

        // Set the username in the navigation
        var username = getUserName();
        console.log('Username:', username);
        document.getElementById('userName').textContent = 'Welcome, ' + username;

    } else {
        // Show signup menu and hide user menu and account icon
        document.getElementById('userMenu').style.display = 'none';
        document.getElementById('signupMenu').style.display = 'block';
        document.getElementById('accountIcon').style.display = 'none';

        // Reset the username display
        document.getElementById('userName').textContent = 'Welcome, User';
    }
});

// Function to check if user is logged in
function checkUserLoginStatus() {
    return sessionStorage.getItem('loggedIn') === 'true';
}

// Function to get the username from session storage
function getUserName() {
    return sessionStorage.getItem('username') || 'User';
}

// Function to handle user logout
function logout() {
    sessionStorage.removeItem('loggedIn');
    sessionStorage.removeItem('username');
    // Optionally redirect to a login page or refresh the page
    window.location.href = 'login.html'; // Redirect to login page
}
