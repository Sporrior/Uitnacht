<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


$locations = get_option('uitnacht_locations_data', array());
$location_count = count($locations); 
?>

<div class="wrap">
    <div class="uitnacht-dashboard-container">
        <h1>Uitnacht Dashboard</h1>
        <p>Welcome to the Uitnacht dashboard, where you can view all saved locations.</p>

        <h2>Overview</h2>
        <p>Total Locations: <strong><?php echo esc_html($location_count); ?></strong></p>

        <?php if (!empty($locations)): ?>
            <h2>Location Map</h2>
            <div id="map" style="height: 500px; margin-bottom: 20px;"></div>

            <h2>Recent Locations</h2>
            <ul>
                <?php foreach ($locations as $location): ?>
                    <li>
                        <strong><?php echo esc_html($location['name']); ?></strong> - <?php echo esc_html($location['address']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No locations have been added yet.</p>
        <?php endif; ?>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    var map = L.map('map').setView([52.3676, 4.9041], 12); 

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var locations = <?php echo json_encode($locations); ?>;

    locations.forEach(function(location) {
        if (location.latitude && location.longitude) {
            var lat = location.latitude;
            var lon = location.longitude;

            var marker = L.marker([lat, lon]).addTo(map)
                .bindPopup(`<strong>${location.name}</strong><br>${location.address}<br>${location.description}`);
        }
    });
});
</script>

<style>
    .uitnacht-dashboard-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background: #f9f9f9;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .uitnacht-dashboard-container h1, 
    .uitnacht-dashboard-container h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }
    .uitnacht-dashboard-container p {
        font-size: 16px;
        color: #555;
    }
    #map {
        height: 500px;
        width: 100%;
    }
</style>