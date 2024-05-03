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
            function fetchData($conn, $table) {
                $query = "SELECT * FROM conversion"; // Change "baptism" to "death"
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
$conversionData = fetchData($conn, 'conversion'); // Change "baptism" to "death"
?>

        <!-- Main Content -->
        <div class="col-12 col-xl-12">
            <div class="col mt-4">
                <h1 class="mb-4 text-uppercase fw-bolder">Conversion Records</h1>
                <hr>
                <div class="row mb-3">
                    <div class="col">
                        <input class="form-control" type="text" id="search4" placeholder="Search...">
                    </div>
                </div>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#addConversionRecordModal">
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
                                        <th>Name</th>
                                        <th>Father's Name</th>
                                        <th>Mother's Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($conversionData as $conversionRecord) { ?>
                                    <tr>
                                        <td><?php echo $conversionRecord['id']; ?></td>
                                        <td><?php echo $conversionRecord['record_no']; ?></td>
                                        <td><?php echo $conversionRecord['name']; ?></td>
                                        <td><?php echo $conversionRecord['name_of_father']; ?></td>
                                        <td><?php echo $conversionRecord['name_of_mother']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editConversionModal<?php echo $conversionRecord['id']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a href="conversion_information.php?id=<?php echo $conversionRecord['id']; ?>"
                                                class="btn btn-warning"><i class="fas fa-eye"></i></a>
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
    </div>
</div>

<?php foreach ($conversionData as $conversion) { ?>
<div class="modal fade" id="editConversionModal<?= $conversion['id'] ?>" tabindex="-1"
    aria-labelledby="editConversionModalLabel<?= $conversion['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bolder" id="editConversionModalLabel<?= $conversion['id'] ?>">Edit Conversion
                    Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="conversion_edit.php">
                    <input type="hidden" name="conversion_id" value="<?= $conversion['id'] ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="<?= $conversion['name'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_rite" class="form-label">Date of Rite:</label>
                                <input type="date" class="form-control" id="date_of_rite" name="date_of_rite"
                                    value="<?= $conversion['date_of_rite'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth:</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                    value="<?= $conversion['date_of_birth'] ?>" required>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="record_no" class="form-label">Record No:</label>
                                <input type="text" class="form-control" id="record_no" name="record_no"
                                    value="<?= $conversion['record_no'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="place_of_birth" class="form-label">Place of Birth:</label>
                                <input type="text" class="form-control" id="place_of_birth" name="place_of_birth"
                                    value="<?= $conversion['place_of_birth'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="name_of_mother" class="form-label">Name of Mother:</label>
                                <input type="text" class="form-control" id="name_of_mother" name="name_of_mother"
                                    value="<?= $conversion['name_of_mother'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name_of_father" class="form-label">Name of Father:</label>
                        <input type="text" class="form-control" id="name_of_father" name="name_of_father"
                            value="<?= $conversion['name_of_father'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="receiving_minister" class="form-label">Receiving Priest:</label>
                        <input type="text" class="form-control" id="receiving_minister" name="receiving_minister"
                            value="<?= $conversion['receiving_minister'] ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date_of_baptism" class="form-label">Date of Baptism:</label>
                                <input type="date" class="form-control" id="date_of_baptism" name="date_of_baptism"
                                    value="<?= $conversion['date_of_baptism'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="place_of_baptism" class="form-label">Place of Baptism:</label>
                                <input type="text" class="form-control" id="place_of_baptism" name="place_of_baptism"
                                    value="<?= $conversion['place_of_baptism'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="denomination" class="form-label">Denomination:</label>
                        <input type="text" class="form-control" id="denomination" name="denomination"
                            value="<?= $conversion['denomination'] ?>" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="editConversionRecord">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>


<!-- Add Conversion Record Modal -->
<div class="modal fade" id="addConversionRecordModal" tabindex="-1" aria-labelledby="addConversionRecordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bolder" id="addConversionRecordModalLabel">Add Conversion Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_rite" class="form-label">Date of Rite:</label>
                                <input type="date" class="form-control" id="date_of_rite" name="date_of_rite" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth:</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                    required>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="record_no" class="form-label">Record No:</label>
                                <input type="text" class="form-control" id="record_no" name="record_no" required>
                            </div>


                            <div class="mb-3">
                                <label for="place_of_birth" class="form-label">Place of Birth:</label>
                                <input type="text" class="form-control" id="place_of_birth" name="place_of_birth"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="name_of_mother" class="form-label">Name of Mother:</label>
                                <input type="text" class="form-control" id="name_of_mother" name="name_of_mother"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name_of_father" class="form-label">Name of Father:</label>
                        <input type="text" class="form-control" id="name_of_father" name="name_of_father" required>
                    </div>
                    <div class="mb-3">
                        <label for="receiving_minister" class="form-label">Receiving Priest:</label>
                        <input type="text" class="form-control" id="receiving_minister" name="receiving_minister"
                            required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date_of_baptism" class="form-label">Date of Baptism:</label>
                                <input type="date" class="form-control" id="date_of_baptism" name="date_of_baptism"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="place_of_baptism" class="form-label">Place of Baptism:</label>
                                <input type="text" class="form-control" id="place_of_baptism" name="place_of_baptism"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="denomination" class="form-label">Denomination:</label>
                        <input type="text" class="form-control" id="denomination" name="denomination" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addConversionRecord">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['addConversionRecord'])) {
    // Establish a database connection
    $conn = new mysqli("localhost", "root", "", "stoninodb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve values from the form
    $record_no = $_POST['record_no'];
    $name = $_POST['name'];
    $date_of_rite = $_POST['date_of_rite'];
    $place_of_reception = $_POST['place_of_reception'];
    $date_of_birth = $_POST['date_of_birth'];
    $place_of_birth = $_POST['place_of_birth'];
    $name_of_father = $_POST['name_of_father'];
    $name_of_mother = $_POST['name_of_mother'];
    $receiving_minister = $_POST['receiving_minister'];
    $date_of_baptism = $_POST['date_of_baptism'];
    $place_of_baptism = $_POST['place_of_baptism'];
    $denomination = $_POST['denomination'];

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO conversion (record_no, name, date_of_rite, place_of_reception, date_of_birth, place_of_birth, name_of_father, name_of_mother, receiving_minister, date_of_baptism, place_of_baptism, denomination) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Preparation failed: " . $conn->error);
    }

    $stmt->bind_param("ssssssssssss", $record_no, $name, $date_of_rite, $place_of_reception, $date_of_birth, $place_of_birth, $name_of_father, $name_of_mother, $receiving_minister, $date_of_baptism, $place_of_baptism, $denomination);

    if ($stmt->execute()) {
        echo "<script>alert('New conversion record added successfully.'); window.location.href='conversion.php';</script>";
    } else {
        echo "<script>alert('Error adding new conversion record: " . $conn->error . "'); window.location.href='conversion.php';</script>";
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
}

?>


</body>
<!-- Include the necessary JavaScript file -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="js/jquery.min.js"></script>
<script src="js/datatables-simple.js"></script>


<script>
$(document).ready(function() {
    $('#search4').on('keyup', function() {
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