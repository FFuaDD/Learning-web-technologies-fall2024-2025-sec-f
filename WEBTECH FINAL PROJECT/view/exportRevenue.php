<?php
require_once __DIR__ . '/../model/userModel.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="revenue_report.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, ['Advertiser Name', 'Total Revenue', 'Total Ads']);

$earningsReport = getEarningsReport();

foreach ($earningsReport as $report) {
    fputcsv($output, [$report['advertiser_name'], $report['total_revenue'], $report['total_ads']]);
}

fclose($output);
exit();
?>
