<?php
session_start();
require_once("../require/connectDB.php");
if (isset($_POST["code"]) || isset($_SESSION["code"])) {
    if (isset($_SESSION["code"])) {
        $code = mysqli_escape_string($conn, $_SESSION['code']);
    } else if (isset($_POST["code"])) {
        $code = mysqli_escape_string($conn, $_POST['code']);
    }
    $query = "SELECT table_id FROM `check_in` WHERE `code` = $code AND paid_timestamp IS NULL ORDER BY check_in_timestamp DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['code'] = $code;
        header("Location:../order/orderFood.php");
    } else {
        if (isset($_POST["code"]))
            echo '<script>alert("รหัสผิดพลาด")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    include_once("../require/req.php");
    ?>
</head>

<body>
    <div class="container">
        <form action="" method="POST">
            <input type="number" name="code" id="code" required>
            <button type="submit" class="btn btn-primary">ไปหน้าสั่งอาหาร</button>
        </form>
    </div>
</body>

</html>