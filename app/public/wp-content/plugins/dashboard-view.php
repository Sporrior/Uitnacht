<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$locations = get_option('uitnacht_locations_data', array());
$location_count = count($locations);
?>

<div class="wrap">
    <div class="uitnacht-dashboard-container">
        <h1>Welkom bij de Uitnacht Plugin</h1>
        <p class="intro-text">De Uitnacht plugin helpt je om locaties op te slaan en weer te geven op een kaart. Gebruik de bijgevoegde shortcodes om eenvoudig een formulier toe te voegen waarmee bezoekers nieuwe locaties kunnen indienen, en om een kaart te tonen waarop alle opgeslagen locaties worden weergegeven.</p>

        <div class="uitnacht-plugin-info">
            <h2>Wat kan deze plugin doen?</h2>
            <p>Met de Uitnacht plugin kun je eenvoudig locaties verzamelen en weergeven. Je kunt het formulier op elke pagina plaatsen met behulp van de shortcode, en de locaties automatisch laten weergeven op een interactieve kaart. Dit is ideaal voor evenementen, winkels, of andere plaatsen die je zichtbaar wilt maken op je website.</p>
        </div>

        <div class="uitnacht-shortcode-section">
            <h2>Hoe gebruik je de shortcodes?</h2>
            <p>Gebruik de volgende shortcodes om de functies van de plugin toe te voegen aan je website:</p>
            <ul class="shortcode-list">
                <li><strong>[uitnacht_add_location_form]</strong>: Voegt een formulier toe waar gebruikers nieuwe locaties kunnen indienen.</li>
                <li><strong>[uitnacht_location_map]</strong>: Toont een interactieve kaart met alle opgeslagen locaties.</li>
            </ul>
        </div>

        <div class="uitnacht-overview">
            <h2>Overzicht van opgeslagen locaties</h2>
            <p>Totaal aantal locaties: <strong><?php echo esc_html($location_count); ?></strong></p>
        </div>
    </div>
</div>

<style>
    .uitnacht-dashboard-container {
        max-width: 800px;
        margin: 20px auto;
        padding: 30px;
        background-color: #f9f9f9;
        border-radius: 10px;
        border: 1px solid #ddd;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .uitnacht-dashboard-container h1 {
        font-size: 28px;
        margin-bottom: 20px;
        text-align: center;
    }
    .uitnacht-dashboard-container .intro-text {
        font-size: 16px;
        text-align: center;
        margin-bottom: 30px;
        color: #555;
    }
    .uitnacht-plugin-info, .uitnacht-shortcode-section {
        margin-bottom: 30px;
    }
    .uitnacht-plugin-info h2, .uitnacht-shortcode-section h2 {
        font-size: 22px;
        margin-bottom: 10px;
    }
    .uitnacht-plugin-info p, .uitnacht-shortcode-section p {
        font-size: 16px;
        line-height: 1.6;
        color: #333;
    }
    .shortcode-list {
        margin-left: 20px;
    }
    .shortcode-list li {
        font-size: 16px;
        background: #f1f1f1;
        padding: 10px;
        margin-bottom: 10px;
        border-left: 4px solid #0073aa;
        border-radius: 4px;
    }
    .uitnacht-overview h2 {
        font-size: 22px;
        margin-bottom: 15px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 5px;
    }
    .uitnacht-overview p {
        font-size: 16px;
        color: #555;
        margin-bottom: 15px;
    }
    .location-list {
        list-style: none;
        padding-left: 0;
    }
    .location-list li {
        background: #fff;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 4px;
        border: 1px solid #ddd;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .location-list li strong {
        color: #0073aa;
    }
</style>