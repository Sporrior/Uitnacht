<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function uitnacht_location_map_shortcode() {
    $locations = get_option( 'uitnacht_locations_data', array() );

    if ( empty( $locations ) ) {
        return '<p>Geen locaties om op de kaart weer te geven.</p>';
    }

    ob_start(); ?>

    <div id="uitnacht-map" style="height: 500px;"></div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('uitnacht-map').setView([51.98, 5.91], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var locations = <?php echo json_encode($locations); ?>;

        locations.forEach(function(location) {
            if (location.latitude && location.longitude) {
                var marker = L.marker([location.latitude, location.longitude]).addTo(map)
                    .bindPopup(
                        '<strong>' + location.name + '</strong><br>' + 
                        location.address + '<br>' + 
                        location.description + '<br><br>' + 
                        '<a href="https://www.google.com/maps?q=' + encodeURIComponent(location.address) + '" ' +
                        'target="_blank" class="button button-small">Bekijk op Google Maps</a>'
                    );
            }
        });
    });
    </script>

    <style>
        .leaflet-popup-content a.button {
            display: inline-block;
            background-color: #0073aa;
            color: #fff;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            margin-top: 10px;
        }
        .leaflet-popup-content a.button:hover {
            background-color: #005a87;
        }
    </style>

    <?php return ob_get_clean();
}

add_shortcode( 'uitnacht_location_map', 'uitnacht_location_map_shortcode' );