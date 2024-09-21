document.getElementById('filter-form').addEventListener('submit', function(e) {
    e.preventDefault();
    // Fetch selected filter values
    const priceRange = document.getElementById('price-range').value;
    const timeDuration = document.getElementById('time-duration').value;
    const serviceType = document.getElementById('service-type').value;
    const sortBy = document.getElementById('sort-by').value;

    // Logic to filter and sort the services based on selected values
    console.log('Filters Applied:', priceRange, timeDuration, serviceType, sortBy);
});


document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav-links li');

    navLinks.forEach(link => {
        link.addEventListener('mouseenter', () => {
            link.querySelector('.dropdown').style.display = 'block';
        });

        link.addEventListener('mouseleave', () => {
            link.querySelector('.dropdown').style.display = 'none';
        });
    });
});
