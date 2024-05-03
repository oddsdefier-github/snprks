<?php
require('C:\xampp\htdocs\snp\pdf\fpdf.php');
require('C:\xampp\htdocs\snp\connect.php'); // Assuming the connection script is in this path

if (isset($_GET['id'])) {
    $memberId = $_GET['id'];

    // Fetch the member data for the specific ID
    $query = "SELECT * FROM members WHERE id = $memberId";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $member = $result->fetch_assoc();

        // Create a PDF document
        $pdf = new FPDF();
        $pdf->AddPage();

        // Set font for the document
        $pdf->SetFont('Arial', 'B', 16);

        // Add a title to the PDF
        $pdf->Cell(190, 20, 'Printed Copy Management', 0, 1, 'C');

        // Get the dimensions of the PDF page
        $pageWidth = $pdf->GetPageWidth();
        $pageHeight = $pdf->GetPageHeight();

        // Calculate the dimensions for the image to fit within the page
        $imageWidth = $pageWidth - 20; // 20 units margin on each side
        $imageHeight = $pageHeight - 50; // 50 units margin from the top

        // Display the Certification image (auto-resize to fit the page)
        $imagePath = $member['certification'];
        if (file_exists($imagePath)) {
            $imageInfo = getimagesize($imagePath);
            if ($imageInfo) {
                list($width, $height, $type) = $imageInfo;
                if ($type === IMAGETYPE_JPEG) {
                    $pdf->Image($imagePath, 10, 40, $imageWidth, $imageHeight, 'JPEG');
                } elseif ($type === IMAGETYPE_PNG) {
                    $pdf->Image($imagePath, 10, 40, $imageWidth, $imageHeight, 'PNG');
                } else {
                    $pdf->Cell(30, 30, 'Unsupported image format', 1);
                }
            } else {
                $pdf->Cell(30, 30, 'Invalid image file', 1);
            }
        } else {
            $pdf->Cell(30, 30, 'Certification not found', 1);
        }

        // Output the PDF content to the browser
        $pdf->Output();
    } else {
        echo "Member not found.";
    }
} else {
    echo "Member ID not provided.";
}

// Close the database connection
$conn->close();
?>
