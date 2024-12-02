<?php
if (!defined('ABSPATH')) {
    exit;
}

// Predefine 13 locations with time ranges
$locations = get_option('uitnacht_locations_data', array());

if (empty($locations)) {
    $locations = [
        ['name' => 'Arnhem Central Station', 'address' => 'Stationsplein 1', 'start_time' => 8, 'end_time' => 20],
        ['name' => 'Arnhem Museum', 'address' => 'Utrechtseweg 87', 'start_time' => 9, 'end_time' => 18],
        ['name' => 'GelreDome', 'address' => 'Batavierenweg 25', 'start_time' => 10, 'end_time' => 23],
        ['name' => 'Rozet Library', 'address' => 'Kortestraat 16', 'start_time' => 7, 'end_time' => 19],
        ['name' => 'Eusebius Church', 'address' => 'Kerkplein 1', 'start_time' => 8, 'end_time' => 17],
        ['name' => 'Burgers Zoo', 'address' => 'Antoon van Hooffplein 1', 'start_time' => 9, 'end_time' => 18],
        ['name' => 'Modekwartier', 'address' => 'Klarendal', 'start_time' => 11, 'end_time' => 22],
        ['name' => 'Park Sonsbeek', 'address' => 'Sonsbeekweg 1', 'start_time' => 6, 'end_time' => 20],
        ['name' => 'Rijnkade', 'address' => 'Rijnkade', 'start_time' => 8, 'end_time' => 21],
        ['name' => 'Musis Sacrum', 'address' => 'Velperbuitensingel 25', 'start_time' => 9, 'end_time' => 23],
        ['name' => 'Arnhem City Hall', 'address' => 'Koningstraat 38', 'start_time' => 8, 'end_time' => 16],
        ['name' => 'Airborne Museum', 'address' => 'Utrechtseweg 232', 'start_time' => 10, 'end_time' => 17],
        ['name' => 'Openluchtmuseum', 'address' => 'Hoeferlaan 4', 'start_time' => 9, 'end_time' => 18],
    ];
    update_option('uitnacht_locations_data', $locations);
}

// Remove a location
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
    <div class="uitnacht-timetable-container">
        <table class="timetable">
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
                        <td><strong><?php echo esc_html($location['name']); ?></strong><br>
                            <small><?php echo esc_html($location['address']); ?></small></td>
                        <?php foreach ($time_slots as $hour): ?>
                            <td style="background-color: <?php echo ($hour >= $location['start_time'] && $hour < $location['end_time']) ? '#d4edda' : '#f8d7da'; ?>;">
                                <?php echo ($hour >= $location['start_time'] && $hour < $location['end_time']) ? 'Open' : ''; ?>
                            </td>
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
    .timetable {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .timetable th, .timetable td {
        border: 1px solid #ddd;
        text-align: center;
        padding: 10px;
    }
    .timetable th {
        background-color: #f4f4f4;
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
