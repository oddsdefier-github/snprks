<?php
if (isset($_POST['editCommunionRecord'])) {
    // Ensure that the communion_id is properly sanitized
    $communionId = intval($_POST['communion_id']);

    // Establish a database connection
    $conn = new mysqli("localhost", "root", "", "stoninodb");

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve and sanitize updated data from the form fields
    $recordNo = $conn->real_escape_string($_POST['record_no']);
    $childName = $conn->real_escape_string($_POST['child_name']);
    $dateOfBaptism = $conn->real_escape_string($_POST['date_of_baptism']);
    $placeOfBaptism = $conn->real_escape_string($_POST['place_of_baptism']);
    $fatherName = $conn->real_escape_string($_POST['father_name']);
    $motherName = $conn->real_escape_string($_POST['mother_name']);
    $dateOfCommunion = $conn->real_escape_string($_POST['date_of_communion']);
    $ministerName = $conn->real_escape_string($_POST['minister_name']);
    $rev = $conn->real_escape_string($_POST['rev']);
    $spo = $conn->real_escape_string($_POST['spo']);
    $page = $conn->real_escape_string($_POST['page']);
    $line = $conn->real_escape_string($_POST['line']);
    $book = $conn->real_escape_string($_POST['book']);
    $church = $conn->real_escape_string($_POST['church']);


    $sql = "UPDATE communion SET 
                record_no = '$recordNo',
                child_name = '$childName',
                date_of_baptism = '$dateOfBaptism',
                place_of_baptism = '$placeOfBaptism',
                father_name = '$fatherName',
                mother_name = '$motherName',
                date_of_communion = '$dateOfCommunion',
                minister_name = '$ministerName',
                rev = '$rev',
                spo = '$spo',
                page = '$page',
                line = '$line',
                book = '$book',
                church = '$church'
                WHERE id = $communionId";


    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Communion record updated successfully.'); window.location.href='confirmation.php';</script>";
    } else {
        echo "<script>alert('Error updating communion record: " . $conn->error . "'); window.location.href='confirmation.php';</script>";
    }


    $conn->close();
}
?>
