<?php
require_once('../model/userModel.php');
session_start();
/*
if (!isset($_SESSION['user']) || $_SESSION['user']['user_type'] !== 'Advertiser') {
    header('Location: ../view/login.html');
    exit();
}
*/

$advertiser_id = $_SESSION['user_id'];
$ads_details = getAdvertisementsByAdvertiser($advertiser_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Advertiser Ad Management</title>
    <style>
        /* Page Background */
        body {
            background-color: #87CEEB; /* Sky blue background */
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1, h2 {
            margin-bottom: 20px;
            color: #003366;
        }

        /* Form Styling */
        form {
            margin-bottom: 30px;
            text-align: left;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="text"], input[type="date"], select, textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        button {
            padding: 10px 20px;
            background-color: #4682B4; /* Medium blue */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4169E1; /* Darker blue on hover */
        }

        /* Table Styling */
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
            background-color: #4682B4; /* Medium blue */
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Alternate row color */
        }

        tr:hover {
            background-color: #d9edf7; /* Highlight row on hover */
        }

        td {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Advertiser Ad Management</h1>

        <!-- Create New Advertisement -->
        <h2>Create New Advertisement</h2>
        <form method="POST" action="../controller/advertiserController.php" enctype="multipart/form-data">
            <label>Title:</label>
            <input type="text" name="title" required>
            <label>Description:</label>
            <textarea name="description" required></textarea>
            <label>Start Date:</label>
            <input type="date" name="start_date" required>
            <label>End Date:</label>
            <input type="date" name="end_date" required>
            <label>Target Age:</label>
            <input type="text" name="age" placeholder="e.g., 18-25">
            <label>Target Gender:</label>
            <select name="gender">
                <option value="All">All</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <label>Target Interests:</label>
            <input type="text" name="interests" placeholder="e.g., gaming, technology">
            <label>Image:</label>
            <input type="file" name="image" accept="image/*">
            <label>Video:</label>
            <input type="file" name="video" accept="video/*">
            <button type="submit" name="action" value="create_ad">Create Ad</button>
        </form>

        <!-- Your Advertisements -->
        <h2>Your Advertisements</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php if (!empty($ads_details)): ?>
                <?php foreach ($ads_details as $ad): ?>
                    <tr>
                        <td><?php echo $ad['id']; ?></td>
                        <td><?php echo htmlspecialchars($ad['title']); ?></td>
                        <td><?php echo htmlspecialchars($ad['description']); ?></td>
                        <td><?php echo htmlspecialchars($ad['start_date']); ?></td>
                        <td><?php echo htmlspecialchars($ad['end_date']); ?></td>
                        <td><?php echo ucfirst(htmlspecialchars($ad['status'])); ?></td>
                        <td>
                            <a href="../view/editAd.php?id=<?php echo $ad['id']; ?>">Edit</a> 
                            <form method="POST" action="../controller/advertiserController.php" style="display:inline;">
                               
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No advertisements found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
