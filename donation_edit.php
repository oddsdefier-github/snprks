<?php
    include 'connect.php';

    if(isset($_POST['editPayment'])) {

        $paymentId = $_POST['payment_id'];
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $amount = $_POST['amount'];
        $paymentDate = $_POST['payment_date'];
        $contributions = $_POST['contributions'];

        $sql = "UPDATE `payments` SET `fullname` = ?, `address` = ?, `amount` = ?, `payment_date` = ?, `contributions` = ? WHERE `id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdssi", $fullname, $address, $amount, $paymentDate, $contributions, $paymentId);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Payment information updated successfully.'); window.location.href='payment.php';</script>";
        } else {
            echo "<script>alert('Error updating payment information.'); window.location.href='payment.php';</script>";
        }
    }
?>