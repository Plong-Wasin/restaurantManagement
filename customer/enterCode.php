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
    <link rel="stylesheet" href="../CSS/enterCode.css">
    <title>enterCode</title>
    <?php
    include_once("../require/req.php");


    ?>


</head>

<body>
    <?php
    $sql = "SELECT value FROM setting WHERE name='background'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_array($result)) {
            $logo = $row["value"];
        }
    }
    $sql = "SELECT value FROM setting WHERE name='restaurant_name'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_array($result)) {
            $name = $row["value"];
        }
    }
    ?>

    <div class=" box" style="text-align: center;">
        <form action="" method="POST" style="border-style: solid;border-radius: 70px;border-width: 10px;">
            <p>

                <img src="../src/img/<?php echo $logo ?>" width="200px" height="200px">
                <h1>ยินดีต้อนรับเข้าสู่ร้าน <br>"<?php echo $name; ?>"</h1>
                <input type="number" name="code" id="code" class="inputC" maxlength="4" onkeyup="cut()" required>
                <button type="submit" class="btn btn-primary" style="
    height: 37px;
    margin-bottom: 2px;
    text-align: center;
    padding-top: 2px;
"><img src="../src/img/send.png" width="20px" height="20px"></button>
            </p>
        </form>
    </div>
    <script>
        function cut() {
            if (document.getElementById("code").value.length > 4) {
                document.getElementById("code").value = document.getElementById("code").value.substring(0, 4);
            }
        }
    </script>
</body>

</html>