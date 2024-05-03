<?php
    // Include your database connection script
    include 'connect.php';

    function fetchEventDetails($conn, $eventId) {
        $sql = "SELECT `id`, `name`, `datetime` FROM `schedule` WHERE `id` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $eventId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            return $row;
        } else {
            return false;
        }
    }

    // Check if the 'id' parameter is present in the URL
    if (isset($_GET['id'])) {
        $eventId = $_GET['id'];

        // Fetch event details
        $eventDetails = fetchEventDetails($conn, $eventId);

        if ($eventDetails) {
            $eventName = $eventDetails['name'];
            $eventDatetime = date('Y-m-d\TH:i:s', strtotime($eventDetails['datetime']));

            // Display a form for editing the event
?>
    <form action="schedules_update.php" method="POST">
        <input type="hidden" name="eventId" value="<?= $eventId ?>">
        <div class="mb-3">
            <label for="eventName" class="form-label">Event Name:</label>
            <input type="text" name="eventName" id="eventName" class="form-control" value="<?= $eventName ?>">
        </div>
        <div class="mb-3">
            <label for="eventDatetime" class="form-label">Date & Time:</label>
            <input type="datetime-local" name="eventDatetime" id="eventDatetime" class="form-control"
                value="<?= $eventDatetime ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="updateSchedule">Save</button>
    </form>
    <?php
        } else {
            echo '<div class="alert alert-danger" role="alert">Event not found.</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Invalid URL.</div>';
    }
?>