<?php
include('../require/connectDB.php');

$errors = array();

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "กรุณาระบุชื่อผู้ใช้");
    }

    if (empty($password)) {
        array_push($errors, "กรุณาระบุรหัสผ่าน");
    }

    if (count($errors) == 0) {
        session_destroy();
        session_unset();
        session_start();
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
        $result = mysqli_query($conn, $query);
        while ($re = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $role  = $re['role'];
        }

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] =  $role;
            header("location:../Sidebar/SidebarScreen.php");
        } else {
            array_push($errors, "ชื่อผู้ใช้หรือรหัสผ่านผิด");
            $_SESSION['error'] = "ชื่อผู้ใช้หรือรหัสผ่านผิด";
            header("location: login.php");
        }
    } else {
        array_push($errors, "ต้องระบุชื่อผู้ใช้และรหัสผ่าน");
        $_SESSION['error'] = "ต้องระบุชื่อผู้ใช้และรหัสผ่าน";
        header("location: login.php");
    }
}
