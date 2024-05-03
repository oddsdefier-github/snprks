<?php 

include 'includes/header.php';
include 'includes/navar.php';
include 'includes/scripts.php';

?>

<style>
    .centered-form {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .card {
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        padding: 2rem;
    }
</style>

<body>
    <div class="container mt-5 centered-form">
        <div class="card">
            <div class="card-body">
                <?php
                // Include your database connection script
                include 'connect.php';

                // Check if the 'id' parameter is present in the URL
                if (isset($_GET['id'])) {
                    $eventId = $_GET['id'];

                    // Query to retrieve event data based on the provided 'id'
                    $sql = "SELECT `id`, `name`, `datetime`, `priest`, `client_name` FROM `schedule` WHERE `id` = $eventId";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);

                        // Display a form for editing the event
                        echo '
                        <form action="schedules_update.php" method="POST">
                            <input type="hidden" name="eventId" value="' . $row['id'] . '">
                            <div class="mb-3">
                                <label for="eventName" class="form-label">Event Name:</label>
                                <input type="text" name="eventName" id="eventName" class="form-control" value="' . $row['name'] . '">
                            </div>
                            <div class="mb-3">
                                <label for="eventDatetime" class="form-label">Date & Time:</label>
                                <input type="datetime-local" name="eventDatetime" id="eventDatetime" class="form-control" value="' . date('Y-m-d\TH:i:s', strtotime($row['datetime'])) . '">
                            </div>
                            <div class="mb-3">
                                <label for="priest" class="form-label">Priest:</label>
                                <input type="text" name="priest" id="priest" class="form-control" value="' . $row['priest'] . '">
                            </div>
                            <div class="mb-3">
                                <label for="clientname" class="form-label">Client Name:</label>
                                <input type="text" name="clientname" id="clientname" class="form-control" value="' . $row['client_name'] . '">
                            </div>
                            <button type="submit" class="btn btn-primary" name="updateSchedule">Save</button>
                        </form>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Event not found.</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">Invalid URL.</div>';
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
