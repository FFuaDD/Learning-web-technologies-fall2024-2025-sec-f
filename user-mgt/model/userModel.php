<?php

function getConnection() {
    $con = mysqli_connect('127.0.0.1', 'root', '', 'webtechh');
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $con;
}

function login($username, $password){
    $con = getConnection();
    $sql = "SELECT * FROM users WHERE username='{$username}' AND password='{$password}'";
    $result = mysqli_query($con, $sql);
    $count =  mysqli_num_rows($result);
    return $count == 1;
}

function addUser($username, $password, $email){
    $con = getConnection();
    $sql = "INSERT INTO users (username, password, email) VALUES ('{$username}', '{$password}', '{$email}')";
    return mysqli_query($con, $sql);
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

function updateUserByUsername($username, $password, $email) {
    $con = getConnection();
    $sql = "UPDATE users SET password = '{$password}', email = '{$email}' WHERE username = '{$username}'";
    return mysqli_query($con, $sql);
}

function deleteUserByUsername($username) {
    $con = getConnection();
    $sql = "DELETE FROM users WHERE username = '{$username}'";
    return mysqli_query($con, $sql);
}

?>