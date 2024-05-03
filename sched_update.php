<?php
// Include your database connection script
include 'connect.php';

// Check if the form has been submitted
if(isset($_POST['updateSchedule'])) {
    // Retrieve data from the form
    $eventId = $_POST['eventId'];
    $eventName = $_POST['eventName'];
    $eventDatetime = $_POST['eventDatetime'];
    $priest = $_POST['priest']; // Add this line to capture the priest value
    $clientName = $_POST['clientname']; // Add this line to capture the client_name value

    // Perform the update query
    $updateQuery = "UPDATE `schedule` 
                    SET `name` = '$eventName', 
                        `place` = '$eventPlace', 
                        `datetime` = '$eventDatetime', 
                        `priest` = '$priest', 
                        `client_name` = '$clientName' 
                    WHERE `id` = $eventId";

    if ($conn->query($updateQuery) === TRUE) {
        echo "<script>alert('Event updated successfully.'); window.location.href='schedules.php';</script>";
    } else {
        echo "<script>alert('Event update failed.'); window.location.href='schedules.php';</script>";
    }
} else {
    // Handle the case where the form was not submitted properly
    echo "<script>alert('Invalid request.'); window.location.href='schedules.php';</script>";
}
?>
