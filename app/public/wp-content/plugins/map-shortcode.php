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
                        '<div class="popup-content">' +
                        '<h3>' + location.name + '</h3>' + 
                        '<p><strong>Datum:</strong> ' + location.date + '</p>' +
                        '<p><strong>Starttijd:</strong> ' + location.start_time + '</p>' +
                        '<p><strong>Eindtijd:</strong> ' + location.end_time + '</p>' +
                        '<p><strong>Adres:</strong> ' + location.address + '</p>' + 
                        '<p><strong>Beschrijving:</strong><br>' + location.description + '</p>' + 
                        '<a href="https://www.google.com/maps?q=' + encodeURIComponent(location.address) + '" ' +
                        'target="_blank" class="button button-small">Bekijk op Google Maps</a>' +
                        '</div>'
                    );
            }
        });
    });
    </script>

    <style>
        .leaflet-popup-content h3 {
            margin: 0;
            font-size: 16px;
            color: #333;
        }

        .leaflet-popup-content p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }

        .leaflet-popup-content a.button {
            display: inline-block;
            background-color: #0073aa;
            color: #fff;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .leaflet-popup-content a.button:hover {
            background-color: #005a87;
        }

        .popup-content {
            max-width: 250px;
        }
    </style>

    <?php return ob_get_clean();
}

add_shortcode( 'uitnacht_location_map', 'uitnacht_location_map_shortcode' );