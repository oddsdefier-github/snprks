<?php
session_start();
$title = "dashboard";
include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/scripts.php';

?>





<?php
function fetchData($conn, $table)
{
    $query = "SELECT * FROM marriage"; // Use the provided table name
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
$marriageData = fetchData($conn, 'marriage'); // Use 'marriage' as the table name

if (isset($_GET['id'])) {
    // Sanitize the ID parameter to prevent SQL injection (you should use prepared statements for better security)
    $recordId = intval($_GET['id']);

    // Create a query to retrieve the selected record
    $query = "SELECT * FROM marriage WHERE id = $recordId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $marriageRecord = $result->fetch_assoc();
    } else {
        // Handle the case where the record with the specified ID was not found
        echo "Record not found.";
    }
}

// Close the database connection
$conn->close();
?>

<!-- Main Content -->
<div class="col-12 col-xl-10">
    <div class="col mt-4">
        <h1 class="mb-4 text-uppercase fw-bolder">Marriage Information</h1>
        <hr>
        <div class="row">
            <?php if (isset($_GET['id'])) { ?>
                <div class="col-12">
                    <div class="card mb-3">
                        <strong>
                            <div class="card-header d-flex justify-content-between align-items-center">
                                Marriage Information -
                                <?php echo $marriageRecord['groom_name'] . ' & ' . $marriageRecord['bride_name']; ?>
                                <div>
                                    <a href="marriage.php" class="btn btn-primary">Back</a>
                                </div>
                            </div>
                        </strong>
                        <div class="card-body">
                            <!-- Separate table for ID and Record No -->
                            <table class="table table-bordered">
                                <tbody>

                                    <tr>
                                        <td>ID:</td>
                                        <td>
                                            <?php echo $marriageRecord['id']; ?>
                                        </td>
                                        <td>Record No:</td>
                                        <td>
                                            <?php echo $marriageRecord['record_no']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Page No:</td>
                                        <td>
                                            <?php echo $marriageRecord['page']; ?>
                                        </td>
                                        <td>Line No:</td>
                                        <td>
                                            <?php echo $marriageRecord['line']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Book No:</td>
                                        <td>
                                            <?php echo $marriageRecord['book']; ?>
                                        </td>
                                        <td>License No:</td>
                                        <td>
                                            <?php echo $marriageRecord['license']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Date of Marriage:</td>
                                        <td>
                                            <?php echo $marriageRecord['date_of_marriage']; ?>
                                        </td>
                                        <td>Priest Name:</td>
                                        <td>
                                            <?php echo $marriageRecord['priest_name']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="border: none;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="fw-bolder">Groom</td>
                                        <td colspan="2" class="fw-bolder">Bride</td>
                                    </tr>
                                    <tr>
                                        <td>Groom's Name:</td>
                                        <td>
                                            <?php echo $marriageRecord['groom_name']; ?>
                                        </td>
                                        <td>Bride's Name:</td>
                                        <td>
                                            <?php echo $marriageRecord['bride_name']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Groom's Legal Status:</td>
                                        <td>
                                            <?php echo $marriageRecord['groom_legal_status']; ?>
                                        </td>
                                        <td>Bride's Legal Status:</td>
                                        <td>
                                            <?php echo $marriageRecord['bride_legal_status']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Groom's Date of Birth:</td>
                                        <td>
                                            <?php echo $marriageRecord['groom_date_of_birth']; ?>
                                        </td>
                                        <td>Bride's Date of Birth:</td>
                                        <td>
                                            <?php echo $marriageRecord['bride_date_of_birth']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Groom's Place of Birth:</td>
                                        <td>
                                            <?php echo $marriageRecord['groom_place_of_birth']; ?>
                                        </td>
                                        <td>Bride's Place of Birth:</td>
                                        <td>
                                            <?php echo $marriageRecord['bride_place_of_birth']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Groom's Native of:</td>
                                        <td>
                                            <?php echo $marriageRecord['native']; ?>
                                        </td>
                                        <td>Bride's Native of:</td>
                                        <td>
                                            <?php echo $marriageRecord['natives']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Groom's Address:</td>
                                        <td>
                                            <?php echo $marriageRecord['groom_address']; ?>
                                        </td>
                                        <td>Bride's Address:</td>
                                        <td>
                                            <?php echo $marriageRecord['bride_address']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Groom's Father:</td>
                                        <td>
                                            <?php echo $marriageRecord['groom_father']; ?>
                                        </td>
                                        <td>Bride's Father:</td>
                                        <td>
                                            <?php echo $marriageRecord['bride_father']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Groom's Mother:</td>
                                        <td>
                                            <?php echo $marriageRecord['groom_mother']; ?>
                                        </td>
                                        <td>Bride's Mother:</td>
                                        <td>
                                            <?php echo $marriageRecord['bride_mother']; ?>
                                        </td>
                                    </tr>

                                    <!-- Add more fields as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
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
    document.getElementById("searchInput").addEventListener("input", function () {
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