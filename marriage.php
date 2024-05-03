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
            $query = "SELECT * FROM marriage"; // Change "death" to "marriage"
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

        // Fetch marriage data using the fetchData function
        $marriageData = fetchData($conn, 'marriage');

        ?>

        <!-- Main Content -->
        <div class="col-12 col-xl-12">
            <div class="col mt-4">
                <h1 class="mb-4 text-uppercase fw-bolder">Marriage Records</h1>
                <hr>
                <div class="row mb-3">
                    <div class="col">
                        <input class="form-control" type="text" id="search3" placeholder="Search...">
                    </div>
                </div>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#addMarriageRecordModal">
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
                                        <th>Contracting Parties</th>
                                        <th>Parents(Groom)</th>
                                        <th>Parents(Bride)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($marriageData as $marriageRecord) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $marriageRecord['id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $marriageRecord['record_no']; ?>
                                        </td>
                                        <td>
                                            <?php echo $marriageRecord['groom_name']; ?><br>
                                            <?php echo $marriageRecord['bride_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $marriageRecord['groom_father']; ?><br>
                                            <?php echo $marriageRecord['groom_mother']; ?>
                                        </td>
                                        <td>
                                            <?php echo $marriageRecord['bride_father']; ?><br>
                                            <?php echo $marriageRecord['bride_mother']; ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editMarriageModal<?php echo $marriageRecord['id']; ?>"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a href="marriage_info.php?id=<?php echo $marriageRecord['id']; ?>"
                                                class="btn btn-warning" title="Info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-secondary"
                                                onclick="window.open('form/marriagecert.php?id=<?php echo $marriageRecord['id']; ?>', '_blank');">
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
</div>
</div>

<?php foreach ($marriageData as $marriage) { ?>
<div class="modal fade" id="editMarriageModal<?= $marriage['id'] ?>" tabindex="-1"
    aria-labelledby="editMarriageModalLabel<?= $marriage['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bolder" id="editMarriageModalLabel<?= $marriage['id'] ?>">Edit Marriage Record
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="marriage_edit.php">
                    <input type="hidden" name="marriage_id" value="<?= $marriage['id'] ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="record_no" class="form-label">Record No:</label>
                                <input type="text" class="form-control" id="record_no" name="record_no"
                                    value="<?= $marriage['record_no'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="book" class="form-label">Book No:</label>
                                <input type="text" class="form-control" id="book" name="book"
                                    value="<?= $marriage['book'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="groom_legal_status" class="form-label">Groom's Legal Status:</label>
                                <input type="text" class="form-control" id="groom_legal_status"
                                    name="groom_legal_status" value="<?= $marriage['groom_legal_status'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="native" class="form-label">Bride Native:</label>
                                <input type="text" class="form-control" id="native" name="native"
                                    value="<?= $marriage['native'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="groom_name" class="form-label">Groom's Name:</label>
                                <input type="text" class="form-control" id="groom_name" name="groom_name"
                                    value="<?= $marriage['groom_name'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="groom_date_of_birth" class="form-label">Groom's Date of Birth:</label>
                                <input type="date" class="form-control" id="groom_date_of_birth"
                                    name="groom_date_of_birth" value="<?= $marriage['groom_date_of_birth'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="groom_place_of_birth" class="form-label">Groom's Place of Birth:</label>
                                <input type="text" class="form-control" id="groom_place_of_birth"
                                    name="groom_place_of_birth" value="<?= $marriage['groom_place_of_birth'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="groom_address" class="form-label">Groom's Address:</label>
                                <input type="text" class="form-control" id="groom_address" name="groom_address"
                                    value="<?= $marriage['groom_address'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="groom_father" class="form-label">Groom's Father:</label>
                                <input type="text" class="form-control" id="groom_father" name="groom_father"
                                    value="<?= $marriage['groom_father'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="groom_mother" class="form-label">Groom's Mother:</label>
                                <input type="text" class="form-control" id="groom_mother" name="groom_mother"
                                    value="<?= $marriage['groom_mother'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="presense" class="form-label">Presence 1:</label>
                                <input type="text" class="form-control" id="presence1" name="presence1"
                                    value="<?= $marriage['presence1'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="presence2" class="form-label">Precense 2:</label>
                                <input type="text" class="form-control" id="presence2" name="presence2"
                                    value="<?= $marriage['presence2'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="address1" class="form-label">Address 1:</label>
                                <input type="text" class="form-control" id="address1" name="address1"
                                    value="<?= $marriage['address1'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="address2" class="form-label">Address 2:</label>
                                <input type="text" class="form-control" id="address2" name="address2"
                                    value="<?= $marriage['address2'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_marriage" class="form-label">Date of Marriage:</label>
                                <input type="date" class="form-control" id="date_of_marriage" name="date_of_marriage"
                                    value="<?= $marriage['date_of_marriage'] ?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="page" class="form-label">Page No:</label>
                                <input type="number" class="form-control" id="page" name="page"
                                    value="<?= $marriage['page'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="line" class="form-label">Line No:</label>
                                <input type="number" class="form-control" id="line" name="line"
                                    value="<?= $marriage['line'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="bride_legal_status" class="form-label">Bride's Legal Status:</label>
                                <input type="text" class="form-control" id="bride_legal_status"
                                    name="bride_legal_status" value="<?= $marriage['bride_legal_status'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="bride_name" class="form-label">Bride's Name:</label>
                                <input type="text" class="form-control" id="bride_name" name="bride_name"
                                    value="<?= $marriage['bride_name'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="bride_date_of_birth" class="form-label">Bride's Date of Birth:</label>
                                <input type="date" class="form-control" id="bride_date_of_birth"
                                    name="bride_date_of_birth" value="<?= $marriage['bride_date_of_birth'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="bride_place_of_birth" class="form-label">Bride's Place of Birth:</label>
                                <input type="text" class="form-control" id="bride_place_of_birth"
                                    name="bride_place_of_birth" value="<?= $marriage['bride_place_of_birth'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="bride_address" class="form-label">Bride's Address:</label>
                                <input type="text" class="form-control" id="bride_address" name="bride_address"
                                    value="<?= $marriage['bride_address'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="bride_father" class="form-label">Bride's Father:</label>
                                <input type="text" class="form-control" id="bride_father" name="bride_father"
                                    value="<?= $marriage['bride_father'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="bride_mother" class="form-label">Bride's Mother:</label>
                                <input type="text" class="form-control" id="bride_mother" name="bride_mother"
                                    value="<?= $marriage['bride_mother'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="issue" class="form-label">Issue at:</label>
                                <input type="text" class="form-control" id="issue" name="issue"
                                    value="<?= $marriage['issue'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="natives" class="form-label">Grooms Native:</label>
                                <input type="text" class="form-control" id="natives" name="natives"
                                    value="<?= $marriage['natives'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="license" class="form-label">License:</label>
                                <input type="text" class="form-control" id="license" name="license"
                                    value="<?= $marriage['license'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="church" class="form-label">Church:</label>
                                <input type="text" class="form-control" id="church" name="church"
                                    value="<?= $marriage['church'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="rev" class="form-label">Rev:</label>
                                <input type="text" class="form-control" id="rev" name="rev"
                                    value="<?= $marriage['rev'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="priest_name" class="form-label">Priest Name:</label>
                                <input type="text" class="form-control" id="priest_name" name="priest_name"
                                    value="<?= $marriage['priest_name'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="editMarriageRecord">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php
// Add the calculateAge function
function calculateAge($dob)
{
    $today = new DateTime();
    $birthdate = new DateTime($dob);
    $age = $today->diff($birthdate)->y;
    return $age;
}

if (isset($_POST['addMarriageRecord'])) {
    // Establish a database connection
    $conn = new mysqli("localhost", "root", "", "stoninodb");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Function to check if any required field is empty
    function checkEmpty($fields)
    {
        foreach ($fields as $field) {
            if (empty($_POST[$field])) {
                return true;
            }
        }
        return false;
    }

    // Define required fields
    $requiredFields = ['record_no', 'priest_name', 'groom_name', 'groom_date_of_birth', 'bride_name', 'bride_date_of_birth', 'date_of_marriage'];

    // Check if any required field is empty
    if (checkEmpty($requiredFields)) {
        echo "<script>alert('Please fill in all required fields.'); window.location.href='marriage.php';</script>";
        exit;
    }

    // Retrieve and sanitize form data
    $record_no = mysqli_real_escape_string($conn, $_POST['record_no']);
    $priest_name = mysqli_real_escape_string($conn, $_POST['priest_name']);
    $groom_name = mysqli_real_escape_string($conn, $_POST['groom_name']);
    $groom_legal_status = mysqli_real_escape_string($conn, $_POST['groom_legal_status']);
    $groom_date_of_birth = mysqli_real_escape_string($conn, $_POST['groom_date_of_birth']);
    $groom_place_of_birth = mysqli_real_escape_string($conn, $_POST['groom_place_of_birth']);
    $groom_address = mysqli_real_escape_string($conn, $_POST['groom_address']);
    $groom_father = mysqli_real_escape_string($conn, $_POST['groom_father']);
    $groom_mother = mysqli_real_escape_string($conn, $_POST['groom_mother']);
    $bride_name = mysqli_real_escape_string($conn, $_POST['bride_name']);
    $bride_legal_status = mysqli_real_escape_string($conn, $_POST['bride_legal_status']);
    $bride_date_of_birth = mysqli_real_escape_string($conn, $_POST['bride_date_of_birth']);
    $bride_place_of_birth = mysqli_real_escape_string($conn, $_POST['bride_place_of_birth']);
    $bride_address = mysqli_real_escape_string($conn, $_POST['bride_address']);
    $bride_father = mysqli_real_escape_string($conn, $_POST['bride_father']);
    $bride_mother = mysqli_real_escape_string($conn, $_POST['bride_mother']);
    $date_of_marriage = mysqli_real_escape_string($conn, $_POST['date_of_marriage']);
    $native = mysqli_real_escape_string($conn, $_POST['native']);
    $natives = mysqli_real_escape_string($conn, $_POST['natives']);
    $church = mysqli_real_escape_string($conn, $_POST['church']);
    $line = mysqli_real_escape_string($conn, $_POST['line']);
    $page = mysqli_real_escape_string($conn, $_POST['page']);
    $book = mysqli_real_escape_string($conn, $_POST['book']);
    $issue = mysqli_real_escape_string($conn, $_POST['issue']);
    $license = mysqli_real_escape_string($conn, $_POST['license']);
    $rev = mysqli_real_escape_string($conn, $_POST['rev']);
    $presence1 = mysqli_real_escape_string($conn, $_POST['presence1']);
    $presence2 = mysqli_real_escape_string($conn, $_POST['presence2']);
    $address1 = mysqli_real_escape_string($conn, $_POST['address1']);
    $address2 = mysqli_real_escape_string($conn, $_POST['address2']);

    // Calculate ages
    $groom_age = calculateAge($groom_date_of_birth);
    $bride_age = calculateAge($bride_date_of_birth);

    // Check if both groom and bride are 18 years old or above
    if ($groom_age < 18) {
        echo "<script>alert('Groom must be 18 years old or above.'); window.location.href='marriage.php';</script>";
        exit;
    }

    if ($bride_age < 18) {
        echo "<script>alert('Bride must be 18 years old or above.'); window.location.href='marriage.php';</script>";
        exit;
    }

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO marriage (record_no, priest_name, groom_name, groom_legal_status, groom_age, groom_place_of_birth, groom_address, groom_father, groom_mother, bride_name, bride_legal_status, bride_age, bride_place_of_birth, bride_address, bride_father, bride_mother, date_of_marriage, native, natives, church, line, page, book, issue, license, rev, presence1, presence2, address1, address2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Preparation failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param(
        "ssssisssssssssssssssssssssssss",
        $record_no,
        $priest_name,
        $groom_name,
        $groom_legal_status,
        $groom_age,
        $groom_place_of_birth,
        $groom_address,
        $groom_father,
        $groom_mother,
        $bride_name,
        $bride_legal_status,
        $bride_age,
        $bride_place_of_birth,
        $bride_address,
        $bride_father,
        $bride_mother,
        $date_of_marriage,
        $native,
        $natives,
        $church,
        $line,
        $page,
        $book,
        $issue,
        $license,
        $rev,
        $presence1,
        $presence2,
        $address1,
        $address2
    );

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('New marriage record added successfully.'); window.location.href='marriage.php';</script>";
    } else {
        echo "<script>alert('Error adding new marriage record: " . $stmt->error . "'); window.location.href='marriage.php';</script>";
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
}
?>


<!-- Add Marriage Record Modal -->
<div class="modal fade" id="addMarriageRecordModal" tabindex="-1" aria-labelledby="addMarriageRecordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bolder" id="addMarriageRecordModalLabel">Add Marriage Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="marriage.php" method="POST" id="marriageForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="record_no" class="form-label">Record No:</label>
                                <input type="text" class="form-control" id="record_no" name="record_no" required>
                            </div>
                            <div class="mb-3">
                                <label for="book" class="form-label">Book No:</label>
                                <input type="text" class="form-control" id="book" name="book" required>
                            </div>
                            <div class="mb-3">
                                <label for="groom_legal_status" class="form-label">Groom's Legal Status:</label>
                                <input type="text" class="form-control" id="groom_legal_status"
                                    name="groom_legal_status">
                            </div>
                            <div class="mb-3">
                                <label for="native" class="form-label">Bride Native:</label>
                                <input type="text" class="form-control" id="native" name="native" required>
                            </div>
                            <div class="mb-3">
                                <label for="groom_name" class="form-label">Groom's Name:</label>
                                <input type="text" class="form-control" id="groom_name" name="groom_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="groom_date_of_birth" class="form-label">Groom's Date of Birth:</label>
                                <input type="date" class="form-control" id="groom_date_of_birth"
                                    name="groom_date_of_birth">
                            </div>
                            <div class="mb-3">
                                <label for="groom_place_of_birth" class="form-label">Groom's Place of Birth:</label>
                                <input type="text" class="form-control" id="groom_place_of_birth"
                                    name="groom_place_of_birth">
                            </div>
                            <div class="mb-3">
                                <label for="groom_address" class="form-label">Groom's Address:</label>
                                <input type="text" class="form-control" id="groom_address" name="groom_address">
                            </div>
                            <div class="mb-3">
                                <label for="groom_father" class="form-label">Groom's Father:</label>
                                <input type="text" class="form-control" id="groom_father" name="groom_father">
                            </div>
                            <div class="mb-3">
                                <label for="groom_mother" class="form-label">Groom's Mother:</label>
                                <input type="text" class="form-control" id="groom_mother" name="groom_mother">
                            </div>
                            <div class="mb-3">
                                <label for="presense" class="form-label">Presence 1:</label>
                                <input type="text" class="form-control" id="presence1" name="presence1" required>
                            </div>
                            <div class="mb-3">
                                <label for="presence2" class="form-label">Precense 2:</label>
                                <input type="text" class="form-control" id="presence2" name="presence2" required>
                            </div>
                            <div class="mb-3">
                                <label for="address1" class="form-label">Address 1:</label>
                                <input type="text" class="form-control" id="address1" name="address1" required>
                            </div>
                            <div class="mb-3">
                                <label for="address2" class="form-label">Address 2:</label>
                                <input type="text" class="form-control" id="address2" name="address2" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_marriage" class="form-label">Date of Marriage:</label>
                                <input type="date" class="form-control" id="date_of_marriage" name="date_of_marriage"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="page" class="form-label">Page No:</label>
                                <input type="number" class="form-control" id="page" name="page" required>
                            </div>
                            <div class="mb-3">
                                <label for="line" class="form-label">Line No:</label>
                                <input type="number" class="form-control" id="line" name="line" required>
                            </div>
                            <div class="mb-3">
                                <label for="bride_legal_status" class="form-label">Bride's Legal Status:</label>
                                <input type="text" class="form-control" id="bride_legal_status"
                                    name="bride_legal_status">
                            </div>
                            <div class="mb-3">
                                <label for="bride_name" class="form-label">Bride's Name:</label>
                                <input type="text" class="form-control" id="bride_name" name="bride_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="bride_date_of_birth" class="form-label">Bride's Date of Birth:</label>
                                <input type="date" class="form-control" id="bride_date_of_birth"
                                    name="bride_date_of_birth">
                            </div>
                            <div class="mb-3">
                                <label for="bride_place_of_birth" class="form-label">Bride's Place of Birth:</label>
                                <input type="text" class="form-control" id="bride_place_of_birth"
                                    name="bride_place_of_birth">
                            </div>
                            <div class="mb-3">
                                <label for="bride_address" class="form-label">Bride's Address:</label>
                                <input type="text" class="form-control" id="bride_address" name="bride_address">
                            </div>
                            <div class="mb-3">
                                <label for="bride_father" class="form-label">Bride's Father:</label>
                                <input type="text" class="form-control" id="bride_father" name="bride_father">
                            </div>
                            <div class="mb-3">
                                <label for="bride_mother" class="form-label">Bride's Mother:</label>
                                <input type="text" class="form-control" id="bride_mother" name="bride_mother">
                            </div>
                            <div class="mb-3">
                                <label for="issue" class="form-label">Issue at:</label>
                                <input type="text" class="form-control" id="issue" name="issue">
                            </div>
                            <div class="mb-3">
                                <label for="natives" class="form-label">Grooms Native:</label>
                                <input type="text" class="form-control" id="natives" name="natives" required>
                            </div>
                            <div class="mb-3">
                                <label for="license" class="form-label">License:</label>
                                <input type="text" class="form-control" id="license" name="license" required>
                            </div>
                            <div class="mb-3">
                                <label for="church" class="form-label">Church:</label>
                                <input type="text" class="form-control" id="church" name="church" required>
                            </div>
                            <div class="mb-3">
                                <label for="rev" class="form-label">Rev:</label>
                                <input type="text" class="form-control" id="rev" name="rev" required>
                            </div>
                            <div class="mb-3">
                                <label for="priest_name" class="form-label">Priest Name:</label>
                                <input type="text" class="form-control" id="priest_name" name="priest_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addMarriageRecord">Submit</button>
                    </div>
                </form>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="js/jquery.min.js"></script>
<script src="js/datatables-simple.js"></script>


<script>
$(document).ready(function() {
    $('#search3').on('keyup', function() {
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