<?php
require('C:\xampp\htdocs\snp\pdf\fpdf.php');
require('C:\xampp\htdocs\snp\connect.php'); // Assuming the connection script is in this path

// Define the fetchData function to query the database
function fetchData($conn, $table, $paymentId) {
    $query = "SELECT * FROM $table WHERE id = " . intval($paymentId);
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Database query failed: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);

    return $row;
}

// Fetch payment data using the payment_id from the query string
if (isset($_GET['payment_id'])) {
    $paymentId = $_GET['payment_id'];

    // Get the payment data for the given paymentId
    $payment = fetchData($conn, 'payments', $paymentId);

    // Check if payment data is found
    if ($payment) {
        $pdf = new FPDF('P', 'mm', "A4");
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Donation Details', 0, 0, 'C');
        $pdf->Ln(); // Move to the next line
//
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(71, 5, 'Official Receipt',0);
        $pdf->Cell(59, 5, '', 0,0);
        $pdf->Cell(34, 5, '', 0,1);

        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(130, 5, '',0,0);
        $pdf->Cell(59, 5, '', 0,0);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(34, 10, '', 0,1);

        // Create a table with headers
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(20, 10, '      ID', 1);
        $pdf->Cell(40, 10, '       Fullname', 1);
        $pdf->Cell(50, 10, '  Address/Pamayanan', 1);
        $pdf->Cell(20, 10, ' Amount', 1);
        $pdf->Cell(30, 10, '        Date', 1);
        $pdf->Cell(30, 10, 'Contributions', 1);
        $pdf->Ln(); // Move to the next line

        // Add payment details to the table
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(20, 10, $payment['id'], 1);
        $pdf->Cell(40, 10, $payment['fullname'], 1);
        $pdf->Cell(50, 10, $payment['address'], 1);
        $pdf->Cell(20, 10, 'Php ' . $payment['amount'], 1);
        $pdf->Cell(30, 10, $payment['payment_date'], 1);
        $pdf->Cell(30, 10, $payment['contributions'], 1);


        // Output the PDF to the browser
        $pdf->Output();
    }
}
?>
