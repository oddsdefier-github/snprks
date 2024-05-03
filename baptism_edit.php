<?php
if (isset($_POST['editBaptism'])) {
    $baptismId = $_POST['baptism_id'];

    $name = $_POST['name'];
    $dateOfBirth = $_POST['date_of_birth'];
    $placeOfBirth = $_POST['place_of_birth'];
    $fatherName = $_POST['father_name'];
    $motherName = $_POST['mother_name'];
    $gender = $_POST['gender'];
    $present_address = $_POST['present_address'];
    $ministerName = $_POST['minister_name'];
    $churchName = $_POST['church_name'];
    $dateOfBaptism = $_POST['date_of_baptism'];
    $placeOfBaptism = $_POST['place_of_baptism'];
    $spouse = isset($_POST['spouse']) ? $_POST['spouse'] : '';
    $line = $_POST['line'];
    $rev = $_POST['rev'];
    $spo = $_POST['spo'];
    $book = $_POST['book'];
    $cath = $_POST['cath'];
    $page = $_POST['page'];
   
    $conn = new mysqli("localhost", "root", "", "stoninodb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE baptism SET 
                name = ?,
                date_of_birth = ?,
                place_of_birth = ?,
                father_name = ?,
                mother_name = ?,
                gender = ?,
                present_address = ?,
                minister_name = ?,
                church_name = ?,
                date_of_baptism = ?,
                place_of_baptism = ?,
                spouse = ?,
                line = ?,
                rev = ?,
                spo = ?,
                book = ?,
                cath = ?,
                page = ?
                WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssssssssi", $name, $dateOfBirth, $placeOfBirth, $fatherName, $motherName, $gender, $present_address, $ministerName, $churchName, $dateOfBaptism, $placeOfBaptism, $spouse, $line, $rev, $spo, $book, $cath, $page, $baptismId);

    if ($stmt->execute() === TRUE) {
        echo "<script>alert('Baptism record updated successfully.'); window.location.href='baptism.php';</script>";
    } else {
        echo "<script>alert('Error updating baptism record: " . $conn->error . "'); window.location.href='baptism.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
