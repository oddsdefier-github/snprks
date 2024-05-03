<?php
session_start();
$title = "dashboard";

include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/scripts.php';


?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <?php include('header_nav.php');?>
    <!-- Main Content -->
    <div id="content">
        <?php
        function fetchData($conn, $table)
        {
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
        <!-- Topbar Search -->


        <!-- Main Content -->

        <div class="col-12 col-xl-12">
            <div class="col mt-4">
                <h1 class="mb-2 text-uppercase fw-bolder">Baptism Records</h1>
                <hr>
                <div class="row mb-3">
                    <div class="col">
                        <input class="form-control" type="text" id="search" placeholder="Search...">
                    </div>
                </div>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#addMemberModal">
                    Add New
                </button>

                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table style="background-color: white;" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Record No.</th>
                                        <th>Name of Child</th>
                                        <th>Date of Birth</th>
                                        <th>Father's Name</th>
                                        <th>Mother's Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($baptismData as $baptismRecord) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $baptismRecord['id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $baptismRecord['record_no']; ?>
                                        </td>
                                        <td>
                                            <?php echo $baptismRecord['name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $baptismRecord['date_of_birth']; ?>
                                        </td>
                                        <td>
                                            <?php echo $baptismRecord['father_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $baptismRecord['mother_name']; ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editBaptismModal<?php echo $baptismRecord['id']; ?>">
                                                <i class="fas fa-edit"></i></button>
                                            <a href="baptism_info.php?id=<?php echo $baptismRecord['id']; ?>"
                                                class="btn btn-warning">
                                                <i class="fas fa-eye"></i></a></a>
                                            <a href='form/baptism_cert.php?id=<?= htmlspecialchars($baptismRecord["id"]) ?>'
                                                class='btn btn-secondary' target='_blank'>
                                                <i class='fas fa-print'></i>
                                            </a>
                                            </button>

                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // Close the database connection
        $conn->close();
        ?>

        <script>
        function generatePDF(memberId) {
            // Pass the member's ID to the PDF generation script
            window.open('baptism_pdf.php?id=' + memberId, '_blank');
        }
        </script>


        </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>

<?php foreach ($baptismData as $baptism) { ?>
<div class="modal fade" id="editBaptismModal<?= $baptism['id'] ?>" tabindex="-1"
    aria-labelledby="editBaptismModalLabel<?= $baptism['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bolder" id="editBaptismModalLabel<?= $baptism['id'] ?>">Edit Baptism</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="baptism_edit.php">
                    <input type="hidden" name="baptism_id" value="<?= $baptism['id'] ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="record_no" class="form-label">Record No:</label>
                                <input type="text" class="form-control" id="record_no" name="record_no"
                                    value="<?= $baptism['record_no'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth:</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                    value="<?= $baptism['date_of_birth'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="father_name" class="form-label">Father's Name:</label>
                                <input type="text" class="form-control" id="father_name" name="father_name"
                                    value="<?= $baptism['father_name'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="rev" class="form-label">Rev.:</label>
                                <input type="text" class="form-control" id="rev" name="rev"
                                    value="<?= $baptism['rev'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="book" class="form-label">Book no.:</label>
                                <input type="text" class="form-control" id="book" name="book"
                                    value="<?= $baptism['book'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="church" class="form-label">Church Name:</label>
                                <input type="text" class="form-control" id="church" name="church_name"
                                    value="<?= $baptism['church_name'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name of Child:</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="<?= $baptism['name'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender:</label>
                                <select class="form-select" id="gender" name="gender" value="<?= $baptism['gender'] ?>"
                                    required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="mother_name" class="form-label">Mother's Name:</label>
                                <input type="text" class="form-control" id="mother_name" name="mother_name"
                                    value="<?= $baptism['mother_name'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="page" class="form-label">Page:</label>
                                <input type="text" class="form-control" id="page" name="page"
                                    value="<?= $baptism['page'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="cath" class="form-label">Catholic Church Dated:</label>
                                <input type="date" class="form-control" id="date_cath" name="cath"
                                    value="<?= $baptism['cath'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="line" class="form-label">Line:</label>
                                <input type="text" class="form-control" id="line" name="line"
                                    value="<?= $baptism['line'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="minister_name" class="form-label">Name of Priest:</label>
                        <input type="text" class="form-control" id="minister_name" name="minister_name"
                            value="<?= $baptism['minister_name'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="spo" class="form-label">Sponsors:</label>
                        <input type="text" class="form-control" id="spo" name="spo" value="<?= $baptism['spo'] ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="spouse" class="form-label">Spouse(Optional):</label>
                        <input type="text" class="form-control" id="spouse" name="spouse"
                            value="<?= $baptism['spouse'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="place_of_birth" class="form-label">Place of Birth:</label>
                        <input type="text" class="form-control" id="place_of_birth" name="place_of_birth"
                            value="<?= $baptism['place_of_birth'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="present_address" class="form-label">Present Address:</label>
                        <input type="text" class="form-control" id="present_address" name="present_address"
                            value="<?= $baptism['present_address'] ?>" srequired>
                    </div>
                    <div class="mb-3">
                        <label for="date_of_baptism" class="form-label">Date of Baptism:</label>
                        <input type="date" class="form-control" id="date_of_baptism" name="date_of_baptism"
                            value="<?= $baptism['date_of_baptism'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="place_of_baptism" class="form-label">Place of Baptism:</label>
                        <input type="text" class="form-control" id="place_of_baptism" name="place_of_baptism"
                            value="<?= $baptism['place_of_baptism'] ?>" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="editBaptism">Save Changes</button>

            </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>


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
    $spouse = isset($_POST['spouse']) ? $_POST['spouse'] : '';
    $line = $_POST['line'];
    $rev = $_POST['rev'];
    $spo = $_POST['spo'];
    $book = $_POST['book'];
    $cath = $_POST['cath'];
    $page = $_POST['page'];

    $sql = "INSERT INTO baptism (record_no, name, date_of_birth, gender, place_of_birth, father_name, mother_name, present_address, minister_name, church_name, date_of_baptism, place_of_baptism, page, cath, book, rev, spo, line) VALUES 
    ('$record_no', '$name', '$date_of_birth', '$gender', '$place_of_birth', '$father_name', '$mother_name', '$present_address', '$minister_name', '$church_name', '$date_of_baptism', '$place_of_baptism', '$page', '$cath', '$book', '$rev', '$spo', '$line')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New child record added successfully.'); window.location.href='baptism.php';</script>";
    } else {
        echo "<script>alert('Error adding new child record: " . $conn->error . "'); window.location.href='baptism.php';</script>";
    }


    $conn->close();
}
?>

<!-- Add Result Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bolder" id="addMemberModalLabel">Add Baptism Record </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="baptism.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="record_no" class="form-label">Record No:</label>
                                <input type="text" class="form-control" id="record_no" name="record_no" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth:</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="father_name" class="form-label">Father's Name:</label>
                                <input type="text" class="form-control" id="father_name" name="father_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="rev" class="form-label">Rev.:</label>
                                <input type="text" class="form-control" id="rev" name="rev" required>
                            </div>
                            <div class="mb-3">
                                <label for="book" class="form-label">Book no.:</label>
                                <input type="text" class="form-control" id="book" name="book" required>
                            </div>
                            <div class="mb-3">
                                <label for="church" class="form-label">Church Name:</label>
                                <input type="text" class="form-control" id="church" name="church_name" required>
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
                            <div class="mb-3">
                                <label for="page" class="form-label">Page:</label>
                                <input type="text" class="form-control" id="page" name="page" required>
                            </div>
                            <div class="mb-3">
                                <label for="cath" class="form-label">Catholic Church Dated:</label>
                                <input type="date" class="form-control" id="date_cath" name="cath" required>
                            </div>
                            <div class="mb-3">
                                <label for="line" class="form-label">Line:</label>
                                <input type="text" class="form-control" id="line" name="line" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="minister_name" class="form-label">Name of Priest:</label>
                        <input type="text" class="form-control" id="minister_name" name="minister_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="spo" class="form-label">Sponsors:</label>
                        <input type="text" class="form-control" id="spo" name="spo" required>
                    </div>
                    <div class="mb-3">
                        <label for="minister_name" class="form-label">Spouse(Optional):</label>
                        <input type="text" class="form-control" id="minister_name" name="spouse">
                    </div>
                    <div class="mb-3">
                        <label for="place_of_birth" class="form-label">Place of Birth:</label>
                        <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" required>
                    </div>
                    <div class="mb-3">
                        <label for="present_address" class="form-label">Present Address:</label>
                        <input class="form-control" id="present_address" name="present_address" required>
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





<!-- Include the necessary JavaScript file -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="js/jquery.min.js"></script>
<script src="js/datatables-simple.js"></script>


<script>
$(document).ready(function() {
    $('#search').on('keyup', function() {
        var searchText = $(this).val().toLowerCase();
        $('table tbody tr').each(function() {
            var rowText = $(this).text().toLowerCase();
            if (rowText.indexOf(searchText) === -1) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    });
});
</script>

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
</body>

</html>