<?php
    session_start();
    $title = "dashboard";
    include 'includes/header.php';
    include 'includes/navbar.php';
    include 'includes/scripts.php';


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

        <!-- Topbar Search Display Only-->
        <input class="form-control" type="text" placeholder="                                                                                  
        Sto. Niño Parish Record-Keeping Information System" aria-label="Disabled input example" disabled readonly>
            

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
                    <span class="mr-2 d-none d-lg-inline text-gray-600 large">Mary Rose</span>
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

<?php
function fetchData($conn, $table) {
    $query = "SELECT * FROM baptism"; // Make sure the table name matches the one in your database
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

// Fetch baptism data using the fetchData function
$baptismData = fetchData($conn, 'Baptism');
?>

<!-- Main Content -->
<div class="col-12 col-xl-12">
    <div class="col mt-4">
        <h1 class="mb-2 text-uppercase fw-bolder">Sacraments</h1>
        <hr>


        

          <!-- Add Result Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bolder" id="addMemberModalLabel">Add Baptism Record </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="record_no" class="form-label">Record No:</label>
                                <input type="text" class="form-control" id="record_no" name="record_no" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth:</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                            </div>
                            <div class="mb-3">
                                <label for="father_name" class="form-label">Father's Name:</label>
                                <input type="text" class="form-control" id="father_name" name="father_name" required>
                            </div>
                           
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name of Child:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender:</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="mother_name" class="form-label">Mother's Name:</label>
                                <input type="text" class="form-control" id="mother_name" name="mother_name" required>
                            </div>
                            
                        </div>
                    </div>
                    <div class="mb-3">
                                <label for="minister_name" class="form-label">Name of Priest:</label>
                                <input type="text" class="form-control" id="minister_name" name="priest" required>
                            </div>
                    <div class="mb-3">
                                <label for="minister_name" class="form-label">Spouse:</label>
                                <input type="text" class="form-control" id="minister_name" name="spouse" required>
                            </div>
                    <div class="mb-3">
                        <label for="place_of_birth" class="form-label">Place of Birth:</label>
                        <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" required>
                    </div>
                    <div class="mb-3">
                        <label for="present_address" class="form-label">Present Address:</label>
                        <textarea class="form-control" id="present_address" name="present_address"  required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="date_of_baptism" class="form-label">Date of Baptism:</label>
                        <input type="date" class="form-control" id="date_of_baptism" name="date_of_baptism" required>
                    </div>
                    <div class="mb-3">
                        <label for="place_of_baptism" class="form-label">Place of Baptism:</label>
                        <input type="text" class="form-control" id="place_of_baptism" name="place_of_baptism" required>
                    </div>
                </div>
                <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="addMembers">Submit</button>
    </div>
                </form>
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
    $spouse = $_POST['spouse'];
    $name_of_priest = $_POST['priest'];

    // Add the necessary validation and sanitation steps here

    // Add all the columns in your SQL query
    $sql = "INSERT INTO baptism (record_no, name, date_of_birth, gender, place_of_birth, father_name, mother_name, present_address, minister_name, church_name, date_of_baptism, place_of_baptism) VALUES 
    ('$record_no', '$name', '$date_of_birth', '$gender', '$place_of_birth', '$father_name', '$mother_name', '$present_address', '$minister_name', '$church_name', '$date_of_baptism', '$place_of_baptism, '$spouse, '$priest')";

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
<!-- Include the necessary JavaScript file -->

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

      


<!-- End of Sidebar -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="login.html">Logout</a>
    </div>
</div>
</div>
</div>

<?php

