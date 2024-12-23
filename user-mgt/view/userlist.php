<?php
session_start();
include_once '../model/userModel.php';

if (isset($_COOKIE['flag'])) {
    $con = getConnection();
    $sql = "SELECT * FROM users";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $users = [];
    }
?>

<html>
<head>
    <title>User List</title>
    <a href="home.php">Home</a>
    <a href="logout.php">LOGOUT</a>
</head>
<body>
    <h2>User List</h2>
    <table border="1">
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php 
        foreach ($users as $user) {
        ?>
        <tr>
            <td><?php echo htmlspecialchars($user['username']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td>
                <a href="edit.php?username=<?php echo htmlspecialchars($user['username']); ?>">EDIT</a> |
                <a href="delete.php?username=<?php echo htmlspecialchars($user['username']); ?>">DELETE</a>
            </td>
        </tr>
        <?php 
        }
        ?>
    </table>
</body>
</html>

<?php
    mysqli_close($con);
} else {
    header('Location: login.html');
    exit();
}
?>