<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Fetch form data.
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

// Connect to the database.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "survey_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data for the selected date range.
$sql = "SELECT * FROM customer_feedback WHERE submitted_at BETWEEN '$start_date' AND '$end_date'";
$result = $conn->query($sql);

// Create a new Spreadsheet.
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set header row.
$sheet->setCellValue('A1', 'Platform');
$sheet->setCellValue('B1', 'Satisfaction');
$sheet->setCellValue('C1', 'Rating');
$sheet->setCellValue('D1', 'Date Submitted');

// Populate data rows.
if ($result && $result->num_rows > 0) {
    $rowIndex = 2;
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowIndex, $row['shopping_platform']);
        $sheet->setCellValue('B' . $rowIndex, $row['product_satisfaction']);
        $sheet->setCellValue('C' . $rowIndex, $row['experience_rating']);
        $sheet->setCellValue('D' . $rowIndex, $row['submitted_at']);
        $rowIndex++;
    }
} else {
    $sheet->setCellValue('A2', 'No data available');
}

// Generate Excel file for download.
$writer = new Xlsx($spreadsheet);
$fileName = 'survey_report.xlsx';
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $fileName . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
$conn->close();
