<?php
    session_start();
    $title = "dashboard";
    include 'includes/header.php';
    include 'includes/navbar.php';
    include 'includes/scripts.php';


?>

<?php
function fetchData($conn, $table) {
    $query = "SELECT * FROM death"; // Make sure the table name matches the one in your database
    $result = $conn->query($query);
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}


// Establish a database connection
$conn = new mysqli("localhost", "root", "", "stoninodb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch death data using the fetchData function
$deathData = fetchData($conn, 'Death');

if (isset($_GET['id'])) {
    // Sanitize the ID parameter to prevent SQL injection (you should use prepared statements for better security)
    $recordId = intval($_GET['id']);

    // Establish a database connection
    $conn = new mysqli("localhost", "root", "", "stoninodb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create a query to retrieve the selected record
    $query = "SELECT * FROM death WHERE id = $recordId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $deathRecord = $result->fetch_assoc();
    } else {
        // Handle the case where the record with the specified ID was not found
        echo "Record not found.";
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle the case where the ID parameter is not set in the URL
    echo "ID parameter is missing.";
}

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
        <form
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
            <input class="form-control" type="text" id="searchInput" placeholder="Search for...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
            
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                        <input class="form-control" type="text" id="searchInput" placeholder="Search for...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>


            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-800 large">Mary Rose</span>
                    <img class="img-profile rounded-circle mr-2"
                        src="img/logo.png">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="profile.php">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-500"></i>
                        Profile
                    </a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-500"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>

    </nav>

<!-- Main Content -->
<div class="col-12 col-xl-12">
    <div class="col mt-4">
        <h1 class="mb-4 text-uppercase fw-bolder">Death Information</h1>
        
        <hr>
      
        <div class="row">
    <?php if (isset($_GET['id'])) { ?>
        <div class="col-12">
            <div class="card mb-3">
               <strong> <div class="card-header d-flex justify-content-between align-items-center">
                    Client - <?php echo $deathRecord['name_of_deceased']; ?>
                    <div></strong>
                        <a href="death.php" class="btn btn-primary">Back</a>
                        
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>ID:</td>
                                <td><?php echo $deathRecord['id']; ?></td>
                            </tr>
                            <tr>
                                <td>Record No:</td>
                                <td><?php echo $deathRecord['record_no']; ?></td>
                            </tr>
                            <tr>
                                <td>Book No:</td>
                                <td><?php echo $deathRecord['book']; ?></td>
                            </tr>
                            <tr>
                                <td>Line No:</td>
                                <td><?php echo $deathRecord['line']; ?></td>
                            </tr>
                            <tr>
                                <td>Page No:</td>
                                <td><?php echo $deathRecord['page']; ?></td>
                            </tr>
                            <tr>
                                <td>Name of Deceased:</td>
                                <td><?php echo $deathRecord['name_of_deceased']; ?></td>
                            </tr>
                            <tr>
                                <td>Name of Mother:</td>
                                <td><?php echo $deathRecord['name1']; ?></td>
                            </tr>
                            <tr>
                                <td>Name of Father:</td>
                                <td><?php echo $deathRecord['name2']; ?></td>
                            </tr>
                            <tr>
                                <td>Name of Wife/Husband:</td>
                                <td><?php echo $deathRecord['name3']; ?></td>
                            </tr>
                            <tr>
                                <td>Residence:</td>
                                <td><?php echo $deathRecord['residence']; ?></td>
                            
                            </tr>
                                <td>Date of Death:</td>
                                <td><?php echo $deathRecord['date_of_death']; ?></td>
                            </tr>
                            <tr>
                                <td>Date of Burial:</td>
                                <td><?php echo $deathRecord['date_of_burial']; ?></td>
                            </tr>
                            <tr>
                                <td>Age:</td>
                                <td><?php echo $deathRecord['age']; ?></td>
                            </tr>
                            <tr>
                                <td>Place of Burial:</td>
                                <td><?php echo $deathRecord['place_of_burial']; ?></td>
                            </tr>
                            <tr>
                                <td>Sacraments:</td>
                                <td><?php echo $deathRecord['sacraments']; ?></td>
                            </tr>
                            <tr>
                                <td>Name of Priest:</td>
                                <td><?php echo $deathRecord['name_of_priest']; ?></td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td><?php echo $deathRecord['status']; ?></td>
                            </tr>
                            <!-- Add more fields as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

                                        <script>
                                            function generatePDF(memberId) {
    // Pass the member's ID to the PDF generation script
    window.open('generate_pdf.php?id=' + memberId, '_blank');
}

                                        </script>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          
<?php
if (isset($_POST['addMembers'])) {
    // Establish a database connection
    $conn = new mysqli("localhost", "root", "", "stoninodb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $record_no = $_POST['record_no'];
    $name = $_POST['name'];
    $date_of_birth = $_POST['date_of_birth'];
    $place_of_birth = $_POST['place_of_birth'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $gender = $_POST['gender'];
    $present_address = $_POST['present_address'];
    $minister_name = $_POST['minister_name'];
    $church_name = $_POST['church_name'];
    $date_of_baptism = $_POST['date_of_baptism'];
    $place_of_baptism = $_POST['place_of_baptism'];

    // Add the necessary validation and sanitation steps here

    // Add all the columns in your SQL query
    $sql = "INSERT INTO baptism (record_no, name, date_of_birth, gender, place_of_birth, father_name, mother_name, present_address, minister_name, church_name, date_of_baptism, place_of_baptism) VALUES ('$record_no', '$name', '$date_of_birth', '$gender', '$place_of_birth', '$father_name', '$mother_name', '$present_address', '$minister_name', '$church_name', '$date_of_baptism', '$place_of_baptism')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New child record added successfully.'); window.location.href='baptism.php';</script>";
    } else {
        echo "<script>alert('Error adding new child record: " . $conn->error . "'); window.location.href='baptism.php';</script>";
    }

    // Close the database connection
    $conn->close();
}
?>



</body>

<script>
document.getElementById("searchInput").addEventListener("input", function() {
    const searchText = this.value.toLowerCase();
    const tableRows = document.querySelectorAll(".table tbody tr");

    // Loop through table rows to show/hide based on search input
    tableRows.forEach(row => {
        const rowData = row.textContent.toLowerCase();
        if (rowData.includes(searchText)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});
</script>

</html>