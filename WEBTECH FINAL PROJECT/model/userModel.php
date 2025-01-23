<?php

function getConnection() {
    $con = mysqli_connect('127.0.0.1', 'root', '', 'webtech');
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $con;
}

function login($username, $password) {
    $con = getConnection();
    $sql = "SELECT * FROM users WHERE username='{$username}' AND password='{$password}'";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);
    return $count == 1;
}

function addUser($username, $email, $password, $phone, $dob, $gender, $user_type) {
    $con = getConnection();
    $sql = "INSERT INTO users (username, email, password, phone, dob, gender, user_type) 
            VALUES ('{$username}', '{$email}', '{$password}', '{$phone}', '{$dob}', '{$gender}', '{$user_type}')";
    return mysqli_query($con, $sql);
}

function getUserByEmail($email) {
    $con = getConnection();
    $sql = "SELECT * FROM users WHERE email = '{$email}'";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

function getUserByUsername($username) {
    $con = getConnection();
    $sql = "SELECT * FROM users WHERE username = '{$username}'";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

function getAllUser() {
    $con = getConnection();
    $sql = "SELECT * FROM users";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function updateUserByUsername($username, $password, $email, $phone, $dob, $gender, $user_type) {
    $con = getConnection();
    $sql = "UPDATE users 
            SET password = '{$password}', email = '{$email}', phone = '{$phone}', dob = '{$dob}', gender = '{$gender}', user_type = '{$user_type}' 
            WHERE username = '{$username}'";
    return mysqli_query($con, $sql);
}

function deleteUserByUsername($username) {
    $con = getConnection();
    $sql = "DELETE FROM users WHERE username = '{$username}'";
    return mysqli_query($con, $sql);
}

function updatePasswordByUsername($username, $newPassword) {
    $con = getConnection();
    $sql = "UPDATE users SET password = '{$newPassword}' WHERE username = '{$username}'";
    return mysqli_query($con, $sql);
}

function isEmailExist($email) {
    $con = getConnection();
    $sql = "SELECT * FROM users WHERE email = '{$email}'";
    $result = mysqli_query($con, $sql);
    return mysqli_num_rows($result) > 0;
}

function getTotalUsersDetails() {
    $con = getConnection();
    $sql = "SELECT * FROM users";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die("Error fetching users: " . mysqli_error($con));
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
/*
function getTotalAdvertisements() {
    $con = getConnection();
    $sql = "SELECT * FROM advertisements";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die("Error fetching advertisements: " . mysqli_error($con));
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getRejectedAdvertisements() {
    $con = getConnection();
    $sql = "SELECT * FROM advertisements WHERE rejected = 1";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die("Error fetching rejected ads: " . mysqli_error($con));
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}*/


// Function to add advertisement with user_id
function addAdvertisement($user_id, $package, $payment_method, $amount, $payment_status = 'completed') {
    $con = getConnection();
    // Insert advertisement into the advertisements table
    $sql = "INSERT INTO advertisement (user_id, package, payment_method, amount, payment_status, created_at) 
            VALUES ('{$user_id}', '{$package}', '{$payment_method}', '{$amount}', '{$payment_status}', NOW())";
    
    if (mysqli_query($con, $sql)) {
        return true; // Return true if the query was successful
    } else {
        error_log("Error executing query: " . mysqli_error($con));
        return false; // Return false if there was an error
    }
}

function getCompletedPayments($user_id) {
    $con = getConnection(); // Using the connection from userModel.php

    // Construct the SQL query to get payments for the specific user_id
    $sql = "SELECT * FROM advertisement WHERE user_id = '{$user_id}' AND payment_status = 'completed'";

    // Execute the query
    $result = mysqli_query($con, $sql);

    // Check if query was successful
    if (!$result) {
        die("Error fetching completed payments: " . mysqli_error($con));
    }

    // Fetch all the rows from the result
    $payments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $payments[] = $row;
    }

    return $payments; // Return the array of completed payments
}
###3revenue
function getEarningsReports($filters = []) {
    $con = getConnection();
    $sql = "SELECT * FROM advertisement WHERE 1"; 

    
    if (!empty($filters)) {
        if (isset($filters['start_date']) && isset($filters['end_date'])) {
            $start_date = mysqli_real_escape_string($con, $filters['start_date']);
            $end_date = mysqli_real_escape_string($con, $filters['end_date']);
            $sql .= " AND created_at BETWEEN '$start_date' AND '$end_date'";
        }


        if (isset($filters['user_id']) && !empty($filters['user_id'])) {
            $user_id = mysqli_real_escape_string($con, $filters['user_id']);
            $sql .= " AND user_id = '$user_id'";
        }
    }

    $result = mysqli_query($con, $sql);
    if (!$result) {
        die("Error fetching earnings reports: " . mysqli_error($con));
    }
    $earnings = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $earnings[] = $row;
    }
    return $earnings;
}

#############adve
function getTotalAdvertisements() {
    $con = getConnection();
    $sql = "SELECT id, title, description, advertiser_id FROM advertisements";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die("Error in getTotalAdvertisements: " . mysqli_error($con));
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC) ?? [];
}

function getRejectedAdvertisements() {
    $con = getConnection();
    $sql = "SELECT id, title, description, advertiser_id FROM advertisements WHERE rejected = 1";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC) ?? [];
}


function createAdvertisement($advertiser_id, $title, $description, $image_path, $video_path, $start_date, $end_date, $age = null, $gender = 'All', $interests = null) {
    $con = getConnection();
    $sql = "INSERT INTO advertisements (advertiser_id, title, description, image_path, video_path, start_date, end_date, target_age, target_gender, target_interests, status, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', NOW())";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "isssssssss", $advertiser_id, $title, $description, $image_path, $video_path, $start_date, $end_date, $age, $gender, $interests);
    return mysqli_stmt_execute($stmt);
}


function getAdvertiserAdsDetails($advertiser_id) {
    $con = getConnection();
    $sql = "SELECT id, title, description, views, clicks, 
                   CASE WHEN views > 0 THEN (clicks / views) * 100 ELSE 0 END AS engagement 
            FROM advertisements WHERE advertiser_id = '$advertiser_id'";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die("Error in getAdvertiserAdsDetails: " . mysqli_error($con));
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC) ?? [];
}

function getRejectedAds($advertiser_id) {
    $con = getConnection();
    $sql = "SELECT id, title, description FROM advertisements WHERE advertiser_id = '$advertiser_id' AND rejected = 1";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die("Error in getRejectedAds: " . mysqli_error($con));
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC) ?? [];
}

function getRejectedAdsNotifications($advertiser_id) {
    $con = getConnection();
    $sql = "SELECT id, title, description FROM advertisements WHERE advertiser_id = '$advertiser_id' AND rejected = 1";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die("Error in getRejectedAdsNotifications: " . mysqli_error($con));
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC) ?? [];
}

######33admin ad management
function searchAdsByTitle($title) {
    $con = getConnection();
    $sql = "SELECT * FROM advertisements WHERE title LIKE ? AND status = 'pending'";
    $stmt = mysqli_prepare($con, $sql);
    $likeTitle = '%' . $title . '%';
    mysqli_stmt_bind_param($stmt, "s", $likeTitle);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getPendingAds() {
    $con = getConnection();
    $sql = "SELECT * FROM advertisements WHERE status = 'pending'";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function updateAdStatus($ad_id, $status, $feedback = null) {
    $con = getConnection();
    $sql = "UPDATE advertisements SET status = ?, feedback = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $status, $feedback, $ad_id);
    return mysqli_stmt_execute($stmt);
}

function createNotification($advertiser_id, $ad_id, $message) {
    $con = getConnection();
    $sql = "INSERT INTO notifications (advertiser_id, ad_id, message) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "iis", $advertiser_id, $ad_id, $message);
    return mysqli_stmt_execute($stmt);
}

function getAdById($ad_id) {
    $con = getConnection();
    $sql = "SELECT * FROM advertisements WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $ad_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}


##########faq
function getFAQsByRole($role) {
    $con = getConnection();
    $sql = "SELECT * FROM faq WHERE role = '{$role}' ORDER BY created_at DESC";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getPendingFAQs() {
    $con = getConnection();
    $sql = "SELECT * FROM faq WHERE status = 'pending' ORDER BY created_at DESC";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function addFAQ($question, $role) {
    $con = getConnection();
    $question = mysqli_real_escape_string($con, $question); // Escape special characters
    $role = mysqli_real_escape_string($con, $role); // Escape special characters
    $sql = "INSERT INTO faq (question, role, status) VALUES ('{$question}', '{$role}', 'pending')";
    return mysqli_query($con, $sql);
}


function answerFAQ($faq_id, $answer) {
    $con = getConnection();
    $sql = "UPDATE faq SET answer = '{$answer}', status = 'answered' WHERE id = {$faq_id}";
    return mysqli_query($con, $sql);
}

##advertiserAdManagementmodel
// Function to create a new advertisement
function createAdvertiserAd($advertiser_id, $title, $description, $image_path, $video_path, $start_date, $end_date, $age = null, $gender = 'All', $interests = null) {
    $con = getConnection();
    $sql = "INSERT INTO advertisements (advertiser_id, title, description, image_path, video_path, start_date, end_date, target_age, target_gender, target_interests, status, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', NOW())";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "isssssssss", $advertiser_id, $title, $description, $image_path, $video_path, $start_date, $end_date, $age, $gender, $interests);
    return mysqli_stmt_execute($stmt);
}

// Function to fetch all advertisements created by a specific advertiser
function fetchAdvertiserAds($advertiser_id) {
    $con = getConnection();
    $sql = "SELECT id, title, description, start_date, end_date, status 
            FROM advertisements 
            WHERE advertiser_id = ? 
            ORDER BY created_at DESC";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $advertiser_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Function to delete an advertisement
function deleteAdvertiserAd($ad_id) {
    $con = getConnection();
    $sql = "DELETE FROM advertisements WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $ad_id);
    return mysqli_stmt_execute($stmt);
}

// Function to update an advertisement
function updateAdvertiserAd($ad_id, $title, $description, $image_path, $video_path, $start_date, $end_date, $age = null, $gender = 'All', $interests = null) {
    $con = getConnection();
    $sql = "UPDATE advertisements 
            SET title = ?, description = ?, image_path = ?, video_path = ?, start_date = ?, end_date = ?, target_age = ?, target_gender = ?, target_interests = ?
            WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssssi", $title, $description, $image_path, $video_path, $start_date, $end_date, $age, $gender, $interests, $ad_id);
    return mysqli_stmt_execute($stmt);
}

// Function to fetch an advertisement by its ID
function fetchAdvertiserAdById($ad_id) {
    $con = getConnection();
    $sql = "SELECT * FROM advertisements WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $ad_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

// Function to fetch notifications for an advertiser
function fetchAdvertiserNotifications($advertiser_id) {
    $con = getConnection();
    $sql = "SELECT n.id, n.ad_id, n.message, n.created_at, a.title 
            FROM notifications n
            JOIN advertisements a ON n.ad_id = a.id
            WHERE n.advertiser_id = ?
            ORDER BY n.created_at DESC";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $advertiser_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Function to fetch all approved advertisements
function fetchApprovedAds() {
    $con = getConnection();
    $sql = "SELECT * FROM advertisements WHERE status = 'approved'";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
function getAdvertisementsByAdvertiser($advertiser_id) {
    $con = getConnection();
    $sql = "SELECT id, title, description, start_date, end_date, status 
            FROM advertisements 
            WHERE advertiser_id = ? 
            ORDER BY created_at DESC";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $advertiser_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
//update
function updateAdvertisement($ad_id, $title, $description, $image_path, $video_path, $start_date, $end_date, $age = null, $gender = 'All', $interests = null) {
    $con = getConnection();
    $sql = "UPDATE advertisements 
            SET title = ?, description = ?, image_path = ?, video_path = ?, start_date = ?, end_date = ?, target_age = ?, target_gender = ?, target_interests = ?
            WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssssi", $title, $description, $image_path, $video_path, $start_date, $end_date, $age, $gender, $interests, $ad_id);
    return mysqli_stmt_execute($stmt);
}
/*
function getNotificationsByAdvertiser($advertiser_id) {
    $con = getConnection();
    $sql = "SELECT * FROM notifications WHERE advertiser_id = ? ORDER BY created_at DESC";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $advertiser_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
*/


// Add ad to favourites
function addToFavourites($user_id, $ad_id) {
    $con = getConnection();
    $checkQuery = "SELECT * FROM user_favourite WHERE user_id = ? AND ad_id = ?";
    $stmt = mysqli_prepare($con, $checkQuery);
    mysqli_stmt_bind_param($stmt, 'ii', $user_id, $ad_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) === 0) {
        $insertQuery = "INSERT INTO user_favourite (user_id, ad_id) VALUES (?, ?)";
        $stmt = mysqli_prepare($con, $insertQuery);
        mysqli_stmt_bind_param($stmt, 'ii', $user_id, $ad_id);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_close($con);
            return "Ad added to favourites.";
        }
    } else {
        mysqli_close($con);
        return "Ad is already in your favourites.";
    }
    mysqli_close($con);
    return "Failed to add ad to favourites.";
}

// Remove ad from favourites
function removeFromFavourites($user_id, $ad_id) {
    $con = getConnection();
    $deleteQuery = "DELETE FROM user_favourite WHERE user_id = ? AND ad_id = ?";
    $stmt = mysqli_prepare($con, $deleteQuery);
    mysqli_stmt_bind_param($stmt, 'ii', $user_id, $ad_id);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_close($con);
        return "Ad removed from favourites.";
    }
    mysqli_close($con);
    return "Failed to remove ad from favourites.";
}

// Fetch user's favourite ads
function getFavourites($user_id) {
    $con = getConnection();
    $query = "
        SELECT a.id, a.title, a.description 
        FROM user_favourite uf 
        JOIN advertisements a ON uf.ad_id = a.id 
        WHERE uf.user_id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $favourites = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($con);
    return $favourites;
}


######contact us
function addContactInformation($name, $email, $phone, $message, $contact_method) {
    $con = getConnection(); 
    $sql = "INSERT INTO contact_requests (name, email, phone, message, contact_method) 
            VALUES ('{$name}', '{$email}', '{$phone}', '{$message}', '{$contact_method}')";
    return mysqli_query($con, $sql); 
}



function deleteUser($user_id) {
    $con = getConnection();
    $sql = "DELETE FROM users WHERE id = {$user_id}";
    $result = mysqli_query($con, $sql);

    return $result;  
}


#####notification
function getNotificationsByAdvertiser($advertiser_id, $search = null, $date = null) {
    $con = getConnection();
    $sql = "SELECT * FROM notifications WHERE advertiser_id = ?";
   
    if ($search) {
        $sql .= " AND message LIKE ?";
    }
    if ($date) {
        $sql .= " AND DATE(created_at) = ?";
    }
   
    $sql .= " ORDER BY created_at DESC";
    $stmt = mysqli_prepare($con, $sql);
   
    if ($search && $date) {
        $search = "%$search%";
        mysqli_stmt_bind_param($stmt, "iss", $advertiser_id, $search, $date);
    } elseif ($search) {
        $search = "%$search%";
        mysqli_stmt_bind_param($stmt, "is", $advertiser_id, $search);
    } elseif ($date) {
        mysqli_stmt_bind_param($stmt, "is", $advertiser_id, $date);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $advertiser_id);
    }
   
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
 
function markNotificationAsRead($notification_id) {
    $con = getConnection();
    $sql = "UPDATE notifications SET is_read = 1 WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $notification_id);
    return mysqli_stmt_execute($stmt);
}


####viewer
function getApprovedAdvertisements() {
    $con = getConnection();
    $sql = "SELECT * FROM advertisements WHERE status = 'approved'";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

?>
