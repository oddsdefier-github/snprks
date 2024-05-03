<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    echo '<script>alert("Please log in first!");</script>';
    echo '<script>window.location.href = "login.php";</script>';
    exit;
}

if ($_SESSION['userType'] != "Admin") {
    echo '<script>alert("You\'re not allowed here!");</script>';
    $_SESSION = array();
    session_unset();
    session_destroy();
    echo '<script>window.location.href = "login.php";</script>';
}