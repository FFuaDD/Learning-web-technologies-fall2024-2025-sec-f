<?php
require_once('../controller/userManagementController.php');
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Management</title>
    <style>
        body {
            background-color: #f0f8ff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
 
        .container {
            max-width: 900px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
 
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
 
        table {
            width: 100%;
            border-collapse: collapse;
        }
 
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
 
        th {
            background-color: #4682B4;
            color: white;
        }
 
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
 
        tr:hover {
            background-color: #d9edf7;
        }
 
        form {
            display: inline-block;
        }
 
        button {
            padding: 5px 10px;
            background-color: #4682B4;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
 
        button:hover {
            background-color: #4169E1;
        }
 
        #filter {
            margin-bottom: 20px;
            padding: 10px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Management</h1>
 
        <input type="text" id="filter" placeholder="Filter users by username" onkeyup="filterUsers()">
 
        <table id="userTable">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Actions</th>
            </tr>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr id="user-<?php echo $user['id']; ?>">
                        <td><?php echo $user['id']; ?></td>
                        <td class="username"><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo ucfirst($user['user_type']); ?></td>
                        <td>
                            <button onclick="deleteUser(<?php echo $user['id']; ?>)">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No users found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
 
    <script>
        function deleteUser(userId) {
            if (!confirm('Are you sure you want to delete this user?')) return;
 
            let xhttp = new XMLHttpRequest();
            xhttp.open('POST', 'deleteUser.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send('user_id=' + userId);
 
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(this.responseText);
                    if (response.success) {
                        const row = document.getElementById('user-' + userId);
                        row.parentNode.removeChild(row);
                    } else {
                        alert('Failed to delete user: ' + response.message);
                    }
                } else if (this.readyState == 4) {
                    alert("Error: " + this.status);
                }
            };
        }
 
        function filterUsers() {
            const filter = document.getElementById('filter').value.toLowerCase();
            const rows = document.querySelectorAll('#userTable tr:not(:first-child)');
 
            rows.forEach(row => {
                const username = row.querySelector('.username').textContent.toLowerCase();
                if (username.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>