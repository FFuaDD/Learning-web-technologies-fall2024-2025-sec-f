<?php
require_once('../model/userModel.php');
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['user_type'] !== 'Advertiser') {
    header('Location: ../view/login.html');
    exit();
}

$advertiser_id = $_SESSION['user']['id'];
$ad_id = intval($_GET['id']);
$ad = getAdById($ad_id);

if (!$ad) {
    echo "Ad not found. Please check the ID.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $start_date = trim($_POST['start_date']);
    $end_date = trim($_POST['end_date']);
    $age = trim($_POST['age']) ?: null;
    $gender = trim($_POST['gender']) ?: 'All';
    $interests = trim($_POST['interests']) ?: null;

    $image_path = $ad['image_path'];
    $video_path = $ad['video_path'];

    // Handle file uploads
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_path = '../uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    }

    if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        $video_path = '../uploads/' . basename($_FILES['video']['name']);
        move_uploaded_file($_FILES['video']['tmp_name'], $video_path);
    }

    $result = updateAdvertisement($ad_id, $title, $description, $image_path, $video_path, $start_date, $end_date, $age, $gender, $interests);
    header('Location: advertiserAdManagement.php?status=' . ($result ? 'updated' : 'error'));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Advertisement</title>
    <style>
        body {
            background-color: #dfffe0; /* Light green */
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 50%;
        }
        h1 {
            text-align: center;
            color: #006400; /* Dark green */
        }
        label {
            display: block;
            margin-top: 5px;
            font-weight: bold;
        }
        input, textarea, select, button {
            width: 100%;
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #28a745; /* Green */
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838; /* Darker green */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Advertisement</h1>
        <form method="POST" enctype="multipart/form-data">
            <label>Title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($ad['title'] ?? ''); ?>" required>
            
            <label>Description:</label>
            <textarea name="description" required><?php echo htmlspecialchars($ad['description'] ?? ''); ?></textarea>
            
            <label>Start Date:</label>
            <input type="date" name="start_date" value="<?php echo htmlspecialchars($ad['start_date'] ?? ''); ?>" required>
            
            <label>End Date:</label>
            <input type="date" name="end_date" value="<?php echo htmlspecialchars($ad['end_date'] ?? ''); ?>" required>
            
            <label>Target Age:</label>
            <input type="text" name="age" value="<?php echo htmlspecialchars($ad['target_age'] ?? ''); ?>">
            
            <label>Target Gender:</label>
            <select name="gender">
                <option value="All" <?php echo (isset($ad['target_gender']) && $ad['target_gender'] === 'All') ? 'selected' : ''; ?>>All</option>
                <option value="Male" <?php echo (isset($ad['target_gender']) && $ad['target_gender'] === 'Male') ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo (isset($ad['target_gender']) && $ad['target_gender'] === 'Female') ? 'selected' : ''; ?>>Female</option>
            </select>
            
            <label>Target Interests:</label>
            <input type="text" name="interests" value="<?php echo htmlspecialchars($ad['target_interests'] ?? ''); ?>">
            
            <label>Image:</label>
            <input type="file" name="image" accept="image/*">
            
            <label>Video:</label>
            <input type="file" name="video" accept="video/*">
            
            <button type="submit">Update Ad</button>
        </form>
    </div>
</body>
</html>
