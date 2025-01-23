<html>
<head>
    <title>Admin Dashboard</title>
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
    <h1>Welcome, Admin!</h1>
   
    <!-- Total Users Table -->
    <h2>Total Users</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>User Type</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        <?php if (!empty($users)): ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['fullname']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['phone']; ?></td>
                    <td><?php echo $user['dob']; ?></td>
                    <td><?php echo $user['gender']; ?></td>
                    <td><?php echo $user['user_type']; ?></td>
                    <td><?php echo $user['created_at']; ?></td>
                    <td>
                        <a href="viewUser.php?id=<?php echo $user['id']; ?>">View</a> |
                        <a href="editUser.php?id=<?php echo $user['id']; ?>">Edit</a> |
                        <a href="deleteUser.php?id=<?php echo $user['id']; ?>">Deactivate</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10">No users found.</td>
            </tr>
        <?php endif; ?>
    </table>

    <h2>Total Advertisements</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Advertiser ID</th>
        </tr>
        <?php if (!empty($ads)): ?>
            <?php foreach ($ads as $ad): ?>
                <tr>
                    <td><?php echo $ad['id']; ?></td>
                    <td><?php echo $ad['title']; ?></td>
                    <td><?php echo $ad['description']; ?></td>
                    <td><?php echo $ad['advertiser_id']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No advertisements found.</td>
            </tr>
        <?php endif; ?>
    </table>

    <!-- Rejected Advertisements Table -->
    <h2>Rejected Advertisements</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Advertiser ID</th>
        </tr>
        <?php if (!empty($rejected_ads)): ?>
            <?php foreach ($rejected_ads as $rejected_ad): ?>
                <tr>
                    <td><?php echo $rejected_ad['id']; ?></td>
                    <td><?php echo $rejected_ad['title']; ?></td>
                    <td><?php echo $rejected_ad['description']; ?></td>
                    <td><?php echo $rejected_ad['advertiser_id']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No rejected advertisements found.</td>
            </tr>
        <?php endif; ?>
    </table>


    <h2>Pending Advertisements</h2>
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
    <?php if (!empty($pending_ads)): ?>
        <?php foreach ($pending_ads as $ad): ?>
            <tr>
                <td><?php echo $ad['id']; ?></td>
                <td><?php echo $ad['title']; ?></td>
                <td><?php echo $ad['description']; ?></td>
                <td><?php echo $ad['views']; ?></td>
                <td><?php echo $ad['clicks']; ?></td>
                <td><?php echo number_format($ad['engagement'], 2); ?>%</td>
                <td>
                    <form method="POST" action="../controller/adManagementController.php">
                        <input type="hidden" name="ad_id" value="<?php echo $ad['id']; ?>">
                        <button type="submit" name="action" value="approve">Approve</button>
                        <button type="submit" name="action" value="reject">Reject</button>
                        <textarea name="admin_comments" placeholder="Add comments"></textarea>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="7">No pending advertisements found.</td></tr>
    <?php endif; ?>
</table>


    <a href="../controller/logout.php">Logout</a>
</body>
</html>
