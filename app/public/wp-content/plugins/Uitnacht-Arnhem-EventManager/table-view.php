<?php
if (!defined('ABSPATH')) {
    exit;
}

// 13 locaties in Arnhem
$locations = get_option('uitnacht_locations_data', array());

if (empty($locations) || count($locations) !== 13 || isset($_GET['reset_locations'])) {
    $locations = [
        ['name' => 'Arnhem Central Station', 'address' => 'Stationsplein 1, Arnhem', 'start_time' => 8, 'end_time' => 20],
        ['name' => 'Arnhem Museum', 'address' => 'Utrechtseweg 87, Arnhem', 'start_time' => 9, 'end_time' => 18],
        ['name' => 'GelreDome', 'address' => 'Batavierenweg 25, Arnhem', 'start_time' => 10, 'end_time' => 23],
        ['name' => 'Rozet Library', 'address' => 'Kortestraat 16, Arnhem', 'start_time' => 7, 'end_time' => 19],
        ['name' => 'Eusebius Church', 'address' => 'Kerkplein 1, Arnhem', 'start_time' => 8, 'end_time' => 17],
        ['name' => 'Burgers Zoo', 'address' => 'Antoon van Hooffplein 1, Arnhem', 'start_time' => 9, 'end_time' => 18],
        ['name' => 'Modekwartier', 'address' => 'Klarendal, Arnhem', 'start_time' => 11, 'end_time' => 22],
        ['name' => 'Park Sonsbeek', 'address' => 'Sonsbeekweg 1, Arnhem', 'start_time' => 6, 'end_time' => 20],
        ['name' => 'Rijnkade', 'address' => 'Rijnkade, Arnhem', 'start_time' => 8, 'end_time' => 21],
        ['name' => 'Musis Sacrum', 'address' => 'Velperbuitensingel 25, Arnhem', 'start_time' => 9, 'end_time' => 23],
        ['name' => 'Arnhem City Hall', 'address' => 'Koningstraat 38, Arnhem', 'start_time' => 8, 'end_time' => 16],
        ['name' => 'Airborne Museum', 'address' => 'Utrechtseweg 232, Arnhem', 'start_time' => 10, 'end_time' => 17],
        ['name' => 'Openluchtmuseum', 'address' => 'Hoeferlaan 4, Arnhem', 'start_time' => 9, 'end_time' => 18],
    ];
    update_option('uitnacht_locations_data', $locations);
}

// Verwijder een locatie
if (isset($_GET['remove_location'])) {
    $remove_index = intval($_GET['remove_location']);
    if (isset($locations[$remove_index])) {
        unset($locations[$remove_index]);
        $locations = array_values($locations); // Reindex array
        update_option('uitnacht_locations_data', $locations);
    }
}

$time_slots = range(8, 22);
?>

<div class="wrap">
    <h1>Evenementen Blokkenschema</h1>
    <a href="?page=<?php echo esc_attr($_GET['page']); ?>&reset_locations=true" class="button button-primary">Reset Locaties</a>
    <div class="uitnacht-timetable-container">
        <table class="timetable modern-table">
            <thead>
                <tr>
                    <th>Locaties/Zalen</th>
                    <?php foreach ($time_slots as $hour): ?>
                        <th><?php echo sprintf('%02d:00', $hour); ?></th>
                    <?php endforeach; ?>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($locations as $index => $location): ?>
                    <tr>
                        <td>
                            <strong><?php echo esc_html($location['name']); ?></strong><br>
                            <small><?php echo esc_html($location['address']); ?></small>
                        </td>
                        <?php foreach ($time_slots as $hour): ?>
                            <td class="<?php echo ($hour >= $location['start_time'] && $hour < $location['end_time']) ? 'open' : 'closed'; ?>"></td>
                        <?php endforeach; ?>
                        <td>
                            <a href="?page=<?php echo esc_attr($_GET['page']); ?>&remove_location=<?php echo $index; ?>" 
                               class="button button-danger" 
                               onclick="return confirm('Weet je zeker dat je deze locatie wilt verwijderen?');">Verwijderen</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .wrap {
        font-family: Arial, sans-serif;
        padding: 20px;
    }
    h1 {
        font-size: 28px;
        margin-bottom: 20px;
    }
    .button-primary {
        background-color: #0073aa;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        text-decoration: none;
        margin-bottom: 20px;
        display: inline-block;
    }
    .button-primary:hover {
        background-color: #005f8c;
    }
    .timetable {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-size: 14px;
    }
    .timetable th, .timetable td {
        border: 1px solid #ddd;
        text-align: center;
        padding: 10px;
    }
    .timetable th {
        background-color: #f4f4f4;
        font-weight: bold;
        text-align: center;
    }
    .modern-table .open {
        background-color: #d4edda;
    }
    .modern-table .closed {
        background-color: #f8d7da;
    }
    .button-danger {
        background-color: #d9534f;
        color: white;
        padding: 5px 10px;
        text-decoration: none;
        border-radius: 5px;
    }
    .button-danger:hover {
        background-color: #c9302c;
    }
</style>
