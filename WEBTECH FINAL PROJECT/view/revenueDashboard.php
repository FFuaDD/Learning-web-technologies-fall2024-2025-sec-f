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
<h1>Revenue Management Dashboard</h1>
<!-- Filter Form -->
<form class="filter-form" id="filterForm">
    <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" id="start_date">
    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" id="end_date">
    <label for="user_id">Advertiser User ID:</label>
    <input type="text" name="user_id" id="user_id">
    <button type="button" onclick="filterData()">Apply Filters</button>
</form>

<!-- Earnings Report Table -->
<table>
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
<tbody id="tableBody">
<tr>
    <td colspan="6" style="text-align: center;">No data to display</td>
</tr>
</tbody>
</table>
</div>

<script>
function filterData() {
    const startDate = document.getElementById('start_date').value;
    const endDate = document.getElementById('end_date').value;
    const userId = document.getElementById('user_id').value;

    const xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/revenueController.php', true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    const params = `ajax=true&start_date=${encodeURIComponent(startDate)}&end_date=${encodeURIComponent(endDate)}&user_id=${encodeURIComponent(userId)}`;
    xhttp.send(params);

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const response = JSON.parse(this.responseText);

         
            document.getElementById('tableBody').innerHTML = response.tableRows;
        }
    };
}
</script>
</body>
</html>
