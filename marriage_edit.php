<?php
if (isset($_POST['editMarriageRecord'])) {
    $marriageId = $_POST['marriage_id'];

    $conn = new mysqli("localhost", "root", "", "stoninodb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $record_no = $_POST['record_no'];
    $groom_name = $_POST['groom_name'];
    $groom_legal_status = $_POST['groom_legal_status'];
    $groom_date_of_birth = $_POST['groom_date_of_birth'];
    $groom_place_of_birth = $_POST['groom_place_of_birth'];
    $groom_address = $_POST['groom_address'];
    $groom_father = $_POST['groom_father'];
    $groom_mother = $_POST['groom_mother'];
    $bride_name = $_POST['bride_name'];
    $bride_legal_status = $_POST['bride_legal_status'];
    $bride_date_of_birth = $_POST['bride_date_of_birth'];
    $bride_place_of_birth = $_POST['bride_place_of_birth'];
    $bride_address = $_POST['bride_address'];
    $bride_father = $_POST['bride_father'];
    $bride_mother = $_POST['bride_mother'];
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

   
    $sql = "UPDATE marriage SET record_no=?, groom_name=?, groom_legal_status=?, groom_date_of_birth=?, groom_place_of_birth=?, groom_address=?, groom_father=?, groom_mother=?, bride_name=?, bride_legal_status=?, bride_date_of_birth=?, bride_place_of_birth=?, bride_address=?, bride_father=?, bride_mother=?, date_of_marriage=?, native=?, natives=?, church=?, line=?, page=?, book=?, issue=?, license=?, rev=?, presence1=?, presence2=?, address1=?, address2=? WHERE id=?";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Preparation failed: " . $conn->error);
    }

    
    if (!$stmt->bind_param("sssssssssssssssssssssssssssssi", $record_no, $groom_name, $groom_legal_status, $groom_date_of_birth, $groom_place_of_birth, $groom_address, $groom_father, $groom_mother, $bride_name, $bride_legal_status, $bride_date_of_birth, $bride_place_of_birth, $bride_address, $bride_father, $bride_mother, $date_of_marriage, $native, $natives, $church, $line, $page, $book, $issue, $license, $rev, $presence1, $presence2, $address1, $address2, $marriageId)) {
        die("Binding parameters failed: " . $stmt->error);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Marriage record updated successfully.'); window.location.href='marriage.php';</script>";
    } else {
        echo "<script>alert('Error updating marriage record: " . $stmt->error . "'); window.location.href='marriage.php';</script>";
    }


    $stmt->close();
    $conn->close();
}
?>