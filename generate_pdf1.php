<?php
// Include the FPDF library
require('C:\xampp\htdocs\stonino\pdf\fpdf.php');
// Create a new PDF document
$pdf = new FPDF();
$pdf->AddPage();

// Add the "FINANCIAL REPORTS" heading as an h1
$pdf->SetFont('Arial', 'B', 16); // Set the font size and style for the heading
$pdf->Cell(0, 10, 'DONATION REPORT', 0, 1, 'C'); // Create a cell with centered text 
$pdf->Cell(0, 10, '', 0, 1, 'C');

// Connect to your database (replace with your database connection code)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stoninodb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the payments table
$sql = "SELECT * FROM payments";
$result = $conn->query($sql);

// Create a table with headers
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(47, 10, 'ID', 1);
$pdf->Cell(47, 10, 'Contributions', 1);
$pdf->Cell(47, 10, 'Date', 1);
$pdf->Cell(47, 10, 'Amount (Php)', 1);
$pdf->Ln(); // Move to the next line

// Add data from the database to the table
$pdf->SetFont('Arial', '', 12);
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(47, 10, $row['id'], 1);
    $pdf->Cell(47, 10, $row['contributions'], 1);
    $pdf->Cell(47, 10, $row['payment_date'], 1);
    $pdf->Cell(47, 10, $row['amount'], 1);
    $pdf->Ln(); // Move to the next line
}

// Output the PDF to the browser (optional: you can save it to a file)
$pdf->Output();
?>
