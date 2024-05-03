<?php
include("connect.php");

if (isset($_POST['sched_id'])) {
    $sched_id = $_POST['sched_id'];
    $sched_id = filter_var($sched_id, FILTER_SANITIZE_NUMBER_INT);

    $query = "DELETE FROM schedules WHERE id = $sched_id";

    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Schedule deleted successfully');
        window.location.href='schedules.php';</script>";
        exit(); 
    } else {
        echo "<script>alert('Error deleting schedule: " . $conn->error . "');
        window.location.href='schedules.php';</script>";
    }
    $conn->close();
} else {
    echo "<script>alert('Schedule ID not provided');
    window.location.href='schedules.php';</script>";
}

