<?php
session_start();
require_once('server.php');

$errors = array();

$username = mysqli_real_escape_string($conn, $_POST['username']);
$role = mysqli_real_escape_string($conn, $_POST['role']);
$password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
$password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);


$user_check_query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
$query = mysqli_query($conn, $user_check_query);
$result = mysqli_fetch_assoc($query);

if ($result) { // if user exists
    if ($result['username'] === $username) {
        echo '<script>alert("Username already exists");</script>';
    }
    echo '<script>alert("test");</script>';
} else {
    $password = $password_1;

    $sql = "INSERT INTO users (username, role, password) VALUES ('$username', '$role', '$password')";
    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
}
