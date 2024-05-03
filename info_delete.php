<?php
    include 'connect.php';
    
    $membersID = $_GET['id'];
    
    $deleteQuery = "DELETE FROM `members` WHERE `id` = $membersID";
    if ($conn->query($deleteQuery) === TRUE) {
        echo "<script>alert('Member deleted successfully.'); window.location.href='info.php';</script>";
    } else {
        echo "<script>alert('Member not deleted successfully.'); window.location.href='info.php';</script>";
    }
?>