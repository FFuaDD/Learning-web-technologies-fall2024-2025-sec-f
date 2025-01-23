

<?php
session_start();
require_once '../model/userModel.php';

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Admin') {
    header('Location: login.html');
    exit;
}

// Get the filter parameters from the request
$filters = [];
if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $filters['start_date'] = $_GET['start_date'];
    $filters['end_date'] = $_GET['end_date'];
}
if (isset($_GET['campaign'])) {
    $filters['campaign'] = $_GET['campaign'];
}
if (isset($_GET['advertiser_id'])) {
    $filters['advertiser_id'] = $_GET['advertiser_id'];
}

// Fetch earnings report based on filters
$data = getEarningsReports($filters);

// Set headers to force the download of the CSV file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="earnings_report.csv"');

// Open a file for output
$output = fopen('php://output', 'w');

// Add the column headers for the CSV
fputcsv($output, ['Transaction ID', 'Package', 'Payment Method', 'Amount', 'Payment Status', 'Created At']);

// Write each row of data to the CSV
foreach ($data as $row) {
    fputcsv($output, $row);
}

// Close the output file
fclose($output);
exit;
?>
