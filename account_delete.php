<?php
    include 'connect.php';
    
    $membersID = $_GET['id'];
    
    $deleteQuery = "DELETE FROM `account` WHERE `id` = $membersID";
    if ($conn->query($deleteQuery) === TRUE) {
        echo "<script>alert('Admin account deleted successfully.'); window.location.href='account.php';</script>";
    } else {
        echo "<script>alert('Admin account not deleted successfully.'); window.location.href='account.php';</script>";
    }
?>