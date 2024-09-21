
<?php
// Array of services
$services = [
    [
        "name" => "Home Deep Cleaning",
        "image" => "images/deep.avif",
        "description" => "Our Home Deep Cleaning service includes cleaning all rooms, bathrooms, kitchen, and balconies. We use eco-friendly products and trained professionals to ensure a sparkling clean home.",
        "price" => "$150 - $300",
        "link" => "booking.php"
    ],
    [
        "name" => "Furnished Apartment",
        "image" => "images/furnished.jpeg",
        "description" => "Our Furnished Apartment Cleaning service covers all areas of your furnished home, including detailed cleaning of furniture and fixtures.",
        "price" => "$50 - $100",
        "link" => "booking.php"
    ],
    [
        "name" => "Unfurnished Apartment",
        "image" => "images/unfurnished.avif",
        "description" => "Our Unfurnished Apartment Cleaning service covers all areas of your unfurnished home. Every corner is cleaned meticulously.",
        "price" => "$50 - $100",
        "link" => "booking.php"
    ],
    [
        "name" => "Furnished Bungalow Cleaning",
        "image" => "images/furnished bungalow.jpeg",
        "description" => "Our Furnished Bungalow Cleaning service covers all areas of your furnished home, including detailed cleaning of furniture and fixtures.",
        "price" => "$200 - $400",
        "link" => "booking.php"
    ],
    [
        "name" => "Unfurnished Bungalow Cleaning",
        "image" => "images/unfurnished bungalow.webp",
        "description" => "Our Unfurnished Bungalow Cleaning service ensures every corner is cleaned meticulously.",
        "price" => "$180 - $350",
        "link" => "booking.php"
    ],
    [
        "name" => "Garden Cleaning",
        "image" => "images/garden.jpeg",
        "description" => "Transform your garden with our comprehensive Garden Cleaning service.",
        "price" => "$60 - $120",
        "link" => "booking.php"
    ],
    [
        "name" => "Home Car Parking Area Cleaning",
        "image" => "images/car_parking.webp",
        "description" => "Keep your car parking area spotless with our specialized cleaning service.",
        "price" => "$40 - $80",
        "link" => "booking.php"
    ],
    [
        "name" => "Window Cleaning",
        "image" => "images/window.jpg",
        "description" => "Achieve streak-free windows with our expert Window Cleaning service.",
        "price" => "$60 - $120",
        "link" => "booking.php"
    ],
    [
        "name" => "Kitchen Deep Cleaning",
        "image" => "images/kitchen.jpg",
        "description" => "Deep clean your kitchen, targeting appliances, countertops, cabinets, and floors.",
        "price" => "$120 - $250",
        "link" => "booking.php"
    ],
    // New service variety
    [
        "name" => "Sofa Cleaning",
        "image" => "images/sofa_cleaning.jpg",
        "description" => "Our Sofa Cleaning service ensures a thorough clean of your sofas using eco-friendly solutions.",
        "price" => "$80 - $150",
        "link" => "booking.php"
    ],
    [
        "name" => "Carpet Cleaning",
        "image" => "images/carpet_cleaning.jpg",
        "description" => "Professional Carpet Cleaning service to remove deep stains and dirt.",
        "price" => "$90 - $200",
        "link" => "booking.php"
    ]
];

// Handle the search query
$filteredServices = $services; // Default to all services

if (isset($_GET['query']) && !empty(trim($_GET['query']))) {
    $searchQuery = strtolower(trim($_GET['query']));
    $filteredServices = array_filter($services, function ($service) use ($searchQuery) {
        return strpos(strtolower($service['name']), $searchQuery) !== false;
    });
}

?>

<section class="service-details">
<?php
// Display filtered services
if (!empty($filteredServices)) {
    foreach ($filteredServices as $service) {
        echo '
       <center> 
       <div class="service-item">
            <h2>' . $service['name'] . '</h2>
            <img src="' . $service['image'] . '" alt="' . $service['name'] . '">
            <p>' . $service['description'] . '</p>
            <p class="price">' . $service['price'] . '</p>
            <a href="' . $service['link'] . '" class="btn-primary">Book Now</a>
        </div></center>'; 
        
    }
} else {
    echo "<p>Service not found!</p>";
}
?>
</section>
<!-- Footer Section -->
<footer>
    <div class="footer-content">
        <div class="footer-section about">
            <h2>About CleanPro Services</h2>
            <p>Your go-to platform for all home cleaning needs, offering eco-friendly and professional cleaning services.</p>
        </div>
        <div class="footer-section links">
            <h2>Quick Links</h2>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
        </div>
        <div class="footer-section contact">
            <h2>Contact Us</h2>
            <p>Email: support@cleanproservices.com</p>
            <p>Phone: +1 234 567 890</p>
            <div class="socials">
                <a href="#"><img src="images/facebook-icon.png" alt="Facebook"></a>
                <a href="#"><img src="images/twitter-icon.png" alt="Twitter"></a>
                <a href="#"><img src="images/instagram-icon.png" alt="Instagram"></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 CleanPro Services | Designed by CleanPro Team</p>
    </div>
</footer>

<!-- Enhanced CSS for Footer -->
<style>
.footer-content {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    background-color: #2c3e50;
    color: #ecf0f1;
    padding: 40px 20px;
    font-family: 'Arial', sans-serif;
}

.footer-section {
    flex: 1;
    padding: 20px;
    min-width: 250px;
}

.footer-section h2 {
    margin-bottom: 15px;
    font-size: 1.5em;
    color: #e74c3c;
    border-bottom: 2px solid #e74c3c;
    padding-bottom: 5px;
}

.footer-section p {
    font-size: 14px;
    line-height: 1.6;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 10px;
}

.footer-section ul li a {
    color: #ecf0f1;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s ease;
}

.footer-section ul li a:hover {
    color: #e74c3c;
}

.footer-bottom {
    text-align: center;
    padding: 15px 20px;
    background-color: #1a252f;
    color: #bdc3c7;
    font-size: 14px;
    margin-top: 20px;
}

.footer-bottom p {
    margin: 0;
    padding: 5px;
}

.socials {
    margin-top: 15px;
}

.socials img {
    width: 35px;
    height: 35px;
    margin-right: 15px;
    transition: transform 0.3s ease;
}

.socials img:hover {
    transform: scale(1.1);
}

/* Add responsiveness for smaller screens */
@media (max-width: 768px) {
    .footer-content {
        flex-direction: column;
        text-align: center;
    }

    .footer-section {
        margin-bottom: 20px;
    }
}
</style>
