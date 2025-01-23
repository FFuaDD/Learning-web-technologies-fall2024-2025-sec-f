<?php
require_once('../controller/viewerAdManagementController.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Advertisements</title>
    <style>
        body {
            background-color: #f0f8ff; /* Light blue */
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4682B4;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Available Advertisements</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
            <?php if (!empty($ads)): ?>
                <?php foreach ($ads as $ad): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($ad['id']); ?></td>
                        <td><?php echo htmlspecialchars($ad['title']); ?></td>
                        <td><?php echo htmlspecialchars($ad['description']); ?></td>
                        <td><?php echo htmlspecialchars($ad['start_date']); ?></td>
                        <td><?php echo htmlspecialchars($ad['end_date']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No advertisements available.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
