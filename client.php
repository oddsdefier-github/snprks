<?php
    session_start();
    $title = "dashboard";
    
    include 'includes/header.php';
    include 'includes/navbar.php';
    include 'includes/scripts.php';


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


    // Fetch member data using the fetchData function
    $membersData = fetchData($conn, 'members');
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Topbar Search Display Only-->
        <input class="form-control" type="text" placeholder="                                                                                  
        Sto. Niño Parish Record-Keeping Information System" aria-label="Disabled input example" disabled readonly>
                
            
        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
            

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

<!-- Main Content -->

        <div class="col-12 col-xl-12">
            <div class="col mt-4">
                <h1 class="mb-4 text-uppercase fw-bolder">Client Information History</h1>
                <hr>
        <div class="container mt-4">
            <div class="form-group mb-10">
                <label for="searchMfbrNo">Search Client Record:</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="searchMfbrNo" placeholder="Enter Client No. (e.g., Client-00-0000)">
                    <div class="input-group-append">
                        <button id="searchButton" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
            <div class="card fisherman-card" style="display: none;">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="noRecordsMessage" class="alert alert-warning">No data recorded</div>
                                <table class="table table-bordered table-striped fisherman-table">
                                    <thead>
                                    <tr>
                                            <th>ID</th>
                                            <th>Full Name</th>
                                            <th>Age</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Certification</th>
                                            <th>Timestamp</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($membersData as $member) { ?>
                                        <tr>
                                            <td><?php echo $member['id']; ?></td>
                                            <td><?php echo $member['fullname']; ?></td>
                                            <td><?php echo $member['age']; ?></td>
                                            <td><?php echo $member['phone']; ?></td>
                                            <td><?php echo $member['address']; ?></td>
                                            <td>
                                                <?php
                                                    $certificationPath = $member['certification'];
                                                    if (file_exists($certificationPath)) {
                                                ?>
                                                <img src="<?= $certificationPath; ?>" alt="Certification Image"
                                                    class="img-fluid" width="100" height="100">
                                                <br>
                                                <a href="<?= $certificationPath; ?>"
                                                    download><?= $member['certification']; ?></a>
                                                <?php } else { ?>
                                                Certification not found
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $member['timestamp']; ?></td>
                                            <td>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editMemberModal<?php echo $member['id']; ?>">
    <i class="fas fa-edit"></i>
    </button>
    <a href="info_delete.php?id=<?php echo $member['id']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>

    <button type="button" class="btn btn-secondary" onclick="generatePDF(<?php echo $member['id']; ?>)">
        
<i class="fas fa-print"></i>
    </button>
</td>


                                        </tr>
                                        <?php } ?>
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
                            <!-- Display the total amount -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<!-- Include the necessary JavaScript file -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Datepickers
    $('#startDate').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        clearBtn: true,
        todayHighlight: true
    });

    $('#endDate').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        clearBtn: true,
        todayHighlight: true
    });

    // Apply date filter
    $('#applyFilter').click(function() {
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        $.ajax({
            url: 'fetch_data.php', // Replace with your PHP script for fetching filtered data
            method: 'POST',
            data: {
                startDate: startDate,
                endDate: endDate
            },
            success: function(response) {
                // Update the table with filtered data
                $('#paymentTableBody').html(response);
            }
        });
    });
});
$(document).ready(function() {
        $(".fisherman-card").hide();
        $("#noRecordsMessage").hide();

        $("#searchButton").on("click", function() {
            var value = $("#searchMfbrNo").val().toLowerCase();
            var table = $(".fisherman-table");

            table.find("tr").hide();

            var visibleRows = table.find("tr").filter(function() {
                return $(this).text().toLowerCase().indexOf(value) > -1;
            });

            if (visibleRows.length === 0) {
                $("#noRecordsMessage").show();
            } else {
                $("#noRecordsMessage").hide();
            }
            visibleRows.show();
            $(".fisherman-card").show();
        });
    });
    
</script>

</html>