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
            $query = "SELECT * FROM death"; // Change "baptism" to "death"
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
        $deathData = fetchData($conn, 'death'); // Change "baptism" to "death"
        ?>

        <!-- Main Content -->
        <div class="col-12 col-xl-12">
            <div class="col mt-4">
                <h1 class="mb-4 text-uppercase fw-bolder">Death Records</h1>
                <hr>
                <div class="row mb-3">
                    <div class="col">
                        <input class="form-control" type="text" id="search2" placeholder="Search...">
                    </div>
                </div>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#addDeathRecordModal">
                    Add Death Record
                </button>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table style="background-color: white;" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Record No.</th>
                                        <th>Name of Deceased</th>
                                        <th>Name of Parents, Wife, or husband</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($deathData as $deathRecord) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $deathRecord['id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $deathRecord['record_no']; ?>
                                        </td>
                                        <td>
                                            <?php echo $deathRecord['name_of_deceased']; ?>
                                        </td>
                                        <td>
                                            <?php echo $deathRecord['name1']; ?>- <?php echo $deathRecord['name2']; ?>-
                                            <?php echo $deathRecord['name3']; ?>
                                        </td>
                                        <td>
                                            <?php echo $deathRecord['status']; ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editDeathModal<?php echo $deathRecord['id']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a href="death_info.php?id=<?php echo $deathRecord['id']; ?>"
                                                class="btn btn-warning">
                                                <i class="fas fa-eye"></i></a>
                                            <button type="button" class="btn btn-secondary"
                                                onclick="window.open('form/death_cert.php?id=<?php echo $deathRecord['id']; ?>', '_blank');">
                                                <i class="fas fa-print"></i>
                                            </button>

                                            <script>
                                            // Enable tooltips using JavaScript (assuming you are using Bootstrap)
                                            $(document).ready(function() {
                                                $('[data-bs-toggle="tooltip"]').tooltip();
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
</div>
</div>

<?php foreach ($deathData as $death) { ?>
<div class="modal fade" id="editDeathModal<?= $death['id'] ?>" tabindex="-1"
    aria-labelledby="editDeathModalLabel<?= $death['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bolder" id="editDeathModalLabel<?= $death['id'] ?>">Edit Death Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="death_edit.php">
                    <input type="hidden" name="death_id" value="<?= $death['id'] ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="record_no" class="form-label">Record No:</label>
                                <input type="text" class="form-control" id="record_no" name="record_no"
                                    value="<?= $death['record_no'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="barrio" class="form-label">Barrio:</label>
                                <input type="text" class="form-control" id="barrio" name="barrio"
                                    value="<?= $death['barrio'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="book" class="form-label">Book No:</label>
                                <input type="text" class="form-control" id="book" name="book"
                                    value="<?= $death['book'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="page" class="form-label">Page No:</label>
                                <input type="text" class="form-control" id="page" name="page"
                                    value="<?= $death['page'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="name_of_deceased" class="form-label">Name of Deceased:</label>
                                <input type="text" class="form-control" id="name_of_deceased" name="name_of_deceased"
                                    value="<?= $death['name_of_deceased'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="death" class="form-label">Cause of Death:</label>
                                <input type="text" class="form-control" id="death" name="death"
                                    value="<?= $death['death'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="spouse" class="form-label">Spouse:</label>
                                <input type="text" class="form-control" id="spouse" name="spouse"
                                    value="<?= $death['spouse'] ?>" required>
                            </div>
                        </div>
                        <!-- Right column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="line" class="form-label">Line No:</label>
                                <input type="text" class="form-control" id="line" name="line"
                                    value="<?= $death['line'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="residence" class="form-label">Residence:</label>
                                <input type="text" class="form-control" id="residence" name="residence"
                                    value="<?= $death['residence'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="municipal" class="form-label">Municipal:</label>
                                <input type="text" class="form-control" id="municipal" name="municipal"
                                    value="<?= $death['municipal'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="province" class="form-label">Province:</label>
                                <input type="text" class="form-control" id="province" name="province"
                                    value="<?= $death['province'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="name_of_parents" class="form-label">Name of Mother:</label>
                                <input type="text" class="form-control" id="name_of_parents" name="name1"
                                    value="<?= $death['name1'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="name_of_parents" class="form-label">Name of Father:</label>
                                <input type="text" class="form-control" id="name_of_parents" name="name2"
                                    value="<?= $death['name2'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="age" class="form-label">Age:</label>
                                <input type="text" class="form-control" id="age" name="age" value="<?= $death['age'] ?>"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date_of_death" class="form-label">Date of Death:</label>
                                <input type="date" class="form-control" id="date_of_death" name="date_of_death"
                                    value="<?= $death['date_of_death'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date_of_burial" class="form-label">Date of Burial:</label>
                                <input type="date" class="form-control" id="date_of_burial" name="date_of_burial"
                                    value="<?= $death['date_of_burial'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status:</label>
                        <select class="form-select" id="status" name="status" required>
                            <option <?php echo ($death == 'Single') ? 'selected' : ''; ?>>Single</option>
                            <option <?php echo ($death == 'Married') ? 'selected' : ''; ?>>Married</option>
                            <option <?php echo ($death == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name3" class="form-label">Name of Wife/Husband for Widowed Only:</label>
                        <input type="text" class="form-control" id="name3" name="name3" value="<?= $death['name3'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="place_of_burial" class="form-label">Place of Burial:</label>
                        <input type="text" class="form-control" id="place_of_burial" name="place_of_burial"
                            value="<?= $death['place_of_burial'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="sacraments" class="form-label">Sacraments:</label>
                        <input type="text" class="form-control" id="sacraments" name="sacraments"
                            value="<?= $death['sacraments'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="name_of_priest" class="form-label">Name of Priest:</label>
                        <input type="text" class="form-control" id="name_of_priest" name="name_of_priest"
                            value="<?= $death['name_of_priest'] ?>" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="editDeathRecord">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>



<!-- Add Death Record Modal -->
<div class="modal fade" id="addDeathRecordModal" tabindex="-1" aria-labelledby="addDeathRecordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bolder" id="addDeathRecordModalLabel">Add New</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="row">
                        <!-- Left column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="record_no" class="form-label">Record No:</label>
                                <input type="text" class="form-control" id="record_no" name="record_no" required>
                            </div>
                            <div class="mb-3">
                                <label for="barrio" class="form-label">Barrio:</label>
                                <input type="text" class="form-control" id="barrio" name="barrio" required>
                            </div>
                            <div class="mb-3">
                                <label for="book" class="form-label">Book No:</label>
                                <input type="text" class="form-control" id="book" name="book" required>
                            </div>
                            <div class="mb-3">
                                <label for="page" class="form-label">Page No:</label>
                                <input type="text" class="form-control" id="page" name="page" required>
                            </div>
                            <div class="mb-3">
                                <label for="name_of_deceased" class="form-label">Name of Deceased:</label>
                                <input type="text" class="form-control" id="name_of_deceased" name="name_of_deceased"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="death" class="form-label">Cause of Death:</label>
                                <input type="text" class="form-control" id="death" name="death" required>
                            </div>
                            <div class="mb-3">
                                <label for="spouse" class="form-label">Spouse:</label>
                                <input type="text" class="form-control" id="spouse" name="spouse" required>
                            </div>
                        </div>
                        <!-- Right column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="line" class="form-label">Line No:</label>
                                <input type="text" class="form-control" id="line" name="line" required>
                            </div>
                            <div class="mb-3">
                                <label for="residence" class="form-label">Residence:</label>
                                <input type="text" class="form-control" id="residence" name="residence" required>
                            </div>
                            <div class="mb-3">
                                <label for="municipal" class="form-label">Municipal:</label>
                                <input type="text" class="form-control" id="municipal" name="municipal" required>
                            </div>
                            <div class="mb-3">
                                <label for="province" class="form-label">Province:</label>
                                <input type="text" class="form-control" id="province" name="province" required>
                            </div>
                            <div class="mb-3">
                                <label for="name_of_parents" class="form-label">Name of Mother:</label>
                                <input type="text" class="form-control" id="name_of_parents" name="name1" required>
                            </div>
                            <div class="mb-3">
                                <label for="name_of_parents" class="form-label">Name of Father:</label>
                                <input type="text" class="form-control" id="name_of_parents" name="name2" required>
                            </div>
                            <div class="mb-3">
                                <label for="age" class="form-label">Age:</label>
                                <input type="text" class="form-control" id="age" name="age" required>
                            </div>
                        </div>
                    </div>
                    <!-- Date fields -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date_of_death" class="form-label">Date of Death:</label>
                                <input type="date" class="form-control" id="date_of_death" name="date_of_death"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date_of_burial" class="form-label">Date of Burial:</label>
                                <input type="date" class="form-control" id="date_of_burial" name="date_of_burial"
                                    required>
                            </div>
                        </div>
                    </div>
                    <!-- Status and other fields -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status:</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name3" class="form-label">Name of Wife/Husband for Widowed Only:</label>
                        <input type="text" class="form-control" id="name3" value=" " name="name3">
                    </div>
                    <div class="mb-3">
                        <label for="place_of_burial" class="form-label">Place of Burial:</label>
                        <input type="text" class="form-control" id="place_of_burial" name="place_of_burial" required>
                    </div>
                    <div class="mb-3">
                        <label for="sacraments" class="form-label">Sacraments:</label>
                        <input type="text" class="form-control" id="sacraments" name="sacraments" required>
                    </div>
                    <div class="mb-3">
                        <label for="name_of_priest" class="form-label">Name of Priest:</label>
                        <input type="text" class="form-control" id="name_of_priest" name="name_of_priest" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addDeathRecord">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['addDeathRecord'])) {
    // Establish a database connection
    $conn = new mysqli("localhost", "root", "", "stoninodb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement
    $sql = "INSERT INTO death (record_no, name_of_deceased,  residence, date_of_death, date_of_burial, age, place_of_burial, sacraments, name_of_priest, province, spouse, municipal, death, status, book, line, page, name1, name2, name3, barrio) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Preparation failed: " . $conn->error);
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("sssssssssssssssssssss", $_POST['record_no'], $_POST['name_of_deceased'],  $_POST['residence'], $_POST['date_of_death'], $_POST['date_of_burial'], $_POST['age'], $_POST['place_of_burial'], $_POST['sacraments'], $_POST['name_of_priest'], $_POST['province'], $_POST['spouse'], $_POST['municipal'], $_POST['death'], $_POST['status'], $_POST['book'], $_POST['line'], $_POST['page'], $_POST['name1'], $_POST['name2'], $_POST['name3'], $_POST['barrio']);
    if ($stmt->execute()) {
        echo "<script>alert('New death record added successfully.'); window.location.href='death.php';</script>";
    } else {
        echo "<script>alert('Error adding new death record.'); window.location.href='death.php';</script>";
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="js/jquery.min.js"></script>
<script src="js/datatables-simple.js"></script>


<script>
$(document).ready(function() {
    $('#search2').on('keyup', function() {
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

</body>


</html>