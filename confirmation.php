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
            $query = "SELECT * FROM $table"; // Use the provided table name
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

        // Fetch communion data using the fetchData function
        $communionData = fetchData($conn, 'communion'); // Use 'communion' as the table name
        
        ?>

        <!-- Main Content -->
        <div class="col-12 col-xl-12">
            <div class="col mt-4">
                <h1 class="mb-4 text-uppercase fw-bolder">Confirmation Records</h1>
                <hr>
                <div class="row mb-3">
                    <div class="col">
                        <input class="form-control" type="text" id="searchInput" placeholder="Search...">
                    </div>
                </div>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#addCommunionRecordModal">

                    Add New
                </button>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table id="datatablesSimple" style="background-color: white;" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Record No.</th>
                                        <th>Father Name</th>
                                        <th>Mother Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($communionData as $communionRecord) { ?>

                                    <tr>
                                        <td>
                                            <?php echo $communionRecord['id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $communionRecord['record_no']; ?>
                                        </td>
                                        <td>
                                            <?php echo $communionRecord['father_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $communionRecord['mother_name']; ?>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editCommunionModal<?php echo $communionRecord['id']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            </a>
                                            <a href="confirmation_info.php?id=<?php echo $communionRecord['id']; ?>"
                                                class="btn btn-warning">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-secondary"
                                                onclick="window.open('form/confirmation_cert.php?id=<?php echo $communionRecord['id']; ?>', '_blank');">
                                                <i class="fas fa-print"></i>
                                            </button>

                                            <script>
                                            // Enable tooltips using JavaScript (assuming you are using Bootstrap)
                                            $(document).ready(function() {
                                                $('[data-toggle="tooltip"]').tooltip();
                                            });
                                            </script>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
                window.open('generate_pdf.php?id=' + memberId, '_blank');
            }
            </script>
            </tbody>
            </table>
        </div>
    </div>
</div>


<?php foreach ($communionData as $communion) { ?>
<div class="modal fade" id="editCommunionModal<?= $communion['id'] ?>" tabindex="-1"
    aria-labelledby="editCommunionModalLabel<?= $communion['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bolder" id="editCommunionModalLabel<?= $communion['id'] ?>">Edit Confirmation
                    Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="confirmation_edit.php">
                    <input type="hidden" name="communion_id" value="<?= $communion['id'] ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="record_no" class="form-label">Record No:</label>
                                <input type="text" class="form-control" id="record_no" name="record_no"
                                    value="<?= $communion['record_no'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="father_name" class="form-label">Father Name:</label>
                                <input type="text" class="form-control" id="father_name" name="father_name"
                                    value="<?= $communion['father_name'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_baptism" class="form-label">Date of Baptism:</label>
                                <input type="date" class="form-control" id="date_of_baptism" name="date_of_baptism"
                                    value="<?= $communion['date_of_baptism'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="spo" class="form-label">Sponsos:</label>
                                <input type="text" class="form-control" id="spo" name="spo"
                                    value="<?= $communion['spo'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="page" class="form-label">Page:</label>
                                <input type="text" class="form-control" id="page" name="page"
                                    value="<?= $communion['page'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="book" class="form-label">Book:</label>
                                <input type="text" class="form-control" id="book" name="book"
                                    value="<?= $communion['book'] ?>" required>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="child_name" class="form-label">Child Name:</label>
                                <input type="text" class="form-control" id="child_name" name="child_name"
                                    value="<?= $communion['child_name'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="mother_name" class="form-label">Mother Name:</label>
                                <input type="text" class="form-control" id="mother_name" name="mother_name"
                                    value="<?= $communion['mother_name'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_communion" class="form-label">Date of Confirmation:</label>
                                <input type="date" class="form-control" id="date_of_communion" name="date_of_communion"
                                    value="<?= $communion['date_of_communion'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="rev" class="form-label">Most Rev:</label>
                                <input type="text" class="form-control" id="rev" name="rev"
                                    value="<?= $communion['rev'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="line" class="form-label">Line:</label>
                                <input type="text" class="form-control" id="line" name="line"
                                    value="<?= $communion['line'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="church" class="form-label">Church Dated:</label>
                                <input type="date" class="form-control" id="church" name="church"
                                    value="<?= $communion['church'] ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="place_of_baptism" class="form-label">Place of Baptism:</label>
                            <input type="text" class="form-control" id="place_of_baptism" name="place_of_baptism"
                                value="<?= $communion['place_of_baptism'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="place_of_baptism" class="form-label">Place of Communion:</label>
                            <input type="text" class="form-control" id="place_of_baptism" name="place_of_communion"
                                value="<?= $communion['place_of_communion'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="minister_name" class="form-label">Minister Name:</label>
                            <input type="text" class="form-control" id="minister_name" name="minister_name"
                                value="<?= $communion['minister_name'] ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="editCommunionRecord">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>




<!-- Add Communion Record Modal -->
<div class="modal fade" id="addCommunionRecordModal" tabindex="-1" aria-labelledby="addCommunionRecordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bolder" id="addCommunionRecordModalLabel">Add Confirmation Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="record_no" class="form-label">Record No:</label>
                                <input type="text" class="form-control" id="record_no" name="record_no" required>
                            </div>
                            <div class="mb-3">
                                <label for="father_name" class="form-label">Father Name:</label>
                                <input type="text" class="form-control" id="father_name" name="father_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_baptism" class="form-label">Date of Baptism:</label>
                                <input type="date" class="form-control" id="date_of_baptism" name="date_of_baptism"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="spo" class="form-label">Sponsos:</label>
                                <input type="text" class="form-control" id="spo" name="spo" required>
                            </div>
                            <div class="mb-3">
                                <label for="page" class="form-label">Page:</label>
                                <input type="text" class="form-control" id="page" name="page" required>
                            </div>
                            <div class="mb-3">
                                <label for="book" class="form-label">Book:</label>
                                <input type="text" class="form-control" id="book" name="book" required>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="child_name" class="form-label">Child Name:</label>
                                <input type="text" class="form-control" id="child_name" name="child_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="mother_name" class="form-label">Mother Name:</label>
                                <input type="text" class="form-control" id="mother_name" name="mother_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_communion" class="form-label">Date of Confirmation:</label>
                                <input type="date" class="form-control" id="date_of_communion" name="date_of_communion"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="rev" class="form-label">Most Rev:</label>
                                <input type="text" class="form-control" id="rev" name="rev" required>
                            </div>
                            <div class="mb-3">
                                <label for="line" class="form-label">Line:</label>
                                <input type="text" class="form-control" id="line" name="line" required>
                            </div>
                            <div class="mb-3">
                                <label for="church" class="form-label">Church Dated:</label>
                                <input type="date" class="form-control" id="church" name="church" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="place_of_baptism" class="form-label">Place of Baptism:</label>
                            <input type="text" class="form-control" id="place_of_baptism" name="place_of_baptism"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="place_of_baptism" class="form-label">Place of Communion:</label>
                            <input type="text" class="form-control" id="place_of_baptism" name="place_of_communion"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="minister_name" class="form-label">Minister Name:</label>
                            <input type="text" class="form-control" id="minister_name" name="minister_name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addCommunionRecord">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['addCommunionRecord'])) {
    // Establish a database connection
    $conn = new mysqli("localhost", "root", "", "stoninodb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind parameters to prevent SQL injection
    $sql = "INSERT INTO communion (record_no, child_name, date_of_baptism, place_of_baptism, father_name, mother_name, date_of_communion, place_of_communion, minister_name, rev, line, book, spo, church, page) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Preparation failed: " . $conn->error);
    }

    $stmt->bind_param("sssssssssssssss", $record_no, $child_name, $date_of_baptism, $place_of_baptism, $father_name, $mother_name, $date_of_communion, $place_of_communion, $minister_name, $rev, $line, $book, $spo, $church, $page);

    // Assign POST values
    $record_no = $_POST['record_no'];
    $child_name = $_POST['child_name'];
    $date_of_baptism = $_POST['date_of_baptism'];
    $place_of_baptism = $_POST['place_of_baptism'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $date_of_communion = $_POST['date_of_communion'];
    $place_of_communion = $_POST['place_of_communion'];
    $minister_name = $_POST['minister_name'];
    $rev = $_POST['rev'];
    $spo = $_POST['spo'];
    $page = $_POST['page'];
    $line = $_POST['line'];
    $book = $_POST['book'];
    $church = $_POST['church'];

    // Execute query
    if ($stmt->execute()) {
        echo "<script>alert('New communion record added successfully.'); window.location.href='confirmation.php';</script>";
    } else {
        echo "<script>alert('Error adding new communion record: " . $conn->error . "'); window.location.href='confirmation.php';</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!-- Include the necessary JavaScript file -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/datatables-simple.js"></script>
<script>
$(document).ready(function() {
    $('#datatablesSimple').DataTable();
});
</script>

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