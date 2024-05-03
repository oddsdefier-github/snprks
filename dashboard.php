<?php 
include 'includes/header.php'; 
include 'includes/navbar.php';
include 'includes/scripts.php';
include 'connect.php';

if (isset($_SESSION['loggedin']) && $_SESSION['usertype'] == 'Admin') {
    header("location: login.php");
    exit;
}

// Define functions to fetch data
function getCount($conn, $table) {
    $query = "SELECT COUNT(*) as count FROM $table";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    return $row['count'];
}

// Fetch data using functions
$accountCount = getCount($conn, 'account');
$membersCount = getCount($conn, 'members');
$scheduleCount = getCount($conn, 'schedule');
$paymentCount = getCount($conn, 'payments');

// Define card information
$cardInfo = array(
    'All Admin Account' => array('count' => $accountCount, 'icon' => 'bx bxs-user-account'),
    'All Clients' => array('count' => getMembersCountForToday($conn), 'icon' => 'bx bxs-user-circle'),
    'All Schedules' => array('count' => $scheduleCount, 'icon' => 'bx bxs-calendar'),
    'All Baptism' => array('count' => $paymentCount, 'icon' => "fa-solid fa-church"),
    'All Marriage' => array('count' => $paymentCount, 'icon' => 'fa-solid fa-venus-mars'),
    'All Confirmation' => array('count' => $paymentCount, 'icon' => 'fas fa-dove'),
    'All Conversion' => array('count' => $paymentCount, 'icon' => 'fa-solid fa-cross'),
    'All Death' => array('count' => $paymentCount, 'icon' => 'fas fa-ribbon'),
    'All Donation' => array('count' => $paymentCount, 'icon' => 'bx bx-money'),

);

// Function to get the count of schedules for today
function getSchedulesCountForToday($conn) {
    $currentDate = date("Y-m-d");
    $query = "SELECT COUNT(*) as count FROM schedule WHERE DATE(datetime) = '$currentDate'";
    $result = $conn->query($query);

    if ($result === false) {
        // Handle the query error, for example:
        die("Database query error: " . $conn->error);
    }

    $row = $result->fetch_assoc();
    return $row['count'];
}

// Modify the 'All Schedules' entry in $cardInfo
$cardInfo['All Schedules'] = array('count' => getSchedulesCountForToday($conn), 'icon' => 'bx bxs-calendar');

function getMembersCountForToday($conn) {
    $currentDate = date("Y-m-d");
    $query = "SELECT COUNT(*) as count FROM members WHERE DATE(timestamp) = '$currentDate'";
    $result = $conn->query($query);

    if ($result === false) {
        // Handle the query error, for example:
        die("Database query error: " . $conn->error);
    }

    $row = $result->fetch_assoc();
    return $row['count'];
}


    function getPaymentsData($conn, $currentDate) {
        $query = "SELECT DATE(payment_date) as date, SUM(amount) as total_amount FROM payments WHERE DATE(payment_date) = '$currentDate' GROUP BY DATE(payment_date)";
        $result = $conn->query($query);
        $data = array();
    
        while ($row = $result->fetch_assoc()) {
            $data[$row['date']] = $row['total_amount'];
        }
    
        return $data;
    }
    
    $currentDate = date("Y-m-d");
    $paymentData = getPaymentsData($conn, $currentDate);
    
    // Function to get the count of payments for today
function getPaymentsCountForToday($conn) {
    $currentDate = date("Y-m-d");
    $query = "SELECT COUNT(*) as count FROM payments WHERE DATE(payment_date) = '$currentDate'";
    $result = $conn->query($query);

    if ($result === false) {
        // Handle the query error, for example:
        die("Database query error: " . $conn->error);
    }

    $row = $result->fetch_assoc();
    return $row['count'];
}


// Modify the 'All Payments' entry in $cardInfo
$cardInfo['All Payments'] = array('count' => getPaymentsCountForToday($conn), 'icon' => 'bx bx-money');
// Modify the 'All Baptism' entry in $cardInfo
$cardInfo['All Baptism'] = array('count' => getPaymentsCountForToday($conn), 'icon' => "fa-solid fa-church");


?>



            <?php
                function fetchData($conn, $table) {
                    $query = "SELECT * FROM $table";
                    $result = $conn->query($query);
                    $data = array();
                    while ($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }
                    return $data;
                }

                // Fetch admin data using the fetchData function
                $adminData = fetchData($conn, 'account');
            ?>

            <!-- Main Content -->
            <div class="col-12 col-xl-10">
                <div class="col mt-4">
                    <style>
                            h1{
                                font-family: Georgia, 'Times New Roman', Times, serif;
                                text-decoration: white;
                                
                            }
                    </style>
                    <h1 class="mb-4 text-uppercase fw-bolder">Dashboard</h1>
                    <hr>
                    <div class="row">
                        <?php foreach ($cardInfo as $title => $data) { ?>
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <i class='<?php echo $data['icon']; ?> mb-3' style="font-size: 35px;"></i>
                                    <h5 class="card-title"><?php echo $title; ?></h5>
                                    <p class="card-text">You have <?php echo $data['count']; ?>.</p>
                                    <?php if ($title === 'All Payments') { ?>
                                    <!-- Include the payment chart in this card -->
                                    <div class="chart-container">
                                        <canvas id="paymentChart"></canvas>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

<!-- Include the necessary JavaScript files -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Get the current date in PHP -->
<?php $currentDate = date("Y-m-d"); ?>

<script>
const paymentData = <?php echo json_encode($paymentData); ?>;
const currentDate = "<?php echo $currentDate; ?>"; // Pass the current date to JavaScript

// Extract dates and amounts from the payment data
const paymentDates = Object.keys(paymentData);
const paymentAmounts = Object.values(paymentData);

// JavaScript code to create the chart
const ctx = document.getElementById('paymentChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: paymentDates, // Use payment dates as labels
        datasets: [{
            label: 'Total Amount',
            data: paymentAmounts, // Use payment amounts as data
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>


</html>