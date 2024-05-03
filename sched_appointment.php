<?php
include 'connect.php'; // Include your database connection script

// Query to retrieve events from the database, including "priest" and "client_name"
$sql = "SELECT * FROM `schedules`";

$result = mysqli_query($conn, $sql);

$events = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Convert the date and time format as needed
        // You might need to adjust this format to match your database schema
        $start = date('Y-m-d H:i:s', strtotime($row['datetime']));

        // Include "priest" and "client_name" in the events data
        $events[] = [
            'id' => $row['id'],
            'title' => $row['event_name'],
            'start' => $start,
            'priest' => $row['priest'],
            'client_name' => $row['client_name']
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($events); // Return events data in JSON format
?>
