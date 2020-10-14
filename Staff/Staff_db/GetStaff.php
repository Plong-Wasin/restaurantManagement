<?php
require_once('../../require/connectDB.php');

$errors = array();

$username = mysqli_real_escape_string($conn, $_POST['username']);
$role = mysqli_real_escape_string($conn, $_POST['role']);
$password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
$password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);


$user_check_query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
$query11 = mysqli_query($conn, $user_check_query);
$result11 = mysqli_fetch_assoc($query11);

if ($result11) {
    if ($result11['username'] === $username) {
        echo '<script>alert("Welcome to Geeks for Geeks")</script>';
    }
} else {
    $password = $password_1;

    $sql = "INSERT INTO users (username, role, password) VALUES ('$username', '$role', '$password')";
    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
