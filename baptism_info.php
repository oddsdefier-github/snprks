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
            $query = "SELECT * FROM baptism";
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

if (isset($_GET['id'])) {
    // Sanitize the ID parameter to prevent SQL injection (you should use prepared statements for better security)
    $recordId = intval($_GET['id']);

    // Establish a database connection
    $conn = new mysqli("localhost", "root", "", "stoninodb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create a query to retrieve the selected record
    $query = "SELECT * FROM baptism WHERE id = $recordId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $baptismRecord = $result->fetch_assoc();
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

        <!-- Main Content -->
        <div class="col-10 col-xl-12">
            <div class="col mt-4">
                <h1 class="mb-4 text-uppercase fw-bolder">Baptism Information</h1>

                <hr>

                <div class="row">
                    <?php if (isset($_GET['id'])) { ?>
                    <div class="col-12">
                        <div class="card mb-3">
                            <strong>
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    Client - <?php echo $baptismRecord['name']; ?>
                                    <div>
                            </strong>
                            <a href="baptism.php" class="btn btn-primary">Back</a>
                            <button type="button" class="btn btn-secondary"
                                onclick="generatePDF(<?php echo $baptismRecord['id']; ?>)">Print</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>ID:</td>
                                    <td><?php echo $baptismRecord['id']; ?></td>
                                </tr>
                                <tr>
                                    <td>Book No:</td>
                                    <td><?php echo $baptismRecord['book']; ?></td>
                                </tr>
                                <tr>
                                    <td>Line No:</td>
                                    <td><?php echo $baptismRecord['line']; ?></td>
                                </tr>
                                <tr>
                                    <td>Page No:</td>
                                    <td><?php echo $baptismRecord['page']; ?></td>
                                </tr>
                                <tr>
                                    <td>Rev :</td>
                                    <td><?php echo $baptismRecord['rev']; ?></td>
                                </tr>
                                <tr>
                                    <td>Sponsor:</td>
                                    <td><?php echo $baptismRecord['spo']; ?></td>
                                </tr>
                                <tr>
                                    <td>Name of Child:</td>
                                    <td><?php echo $baptismRecord['name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Date of Birth:</td>
                                    <td><?php echo $baptismRecord['date_of_birth']; ?></td>
                                </tr>
                                <tr>
                                    <td>Place of Birth:</td>
                                    <td><?php echo $baptismRecord['place_of_birth']; ?></td>
                                </tr>
                                <tr>
                                    <td>Father's Name:</td>
                                    <td><?php echo $baptismRecord['father_name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Mother's Name:</td>
                                    <td><?php echo $baptismRecord['mother_name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Gender:</td>
                                    <td><?php echo $baptismRecord['gender']; ?></td>
                                </tr>
                                <tr>
                                    <td>Present Address:</td>
                                    <td><?php echo $baptismRecord['present_address']; ?></td>
                                </tr>
                                <tr>
                                    <td>Name of Priest:</td>
                                    <td><?php echo $baptismRecord['minister_name']; ?></td>
                                </tr>

                                <tr>
                                    <td>Date of Baptism:</td>
                                    <td><?php echo $baptismRecord['date_of_baptism']; ?></td>
                                </tr>
                                <tr>
                                    <td>Place of Baptism:</td>
                                    <td><?php echo $baptismRecord['place_of_baptism']; ?></td>
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