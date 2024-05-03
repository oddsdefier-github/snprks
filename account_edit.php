<?php
include 'connect.php';

if (isset($_POST['editAdmin'])) {

    $admin_id = intval($_POST['admin_id']);
    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($admin_id) || empty($fullname) || empty($username) || empty($password)) {
        echo "<script>alert('All fields are required.'); window.location.href='account.php';</script>";
        exit();
    }


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    $sql = "UPDATE `account` SET `fullname` = ?, `username` = ?, `password` = ? WHERE `id` = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "<script>alert('Error preparing SQL statement.'); window.location.href='account.php';</script>";
        exit();
    }


    $stmt->bind_param("sssi", $fullname, $username, $hashedPassword, $admin_id);


    if ($stmt->execute()) {
        echo "<script>alert('Admin updated successfully.'); window.location.href='account.php';</script>";
    } else {
        echo "<script>alert('Failed to update admin: {$stmt->error}'); window.location.href='account.php';</script>";
    }
}
