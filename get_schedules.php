<?php
include("connect.php"); 

// Fetch schedule data from the database
$query = "SELECT id, event_name AS title, start_datetime AS start, end_datetime AS end FROM schedules";
$result = $conn->query($query);

$events = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($events);
$conn->close();

// Debugging output (remove in production)
echo '<script>';
echo 'console.log(' . json_encode($events) . ');';
echo '</script>';