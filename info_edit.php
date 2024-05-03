<?php
    include 'connect.php';

    if(isset($_POST['editMember'])) {
        $id = $_POST['member_id'];
        $fullname = $_POST['fullname'];
        $age = $_POST['age'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $sql = "UPDATE members SET fullname = ?, age = ?, phone = ?, address = ? WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $fullname, $age, $phone, $address, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Edit Member successfully'); window.location.href='info.php';</script>";
        } else {
            echo "<script>alert('Edit Member not successfully'); window.location.href='info.php';</script>";
        }
    }
?>