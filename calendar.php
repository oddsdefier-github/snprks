<?php
session_start();

include 'includes/header.php';
include 'includes/navbar.php';

?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <?php include 'header_nav.php'; ?>
    <!-- main: contains buttons and div for calendar-->
    <div id="content">
        <div class="col-12 col-xl-12">
            <div class="col mt-4">
                <h1 class="mb-2 text-uppercase fw-bolder">Event Calendar</h1>
                <hr>
                <div class="d-flex gap-2 align-items-center">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
                        Add Schedule
                    </button>
                    <button type="button" onclick="window.location.href='schedules.php'" class="btn btn-secondary mb-3">
                        Schedule List
                    </button>
                </div>

                </ul>
            </div>
            <div style="background-color: white; text-decoration:black;" class="col-md-12">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <!-- main: contains buttons and div for calendar-->
    <!-- modal: adding schedule -->
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="addSchedule">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal: viewing the event -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bolder fs-4" id="m_event_name"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="fw-bold">Location (Pamayanan):</h5>
                    <p id="m_pamayanan"></p>
                    <h5 class="fw-bold">Date & Time:</h5>
                    <p id="m_date_time"></p>
                    <h5 class="fw-bold">Priest:</h5>
                    <p id="m_priest"></p>
                    <h5 class="fw-bold">Client Name:</h5>
                    <p id="m_client_name"></p>
                </div>
                <div class="modal-footer">
                    <form action="delete_sched.php" method="POST">
                        <input type="hidden" name="sched_id" id="sched_id">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
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

        if ($conn->query($sql) === true) {
            echo "<script>alert('New Schedule added successfully.'); window.location.href='calendar.php';</script>";
        } else {
            echo "<script>alert('Error adding new Schedule'); window.location.href='ca.php';</script>";
        }
    }
    ?>

<?php include 'includes/scripts.php'; ?>
<script>
$(document).ready(function() {
    displayEvents();
});

function displayEvents() {
    var events = new Array();
    $.ajax({
        url: 'display_event.php',
        dataType: 'json',
        success: function(response) {
            console.log(response.data)
            var result = response.data;
            $.each(result, function(i, item) {
                events.push({
                    id: result[i].id,
                    event_name: result[i].event_name,
                    priest: result[i].priest,
                    client_name: result[i].client_name,
                    address: result[i].address,
                    date: result[i].date,
                    time: result[i].time
                });
            })
            var calendar = $('#calendar').fullCalendar({
                defaultView: 'month',
                timeZone: 'local',
                // editable: true,
                selectable: true,
                selectHelper: true,
                selectAllow: function(selectInfo) {
                    var selectedStartDate = selectInfo.start;
                    var today = moment().startOf('day');
                    if (selectedStartDate.isSameOrBefore(today, 'day')) {
                        return false;
                    }
                    return true;
                },
                select: function(start, end, allDay) {
                    var currentDate = moment(start).format('YYYY-MM-DD');
                    console.log(currentDate);
                    var defaultDatetime = currentDate + 'T12:00';
                    $('#datetime').val(defaultDatetime);
                    $('#addScheduleModal').modal('show');
                },
                events: events,
                eventRender: function(event, element, view) {
                    console.log(event);
                    var eventInfo = $('<div class="event-info"></div>'); // Opening div tag added here
                    eventInfo.append($('<div class="event-name"/>').text(event.event_name));
                    eventInfo.append($('<div class="event-time"/>').text(event.time));
                    element.append(eventInfo);
                    element.bind('click', function() {
                        console.log(event.id + ' YAWA');
                        $("#eventModal").modal('show');
                        $("#m_event_name").text(event.event_name);
                        $("#m_pamayanan").text(event.address);
                        $("#m_date_time").text(event.date + ' ' + event.time);
                        $("#m_priest").text(event.priest);
                        $("#m_client_name").text(event.client_name);
                        $("#sched_id").val(event.id);
                    });
                }

            });
        }, //end success block
        error: function(xhr, status) {
            alert(response.msg);
        }
    }); //end ajax block
}

function save_event() {
    var event_name = $("#event_name").val();
    var event_start_date = $("#event_start_date").val();
    var event_end_date = $("#event_end_date").val();
    if (event_name == "" || event_start_date == "" || event_end_date == "") {
        alert("Please enter all required details.");
        return false;
    }
    $.ajax({
        url: "save_event.php",
        type: "POST",
        dataType: 'json',
        data: {
            event_name: event_name,
            event_start_date: event_start_date,
            event_end_date: event_end_date
        },
        success: function(response) {
            $('#event_entry_modal').modal('hide');
            if (response.status == true) {
                alert(response.msg);
                location.reload();
            } else {
                alert(response.msg);
            }
        },
        error: function(xhr, status) {
            console.log('ajax error = ' + xhr.statusText);
            alert(response.msg);
        }
    });
    return false;
}
</script>