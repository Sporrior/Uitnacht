<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( isset( $_POST['uitnacht_submit'] ) ) {
    $address = sanitize_text_field( $_POST['uitnacht_address'] );
    $name = sanitize_text_field( $_POST['uitnacht_name'] );
    $description = sanitize_textarea_field( $_POST['uitnacht_description'] );

    $geo_data = wp_remote_get( "https://nominatim.openstreetmap.org/search?q=" . urlencode( $address ) . "&format=json" );
    $geo_data = json_decode( wp_remote_retrieve_body( $geo_data ), true );

    if ( ! empty( $geo_data ) && is_array( $geo_data ) ) {
        $latitude = $geo_data[0]['lat'];
        $longitude = $geo_data[0]['lon'];

        $locations = get_option( 'uitnacht_locations_data', array() );

        $locations[] = array(
            'address' => $address,
            'name' => $name,
            'description' => $description,
            'latitude' => $latitude,
            'longitude' => $longitude
        );

        update_option( 'uitnacht_locations_data', $locations );

        echo '<div class="updated"><p>Location saved successfully!</p></div>';
    } else {
        echo '<div class="error"><p>Unable to geocode the address. Please try again.</p></div>';
    }
}

if ( isset( $_GET['delete_location'] ) ) {
    $index_to_delete = intval( $_GET['delete_location'] );
    $locations = get_option( 'uitnacht_locations_data', array() );

    if ( isset( $locations[$index_to_delete] ) ) {
        unset( $locations[$index_to_delete] );
        $locations = array_values( $locations );
        update_option( 'uitnacht_locations_data', $locations );

        echo '<div class="updated"><p>Location deleted successfully!</p></div>';
    }
}

$locations = get_option( 'uitnacht_locations_data', array() );
?>

<div class="wrap">
    <div class="uitnacht-settings-container">
        <h1>Informatie Settings</h1>
        <p>Here you can add and manage the locations for Uitnacht.</p>

        <form method="post" action="">
            <label for="uitnacht_name">Name:</label>
            <input type="text" name="uitnacht_name" id="uitnacht_name" required><br>

            <label for="uitnacht_address">Address:</label>
            <input type="text" name="uitnacht_address" id="uitnacht_address" required><br>

            <label for="uitnacht_description">Description:</label>
            <textarea name="uitnacht_description" id="uitnacht_description" rows="5" required></textarea><br>

            <input type="submit" name="uitnacht_submit" value="Save Information">
        </form>

        <?php if ( ! empty( $locations ) ) : ?>
            <h2>Saved Locations</h2>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $locations as $index => $location ) : ?>
                        <tr>
                            <td><?php echo esc_html( $location['name'] ); ?></td>
                            <td><?php echo esc_html( $location['address'] ); ?></td>
                            <td><?php echo esc_html( $location['description'] ); ?></td>
                            <td>
                                <a href="?page=<?php echo esc_attr( $_GET['page'] ); ?>&delete_location=<?php echo $index; ?>" class="button button-danger" onclick="return confirm('Are you sure you want to delete this location?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<style>
    .uitnacht-settings-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background: #f9f9f9;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .uitnacht-settings-container h1 {
        font-size: 24px;
        margin-bottom: 10px;
    }
    .uitnacht-settings-container p {
        font-size: 16px;
        color: #555;
    }
    .wp-list-table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }
    .wp-list-table th, .wp-list-table td {
        padding: 8px 12px;
        border-bottom: 1px solid #ddd;
    }
    .wp-list-table th {
        background-color: #f1f1f1;
        text-align: left;
    }
    .button-danger {
        color: #fff;
        background-color: #d9534f;
        border-color: #d43f3a;
        text-decoration: none;
        padding: 5px 10px;
        border-radius: 3px;
    }
</style>