<?php
    session_start();
    include 'includes/header.php';
    include 'includes/navbar.php';
    include 'includes/scripts.php';
?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php include('header_nav.php');?>
        <div class="col-12 col-xl-12">
            <div class="col mt-4">
                <h1 class="mb-2 text-uppercase fw-bolder">Event Calendar</h1>
                <hr>
                <div class="d-flex gap-2 align-items-center">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
                        Add Schedule
                    </button>
                    <button type="button" onclick="window.location.href='calendar.php'" class="btn btn-secondary mb-3">
                        Calendar
                    </button>
                </div>

                <div class="row">
                    <h3 class="fw-bolder">Schedule List</h3>
                    <?php
                        function fetchData($conn, $table)
                        {
                            $query = "SELECT * FROM $table";
                            $result = $conn->query($query);
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                            }
                            return $data;
                        }
                        $schedData = fetchData($conn, 'schedules');
                    ?>
                    <?php 
                        function fetchUserName($conn, $user_id) {
                            $query = "SELECT fullname FROM account WHERE id = '$user_id'";
                            $result = $conn->query($query);
                            if ($result === FALSE) {
                                return "Error fetching user name";
                            } else {
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    return $row['fullname'];
                                } else {
                                    return "User not found";
                                }
                            }
                        }
                    
                    ?>
                    <div class="col">
                        <div class="table-responsive">
                            <table style="background-color: white" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Date</th>
                                        <th>Event</th>
                                        <th>Client</th>
                                        <th>Pamayanan</th>
                                        <th>Added By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $rowNumber = 1; 
                                        foreach ($schedData as $sched) { 
                                        ?>

                                    <?php 
                                        $user_id = fetchUserName($conn, $sched['added_by']);
                                    ?>
                                    <tr>
                                        <td><?php echo $rowNumber; ?></td>
                                        <td>
                                            <span class="fs-5 fw-bold"><?php echo $sched['date']; ?></span><br>
                                            <span class="fs-6"><?php echo $sched['time']; ?></span>
                                        </td>
                                        <td>
                                            <span class="fs-5 fw-bold"><?php  echo $sched['event_name']; ?></span>
                                        </td>
                                        <td>
                                            <span class="fs-5 fw-bold"><?php  echo $sched['client_name']; ?></span>
                                        </td>
                                        <td>
                                            <span class="fs-5 fw-bold"><?php  echo $sched['address']; ?></span>
                                        </td>
                                        <td><?php echo  $user_id; ?></td>
                                        <td class="d-flex gap-2">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal<?php echo $sched['id']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteSchedModal">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteSchedModal" tabindex="-1" aria-labelledby="deleteSchedModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete
                                                                Schedule</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete the schedule?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <form action="delete_sched.php" method="POST">
                                                                <input type="hidden" name="sched_id" value="<?= $sched['id'] ?>">
                                                                <button type="submit" class="btn btn-danger">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                            $rowNumber++; 
                                            } 
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <div style="background-color: white; text-decoration:black;" class="col-md-8">
                        <div id="calendar"></div>
                    </div> -->
                </div>
            </div>


            <!-- Modal for event details, edit, and delete -->
            <?php foreach ($schedData as $sched) { ?>
            <?php 
                $schedDate = $sched['date'];
                $dateTime = new DateTime($schedDate);
                $formattedDate = $dateTime->format('F d, Y');
            ?>
            <div class="modal fade" id="eventModal<?= $sched['id'] ?>" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bolder fs-4">
                                <?= $sched['event_name']?>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5 class="fw-bold">Location (Pamayanan):</h5>
                            <p><?= $sched['address']?></p>
                            <h5 class="fw-bold">Date & Time:</h5>
                            <p> <?= $formattedDate ?> <small>at</small> <?= $sched['time']?> </p>
                            <h5 class="fw-bold">Priest:</h5>
                            <p> <?= $sched['priest']?></p>
                            <h5 class="fw-bold">Client Name:</h5>
                            <p> <?= $sched['client_name']?></p>
                        </div>
                        <div class="modal-footer">
                            <form action="delete_sched.php" method="POST">
                                <input type="hidden" name="sched_id" value="<?= $sched['id'] ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php }?>

            <!-- Modal for adding a schedule -->
            <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bolder" id="addScheduleModalLabel">Add Schedule</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addScheduleForm" method="POST" action="">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Event Name</label>
                                    <select class="form-select" id="event_name" name="event_name" required>
                                        <option value="Mass">Mass (Misa)</option>
                                        <option value="Blessing">Blessing</option>
                                        <option value="Christening">Christening (Binyag)</option>
                                        <option value="Communion">Communion (Komunyon)</option>
                                        <option value="Confirmation">Confirmation (Kumpil)</option>
                                        <option value="Wedding">Wedding (Kasal)</option>
                                        <option value="Conversion">Conversion (Konbersiyon)</option>
                                        <option value="Funeral">Funeral (Libing)</option>
                                    </select>
                                </div>
                                <?php
                            $sql = "SELECT brgy FROM address"; 
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                echo '<div class="mb-3">';
                                echo '<label for="eventplace" class="form-label">Location (Pamayanan)</label>';
                                echo '<select class="form-select" id="address" name="address" required>';

                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['brgy'] . '">' . $row['brgy'] . '</option>';
                                }
                                echo '</select>';
                                echo '</div>';
                            } else {
                                echo "No addresses found in the database.";
                            }
                        ?>
                                <div class="mb-3">
                                    <label for="datetime" class="form-label">Date & Time</label>
                                    <input type="datetime-local" class="form-control" id="datetime" name="datetime" required>
                                </div>

                                <?php
                            $query = "SELECT first_name, middle_name, last_name FROM priest";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                echo '<div class="mb-3">';
                                echo '<label for="priest" class="form-label">Priest</label>';
                                echo '<select class="form-select" id="priest" name="priest" required>';

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $formatted_name = 'Fr. ' . $row['first_name'] . ' ' . substr($row['middle_name'], 0, 1) . '. ' . $row['last_name'];
                                    echo '<option value="' . $formatted_name . '">' . $formatted_name . '</option>';
                                }

                                echo '</select>';
                                echo '</div>';
                            } else {
                                echo 'Error fetching data from the database';
                            }
                        ?>

                                <div class="mb-3">
                                    <label for="client_name" class="form-label">Client Name</label>
                                    <input type="text" class="form-control" id="client_name" name="client_name" required>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="addSchedule">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- backend: inserting_new_schedules -->
    <?php
    include 'connect.php';

    if (isset($_POST['addSchedule'])) {
        $user_id = $_SESSION['user_id'];
        $event_name = $_POST['event_name'];
        $client_name = $_POST['client_name'];
        $address = $_POST['address'];
        $datetime = $_POST['datetime'];

        list($date, $time) = explode('T', $datetime);
        $time = date("h:i A", strtotime($time));

        $timestamp = strtotime($datetime);
        $date = date('Y-m-d', $timestamp);
        $time = date('H:i', $timestamp); 
        $ampm = date('A', $timestamp); 
        $time = $time . ' ' . $ampm;

        $priest = $_POST['priest']; 
        $clientName = $_POST['clientname']; 

        $sql = "INSERT INTO `schedules` (`event_name`, `priest`, `client_name`, `added_by`,`address`, `date`, `time`) 
                VALUES ('$event_name', '$priest', '$client_name', '$user_id', '$address', '$date', '$time')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New Schedule added successfully.'); window.location.href='schedules.php';</script>";
        } else {
            echo "<script>alert('Error adding new Schedule'); window.location.href='schedules.php';</script>";
        }
    }

    ?>
    </body>

    <script>
    $(document).ready(function() {
        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: {
                url: 'schedules_appointment.php',
                method: 'POST'
            },
            eventClick: function(info) {
                let event = info.event;
                let modal = new bootstrap.Modal($('#eventModal'), {
                    keyboard: true
                });

                if (event) {
                    $('#eventTitle').html(event.title);
                    $('#eventName').html(event.title);
                    $('#eventTime').html(event.startStr);
                    $('#eventPriest').html(event.extendedProps
                        .priest);
                    $('#eventClientName').html(event.extendedProps
                        .client_name);
                    $('#editEventButton').click(function() {
                        window.location.href = 'schedules_edit.php?id=' + event.id;
                    });

                    $('#deleteEventButton').click(function() {
                        if (confirm('Are you sure you want to delete this event?')) {
                            // Send an AJAX request to delete the event
                            $.ajax({
                                url: 'schedules_delete.php',
                                method: 'POST',
                                data: {
                                    id: event.id
                                },
                                success: function(response) {
                                    if (response.success) {
                                        calendar.refetchEvents();
                                        modal.hide();
                                        // Update the schedule list
                                        updateScheduleList(event.id);
                                    } else {
                                        alert('Error deleting event.');
                                    }
                                },
                                error: function() {
                                    alert('Error deleting event.');
                                }
                            });
                        }
                    });


                    // Update the schedule list
                    updateScheduleList(event.id);
                } else {
                    $('#eventTitle').html('No Event Selected');
                    $('#eventName').html('');
                    $('#eventTime').html('');
                }
                modal.show();
            }

        });
        calendar.render();

        function updateScheduleList() {
            $.ajax({
                url: 'sched_list.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    let scheduleList = $('#scheduleList');
                    scheduleList.empty();
                    $.each(response, function(index, schedule) {
                        let listItem = $('<li>').html('<strong>' + schedule.eventName +
                            ':</strong> ' + schedule.datetime);
                        scheduleList.append(listItem);
                    });
                },
            });
        }
        updateScheduleList();
    });
    </script>

    </html>