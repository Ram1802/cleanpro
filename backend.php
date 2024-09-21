<?php
// Example for add_service_process.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_name = $_POST['service_name'];
    $service_description = $_POST['service_description'];
    $service_price = $_POST['service_price'];

    // Add database connection here
    // Perform SQL query to insert the new service

    echo "Service added successfully!";
}
?>
