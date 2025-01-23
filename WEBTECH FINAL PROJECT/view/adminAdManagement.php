<?php
require_once('../controller/adminAdManagementController.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Ad Management</title>
    <style>
        /* Page Background */
        body {
            background-color: #dfffe0; /* Light green background */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        /* Centered Content */
        .container {
            max-width: 800px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Title */
        h1 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #3a3a3a;
        }

        /* Search Form */
        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: 70%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            background-color: #f5f5f5; /* Lighter background */
        }

        button {
            padding: 10px 20px;
            background-color: #4caf50; /* Green button */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #4caf50; /* Green header */
            color: white;
        }

        td img, td video {
            display: block;
            margin: 0 auto;
        }

        textarea {
            width: 100%;
            height: 50px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Ad Management</h1>

        <!-- Search Form -->
        <form method="GET" action="adminAdManagement.php">
            <input type="text" name="title" placeholder="Search by Title" value="<?php echo htmlspecialchars($title_search ?? ''); ?>">
            <button type="submit">Search</button>
        </form>

        <!-- Pending Ads Table -->
        <h2>Pending Advertisements</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Video</th>
                <th>Actions</th>
            </tr>
            <?php if (!empty($ads)): ?>
                <?php foreach ($ads as $ad): ?>
                    <tr>
                        <td><?php echo $ad['id']; ?></td>
                        <td><?php echo htmlspecialchars($ad['title']); ?></td>
                        <td><?php echo htmlspecialchars($ad['description']); ?></td>
                        <td>
                            <?php if (!empty($ad['image_path'])): ?>
                                <img src="<?php echo htmlspecialchars($ad['image_path']); ?>" alt="Ad Image" width="100">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($ad['video_path'])): ?>
                                <video width="200" controls>
                                    <source src="<?php echo htmlspecialchars($ad['video_path']); ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            <?php else: ?>
                                No Video
                            <?php endif; ?>
                        </td>
                        <td>
                            <form method="POST" action="../controller/adminAdManagementController.php">
                                <input type="hidden" name="ad_id" value="<?php echo $ad['id']; ?>">
                                <button type="submit" name="action" value="approve">Approve</button>
                                <textarea name="feedback" placeholder="Enter feedback"></textarea>
                                <button type="submit" name="action" value="reject">Reject</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No pending advertisements found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
