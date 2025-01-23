<?php
require_once '../model/userModel.php';


function getFilteredEarnings($filters) {
    return getEarningsReports($filters);
}


function calculateTotalRevenue($earningsData) {
    $totalRevenue = 0;
    foreach ($earningsData as $data) {
        $totalRevenue += (float)$data['amount'];
    }
    return $totalRevenue;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
    $filters = [];
    if (!empty($_POST['start_date']) && !empty($_POST['end_date'])) {
        $filters['start_date'] = $_POST['start_date'];
        $filters['end_date'] = $_POST['end_date'];
    }
    if (!empty($_POST['user_id'])) {
        $filters['user_id'] = $_POST['user_id'];
    }

    $earningsData = getFilteredEarnings($filters);
    $totalRevenue = calculateTotalRevenue($earningsData);

    $response = [
        'tableRows' => '',
        'totalRevenue' => $totalRevenue
    ];

    foreach ($earningsData as $data) {
        $response['tableRows'] .= '<tr>
            <td>' . htmlspecialchars($data['id']) . '</td>
            <td>' . htmlspecialchars($data['package']) . '</td>
            <td>' . htmlspecialchars($data['payment_method']) . '</td>
            <td>' . htmlspecialchars($data['amount']) . '</td>
            <td>' . htmlspecialchars($data['payment_status']) . '</td>
            <td>' . htmlspecialchars($data['created_at']) . '</td>
        </tr>';
    }

    if (empty($earningsData)) {
        $response['tableRows'] = '<tr>
            <td colspan="6" style="text-align: center;">No records found for the applied filters.</td>
        </tr>';
    } else {
        $response['tableRows'] .= '<tr class="total-row">
            <td colspan="3"></td>
            <td>Total Revenue: ' . number_format($totalRevenue, 2) . '</td>
            <td colspan="2"></td>
        </tr>';
    }

    echo json_encode($response);
    exit;
}
?>
