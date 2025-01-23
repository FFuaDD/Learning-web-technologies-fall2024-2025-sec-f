<?php
session_start();
require_once('../model/userModel.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];
$user = getUserByUsername($username);

if (!$user) {
    echo "User not found!";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];

    if (empty($email) || empty($phone) || empty($dob) || empty($gender)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif (strlen($phone) !== 11 || !ctype_digit($phone)) {
        $error = "Phone number must be exactly 11 digits.";
    } elseif (strtotime($dob) > strtotime("-10 years")) {
        $error = "You must be at least 10 years old.";
    } elseif (isEmailExist($email) && $email !== $user['email']) {  
        $error = "Email is already in use by another account.";
    } else {
        $password = $user['password'];
        $user_type = $user['user_type'];

        if (updateUserByUsername($username, $password, $email, $phone, $dob, $gender, $user_type)) {
            $_SESSION['user'] = getUserByUsername($username); // Refresh session data

            $successMessage = "Information changed successfully!";
  
            if ($user_type == "Admin") {
                header("Location: ../view/menu_admin.html");
            } elseif ($user_type == "Advertiser") {
                header("Location: ../view/menu_advertiser.html");
            } elseif ($user_type == "Viewer") {
                header("Location: ../view/menu_viewer.html");
            } else {
                header("Location: login.html");
            }
            exit();
        } else {
            $error = "Failed to update profile. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            width: 50%;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"], .back-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px;
        }
        input[type="submit"]:hover, .back-button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            font-weight: bold;
        }
        .success {
            color: green;
            font-weight: bold;
        }
    </style>
    <script>
        function validateForm() {
            var email = document.forms["editProfileForm"]["email"].value;
            var phone = document.forms["editProfileForm"]["phone"].value;
            var dob = document.forms["editProfileForm"]["dob"].value;
            var gender = document.forms["editProfileForm"]["gender"].value;
            var errorMessage = "";

            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (email == "") {
                errorMessage += "Email is required.\n";
            } else if (!emailPattern.test(email)) {
                errorMessage += "Please enter a valid email address.\n";
            }

            if (phone == "") {
                errorMessage += "Phone number is required.\n";
            } else if (!/^\d{11}$/.test(phone)) {
                errorMessage += "Phone number must be exactly 11 digits.\n";
            }

            var dobDate = new Date(dob);
            var today = new Date();
            var age = today.getFullYear() - dobDate.getFullYear();
            if (dob == "") {
                errorMessage += "Date of birth is required.\n";
            } else if (age < 10) {
                errorMessage += "You must be at least 10 years old.\n";
            }

            if (gender == "") {
                errorMessage += "Gender is required.\n";
            }

            if (errorMessage != "") {
                alert(errorMessage);
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<div class="container">
    <h1>Edit Profile</h1>

    <?php if (isset($successMessage)) { ?>
        <p class="success"><?php echo $successMessage; ?></p>
        <a href="menu_<?php echo strtolower($user['user_type']); ?>.html">
            <button type="button" class="back-button">Go Back to Menu</button>
        </a>
    <?php } ?>

    <form name="editProfileForm" method="post" action="" onsubmit="return validateForm()">
        <label for="username"><b>Username:</b></label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" readonly><br>

        <label for="email"><b>Email:</b></label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"><br>

        <label for="phone"><b>Phone Number:</b></label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>"><br>

        <label for="dob"><b>Date of Birth:</b></label>
        <input type="date" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>"><br>

        <label for="gender"><b>Gender:</b></label>
        <select name="gender">
            <option value="Male" <?php if ($user['gender'] == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($user['gender'] == 'Female') echo 'selected'; ?>>Female</option>
            <option value="Other" <?php if ($user['gender'] == 'Other') echo 'selected'; ?>>Other</option>
        </select><br><br>

        <input type="submit" value="Save Changes">

        <a href="menu_<?php echo strtolower($user['user_type']); ?>.html">
            <button type="button" class="back-button">Go Back to Menu</button>
        </a>

        <?php
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>
    </form>
</div>

</body>
</html>
