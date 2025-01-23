<?php
// session_start();
// require_once('../controller/advertiserNotificationController.php');

// if (!isset($_SESSION['user']) || $_SESSION['user']['user_type'] !== 'Advertiser') {
//     header('Location: ../view/login.html');
//     exit();
// }

// echo "Welcome, " .$_SESSION['user'] ."! Here are your notifications.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Notifications</title>
    <style>
        body {
            background-color: #f0f8ff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #e0f7fa;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .date {
            font-size: 0.9em;
            color: #555;
        }

        form {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Notifications</h1>

        <!-- Search and Filter Form -->
        <form id="filterForm">
            <input type="text" id="search" name="search" placeholder="Enter keyword">
            <input type="date" id="date" name="date">
            <button type="button" id="filterBtn">Filter</button>
        </form>

        <!-- Notification List -->
        <ul id="notificationList">
            <?php if (!empty($notifications)): ?>
                <?php foreach ($notifications as $notification): ?>
                    <li>
                        <p><?php echo htmlspecialchars($notification['message']); ?></p>
                        <p class="date"><?php echo htmlspecialchars($notification['created_at']); ?></p>
                        <button class="markAsReadBtn" data-id="<?php echo $notification['id']; ?>">Mark as Read</button>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No notifications available.</li>
            <?php endif; ?>
        </ul>
        
    </div>

    <script>
        // Filter Notifications with Form Validation
        document.getElementById('filterBtn').addEventListener('click', () => {
            const search = document.getElementById('search').value;
            const date = document.getElementById('date').value;

            // Validation: Check if either field is empty
            if (search.trim() === "" && date.trim() === "") {
                alert("Please enter a keyword or select a date to filter notifications.");
                return; // Prevent the AJAX request if validation fails
            }

            // If validation passes, proceed with the AJAX request
            fetch('../controller/advertiserNotificationController.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ search, date })
            })
            .then(response => response.json())
            .then(data => {
                const notificationList = document.getElementById('notificationList');
                notificationList.innerHTML = '';
                if (data.length === 0) {
                    notificationList.innerHTML = '<li>No notifications found for the given filter.</li>';
                } else {
                    data.forEach(notification => {
                        notificationList.innerHTML += 
                            `<li>
                                <p>${notification.message}</p>
                                <p class="date">${notification.created_at}</p>
                                <button class="markAsReadBtn" data-id="${notification.id}">Mark as Read</button>
                            </li>`;
                    });
                }
            })
            .catch(error => {
                alert("An error occurred while fetching notifications.");
            });
        });

        // Mark as Read
        document.addEventListener('click', (event) => {
            if (event.target.classList.contains('markAsReadBtn')) {
                const notificationId = event.target.dataset.id;

                fetch('../controller/advertiserNotificationController.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action: 'markAsRead', notificationId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        event.target.parentElement.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>
</html>
