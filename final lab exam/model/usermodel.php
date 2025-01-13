<?php

function getConnection() {
    $con = mysqli_connect('127.0.0.1', 'root', '', 'employee');
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $con;
}

function login($username, $password) {
    $con = getConnection();
    $sql = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'";
    $result = mysqli_query($con, $sql);
    return mysqli_num_rows($result) === 1;
}

function addUser($name, $contact_no, $password, $username) {
    $con = getConnection();
    $sql = "INSERT INTO users (name, contact_no, password, username) VALUES ('{$name}', '{$contact_no}', '{$password}', '{$username}')";
    return mysqli_query($con, $sql);
}



function checkIfUsernameExists($username) {
    $con = getConnection();
    $sql = "SELECT COUNT(*) AS count FROM users WHERE username = '{$username}'";
    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($result);
    return $data['count'] > 0;
}





function getUserByUsername($username) {
    $con = getConnection();
    $sql = "SELECT * FROM users WHERE username = '{$username}'";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}
function getAllUsers() {
    $con = getConnection();
    $sql = "SELECT * FROM users";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function searchUsers($searchTerm) {
    $con = getConnection();
    $sql = "SELECT * FROM users WHERE username LIKE '%{$searchTerm}%'";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function updateUser($name, $contact_no, $password, $username) {
    $con = getConnection();
    $sql = "UPDATE users SET name='{$name}', contact_no='{$contact_no}', password='{$password}' WHERE username='{$username}'";
    return mysqli_query($con, $sql);
}

function deleteUser($username) {
    $con = getConnection();
    $sql = "DELETE FROM users WHERE username='{$username}'";
    return mysqli_query($con, $sql);
}

?>
