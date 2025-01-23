<?php
session_start();
require_once '../model/userModel.php';

// Initialize filter parameters
$filters = [];

// Apply start date filter if provided
if (isset($_GET['start_date']) && isset($_GET['end_date']) && !empty($_GET['start_date']) && !empty($_GET['end_date'])) {
    $filters['start_date'] = $_GET['start_date'];
    $filters['end_date'] = $_GET['end_date'];
}

// Apply user ID filter if provided
if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
    $filters['user_id'] = $_GET['user_id'];
}

// Fetch earnings data from database
$earningsData = getEarningsReports($filters);

// Calculate total revenue
$totalRevenue = 0;
foreach ($earningsData as $data) {
    $totalRevenue += (float)$data['amount'];
}

// Export data to CSV if requested
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="revenue_data.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['Transaction ID', 'Package', 'Payment Method', 'Amount', 'Payment Status', 'Created At']);
    foreach ($earningsData as $data) {
        fputcsv($output, [
            $data['id'],
            $data['package'],
            $data['payment_method'],
            $data['amount'],
            $data['payment_status'],
            $data['created_at']
        ]);
    }
    fclose($output);
    exit;
}

// Respond with JSON if AJAX request is made
if (isset($_GET['ajax']) && $_GET['ajax'] === 'true') {
    echo json_encode([
        'earningsData' => $earningsData,
        'totalRevenue' => number_format($totalRevenue, 2)
    ]);
    exit;
}

?>
<?php
session_start();
require_once '../model/userModel.php';

$filters = [];
if (isset($_GET['start_date']) && isset($_GET['end_date']) && !empty($_GET['start_date']) && !empty($_GET['end_date'])) {
    $filters['start_date'] = $_GET['start_date'];
    $filters['end_date'] = $_GET['end_date'];
}

if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
    $filters['user_id'] = $_GET['user_id'];
}

$earningsData = getEarningsReports($filters);

$totalRevenue = 0;
foreach ($earningsData as $data) {
    $totalRevenue += (float)$data['amount'];
}

if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="revenue_data.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['Transaction ID', 'Package', 'Payment Method', 'Amount', 'Payment Status', 'Created At']);
    foreach ($earningsData as $data) {
        fputcsv($output, [
            $data['id'],
            $data['package'],
            $data['payment_method'],
            $data['amount'],
            $data['payment_status'],
            $data['created_at']
        ]);
    }
    fclose($output);
    exit;
}

if (isset($_GET['ajax']) && $_GET['ajax'] === 'true') {
    echo json_encode([
        'earningsData' => $earningsData,
        'totalRevenue' => number_format($totalRevenue, 2)
    ]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Revenue Management Dashboard</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
    }
    .container {
        width: 80%;
        margin: 20px auto;
    }
    h1 {
        text-align: center;
        color: #333;
    }
    .filter-form {
        margin: 20px 0;
        text-align: center;
    }
    .filter-form input, .filter-form button {
        padding: 10px;
        margin: 5px;
    }
    .export-btn {
        display: inline-block;
        margin: 10px 0;
        padding: 10px 15px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }
    .export-btn:hover {
        background-color: #45a049;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    table, th, td {
        border: 1px solid #ddd;
    }
    th, td {
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #4CAF50;
        color: white;
    }
    .total-row td {
        font-weight: bold;
        text-align: right;
    }
</style>
</head>
<body>
<div class="container">
<h1 id="head">Revenue Management Dashboard</h1>

<form class="filter-form" id="filterForm" onsubmit="return false;">
    <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" id="start_date" value="">
    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" id="end_date" value="">
    <label for="user_id">Advertiser User ID:</label>
    <input type="text" name="user_id" id="user_id" value="">
    <input type="submit" value="Apply Filters" onclick="applyFilters()" />
</form>

<a href="?<?= http_build_query(array_merge($_GET, ['export' => 'csv'])) ?>" class="export-btn">Export to CSV</a>

<table id="earningsTable">
<thead>
<tr>
<th>Transaction ID</th>
<th>Package</th>
<th>Payment Method</th>
<th>Amount</th>
<th>Payment Status</th>
<th>Created At</th>
</tr>
</thead>
<tbody>
<tr>
<td colspan="6" style="text-align: center;">Loading...</td>
</tr>
</tbody>
</table>
</div>

<script>
function applyFilters() {
    let startDate = document.getElementById('start_date').value;
    let endDate = document.getElementById('end_date').value;
    let userId = document.getElementById('user_id').value;

    let queryParams = start_date=${startDate}&end_date=${endDate}&user_id=${userId}&ajax=true;

    let xhttp = new XMLHttpRequest();
    xhttp.open('GET', '?' + queryParams, true);
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);
            let earningsData = response.earningsData;
            let totalRevenue = response.totalRevenue;

            let tableBody = document.querySelector('#earningsTable tbody');
            tableBody.innerHTML = '';

            if (earningsData.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="6" style="text-align: center;">No records found for the applied filters.</td></tr>';
            } else {
                earningsData.forEach(item => {
                    let row = document.createElement('tr');
                    row.innerHTML = 
                        <td>${item.id}</td>
                        <td>${item.package}</td>
                        <td>${item.payment_method}</td>
                        <td>${item.amount}</td>
                        <td>${item.payment_status}</td>
                        <td>${item.created_at}</td>
                    ;
                    tableBody.appendChild(row);
                });

                let totalRow = document.createElement('tr');
                totalRow.classList.add('total-row');
                totalRow.innerHTML = 
                    <td colspan="3"></td>
                    <td>Total Revenue: ${totalRevenue}</td>
                    <td colspan="2"></td>
                ;
                tableBody.appendChild(totalRow);
            }
        }
    };
    xhttp.send();
}
</script>
</body>
</html>