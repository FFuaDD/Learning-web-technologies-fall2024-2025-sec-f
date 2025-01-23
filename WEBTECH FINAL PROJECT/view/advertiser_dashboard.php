<html>
<head>
    <title>Advertiser Dashboard</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Welcome, Advertiser!</h1>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <p style="color: green;">Advertisement created successfully!</p>
    <?php endif; ?>

    <!-- Create New Advertisement -->
    <h2>Create New Advertisement</h2>
<form method="POST" action="../controller/advertiserController.php">
    Title: <input type="text" name="title" required><br>
    Description: <textarea name="description" required></textarea><br>
    Start Date: <input type="date" name="start_date" required><br>
    End Date: <input type="date" name="end_date" required><br>
    Target Demographics: <textarea name="target_demographics" required></textarea><br>
    <button type="submit">Create Ad</button>
</form>


    <!-- View Total Ads Table -->
    <h2>Your Advertisements</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Views</th>
            <th>Clicks</th>
            <th>Engagement</th>
            <th>Actions</th>
        </tr>
        <?php if (!empty($ads_details)): ?>
            <?php foreach ($ads_details as $ad): ?>
                <tr>
                    <td><?php echo $ad['id']; ?></td>
                    <td><?php echo $ad['title']; ?></td>
                    <td><?php echo $ad['description']; ?></td>
                    <td><?php echo $ad['views']; ?></td>
                    <td><?php echo $ad['clicks']; ?></td>
                    <td><?php echo number_format($ad['engagement'], 2); ?>%</td>
                    <td>
                        <a href="editAd.php?id=<?php echo $ad['id']; ?>">Edit</a> |
                        <a href="deleteAd.php?id=<?php echo $ad['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No advertisements found.</td>
            </tr>
        <?php endif; ?>
    </table>

    <!-- View Rejected Ads Table -->
    <h2>Rejected Advertisements</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
        </tr>
        <?php if (!empty($rejected_ads)): ?>
            <?php foreach ($rejected_ads as $rejected_ad): ?>
                <tr>
                    <td><?php echo $rejected_ad['id']; ?></td>
                    <td><?php echo $rejected_ad['title']; ?></td>
                    <td><?php echo $rejected_ad['description']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No rejected advertisements found.</td>
            </tr>
        <?php endif; ?>
    </table>

    <!-- Rejected Ads Notifications -->
    <h2>Notifications for Rejected Advertisements</h2>
    <ul>
        <?php if (!empty($rejected_ads_notifications)): ?>
            <?php foreach ($rejected_ads_notifications as $notification): ?>
                <li>
                    <?php echo $notification['title']; ?> - <?php echo $notification['description']; ?>
                    (<a href="editAd.php?id=<?php echo $notification['id']; ?>">Edit</a>)
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No notifications found.</li>
        <?php endif; ?>
    </ul>

    <a href="../controller/logout.php">Logout</a>
</body>
</html>
