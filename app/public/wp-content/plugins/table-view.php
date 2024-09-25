<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( isset( $_GET['delete_location'] ) ) {
    $index_to_delete = intval( $_GET['delete_location'] );
    $locations = get_option( 'uitnacht_locations_data', array() );

    if ( isset( $locations[$index_to_delete] ) ) {
        unset( $locations[$index_to_delete] );
        $locations = array_values( $locations );
        update_option( 'uitnacht_locations_data', $locations );

        echo '<div class="notice notice-success is-dismissible"><p>Locatie succesvol verwijderd!</p></div>';
    }
}

$locations = get_option( 'uitnacht_locations_data', array() );
?>

<div class="wrap">
    <div class="uitnacht-settings-container">
        <h1>Opgeslagen Locaties</h1>
        <p>Hieronder vind je een lijst van alle opgeslagen locaties. Je kunt locaties verwijderen door op de verwijderknop te klikken.</p>

        <?php if ( ! empty( $locations ) ) : ?>
            <table class="wp-list-table widefat fixed striped uitnacht-table">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Adres</th>
                        <th>Beschrijving</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $locations as $index => $location ) : ?>
                        <tr>
                            <td><strong><?php echo esc_html( $location['name'] ); ?></strong></td>
                            <td><?php echo esc_html( $location['address'] ); ?></td>
                            <td><?php echo esc_html( $location['description'] ); ?></td>
                            <td>
                                <a href="?page=<?php echo esc_attr( $_GET['page'] ); ?>&delete_location=<?php echo $index; ?>"
                                   class="button button-danger"
                                   onclick="return confirm('Weet je zeker dat je deze locatie wilt verwijderen?');">Verwijderen</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Er zijn nog geen locaties opgeslagen.</p>
        <?php endif; ?>
    </div>
</div>

<style>
    .uitnacht-settings-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 30px;
        background-color: #f9f9f9;
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }
    .uitnacht-settings-container h1 {
        font-size: 26px;
        margin-bottom: 20px;
        color: #333;
    }
    .uitnacht-settings-container p {
        font-size: 16px;
        margin-bottom: 30px;
        color: #555;
    }
    .wp-list-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    .wp-list-table th, .wp-list-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #e0e0e0;
        text-align: left;
    }
    .wp-list-table th {
        background-color: #f7f7f7;
        font-weight: bold;
        color: #444;
    }
    .wp-list-table td {
        background-color: #fff;
    }
    .wp-list-table td strong {
        color: #0073aa;
    }
    .wp-list-table .button-danger {
        background-color: #d9534f;
        color: #fff;
        border: none;
        padding: 6px 12px;
        text-decoration: none;
        border-radius: 5px;
        display: inline-block;
    }
    .wp-list-table .button-danger:hover {
        background-color: #c9302c;
    }
    .notice-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
        padding: 15px;
        border-left: 4px solid #28a745;
        margin-bottom: 20px;
    }
</style>