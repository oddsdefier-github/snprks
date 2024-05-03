<?php
if (isset($_POST['editDeathRecord'])) {
    $deathId = $_POST['death_id'];

    $conn = new mysqli("localhost", "root", "", "stoninodb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $record_no = $_POST['record_no'];
    $name_of_deceased = $_POST['name_of_deceased'];
    $residence = $_POST['residence'];
    $date_of_death = $_POST['date_of_death'];
    $date_of_burial = $_POST['date_of_burial'];
    $age = $_POST['age'];
    $place_of_burial = $_POST['place_of_burial'];
    $sacraments = $_POST['sacraments'];
    $name_of_priest = $_POST['name_of_priest'];
    $province = $_POST['province'];
    $spouse = $_POST['spouse'];
    $municipal = $_POST['municipal'];
    $death = $_POST['death'];
    $status = $_POST['status'];
    $book = $_POST['book'];
    $line = $_POST['line'];
    $page = $_POST['page'];
    $name1 = $_POST['name1'];
    $name2 = $_POST['name2'];
    $name3 = $_POST['name3'];
    $barrio = $_POST['barrio'];
 
    // Use prepared statements to prevent SQL injection
    $sql = "UPDATE death SET record_no=?, name_of_deceased=?, residence=?, date_of_death=?, date_of_burial=?, age=?, place_of_burial=?, sacraments=?, name_of_priest=?, province=?, spouse=?, municipal=?, death=?, status=?, book=?, line=?, page=?, name1=?, name2=?, name3=?, barrio=? WHERE id=?";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Preparation failed: " . $conn->error);
    }

    // Bind parameters and data types
    if (!$stmt->bind_param("sssssssssssssssssssssi", $record_no, $name_of_deceased, $residence, $date_of_death, $date_of_burial, $age, $place_of_burial, $sacraments, $name_of_priest, $province, $spouse, $municipal, $death, $status, $book, $line, $page, $name1, $name2, $name3, $barrio, $deathId)) {
        die("Binding parameters failed: " . $stmt->error);
    }

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "<script>alert('Death record updated successfully.'); window.location.href='death.php';</script>";
    } else {
        echo "<script>alert('Error updating death record: " . $stmt->error . "'); window.location.href='death.php';</script>";
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
}
?>
