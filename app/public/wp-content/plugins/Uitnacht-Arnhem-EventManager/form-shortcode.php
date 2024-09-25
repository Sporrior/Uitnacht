<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function uitnacht_save_location_form() {
    if ( isset( $_POST['uitnacht_submit'] ) ) {
        $address     = sanitize_text_field( $_POST['uitnacht_address'] );
        $name        = sanitize_text_field( $_POST['uitnacht_name'] );
        $description = sanitize_textarea_field( $_POST['uitnacht_description'] );
        $date        = sanitize_text_field( $_POST['uitnacht_date'] );
        $start_time  = sanitize_text_field( $_POST['uitnacht_start_time'] );
        $end_time    = sanitize_text_field( $_POST['uitnacht_end_time'] );

        $geo_data = wp_remote_get( "https://nominatim.openstreetmap.org/search?q=" . urlencode( $address ) . "&format=json" );
        $geo_data = json_decode( wp_remote_retrieve_body( $geo_data ), true );

        if ( ! empty( $geo_data ) && is_array( $geo_data ) ) {
            $latitude  = $geo_data[0]['lat'];
            $longitude = $geo_data[0]['lon'];

            $locations = get_option( 'uitnacht_locations_data', array() );
            $locations[] = array(
                'address'     => $address,
                'name'        => $name,
                'description' => $description,
                'date'        => $date,
                'start_time'  => $start_time,
                'end_time'    => $end_time,
                'latitude'    => $latitude,
                'longitude'   => $longitude
            );
            update_option( 'uitnacht_locations_data', $locations );

            echo '<div class="notice notice-success is-dismissible"><p>Locatie succesvol opgeslagen!</p></div>';
        } else {
            echo '<div class="notice notice-error is-dismissible"><p>Het adres kon niet worden geocodeerd. Probeer het opnieuw.</p></div>';
        }
    }

    ob_start(); ?>
    <div class="uitnacht-form-container">
        <h1>Voeg een nieuwe locatie toe</h1>
        <p class="intro-text">Gebruik het onderstaande formulier om een nieuw evenement toe te voegen. Zorg ervoor dat alle informatie correct is voordat je het formulier verzendt.</p>

        <form method="post" action="">
            <div class="form-group">
                <label for="uitnacht_name">Naam van evenement:</label>
                <input type="text" name="uitnacht_name" id="uitnacht_name" required class="form-input">
            </div>

            <div class="form-group">
                <label for="uitnacht_address">Adres van locatie:</label>
                <input type="text" name="uitnacht_address" id="uitnacht_address" required class="form-input">
            </div>

            <div class="form-group">
                <label for="uitnacht_date">Datum:</label>
                <input type="date" name="uitnacht_date" id="uitnacht_date" required class="form-input">
            </div>

            <div class="form-group">
                <label for="uitnacht_start_time">Starttijd:</label>
                <input type="time" name="uitnacht_start_time" id="uitnacht_start_time" required class="form-input">
            </div>

            <div class="form-group">
                <label for="uitnacht_end_time">Eindtijd:</label>
                <input type="time" name="uitnacht_end_time" id="uitnacht_end_time" required class="form-input">
            </div>

            <div class="form-group">
                <label for="uitnacht_description">Beschrijving van evenement:</label>
                <textarea name="uitnacht_description" id="uitnacht_description" rows="5" required class="form-input"></textarea>
            </div>

            <div class="form-group">
                <input type="submit" name="uitnacht_submit" value="Opslaan" class="button button-primary">
            </div>
        </form>
    </div>

    <style>
        .uitnacht-form-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 10px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        .uitnacht-form-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }
        .uitnacht-form-container .intro-text {
            font-size: 16px;
            margin-bottom: 30px;
            text-align: center;
            color: #555;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        .form-group .form-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            background-color: #fff;
        }
        .form-group textarea.form-input {
            resize: vertical;
        }
        .button-primary {
            background-color: #0073aa !important;
            color: #fff !important;
            padding: 10px 20px !important;
            border-radius: 5px !important;
            font-size: 16px !important;
            cursor: pointer !important; 
            display: block !important;
            margin: 0 auto !important;
            border: none !important;
        }
        .button-primary:hover {
            background-color: #006799;
        }
        .notice-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
            padding: 15px;
            margin-bottom: 20px;
        }
        .notice-error {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
            padding: 15px;
            margin-bottom: 20px;
        }
    </style>
    <?php return ob_get_clean();
}

add_shortcode( 'uitnacht_add_location_form', 'uitnacht_save_location_form' );
?>