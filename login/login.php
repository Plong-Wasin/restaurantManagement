<?php
session_start();
include('../require/connectDB.php');
if (isset($_SESSION['username'])) {
    header('location: ../Sidebar/SidebarScreen.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="../CSS/css/profile.css">
    <!-- Icons font CSS-->
    <link href="../CSS/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../CSS/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="../CSS/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../CSS/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../CSS/css/regis.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680" style="margin-top: 10px;width: 500px;">
            <div class="card card-4" style="    max-width: 500px;">
                <div class="card-body">
                    <?php
                    $db = "SELECT `value` FROM `setting` WHERE `name` = 'background'";
                    $check = mysqli_query($conn, $db);
                    while ($record = mysqli_fetch_array($check, MYSQLI_ASSOC)) {
                        $logo = $record['value'];
                    }
                    ?>
                    <h1 style="text-align: center;"><a class="logo"><img src="../src/img/<?php echo $logo ?>" width="200" height="200"></a></h1>
                    <h2 class="title" style="    text-align: center;    font-size: 30px;">เข้าสู่ระบบ</h2>
                    <form action="login_db.php" method="post">
                        <?php if (isset($_SESSION['error'])) : ?>
                            <div class="error">
                                <h3>
                                    <?php
                                    echo $_SESSION['error'];
                                    unset($_SESSION['error']);
                                    ?>
                                </h3>
                            </div>
                        <?php endif ?>

                        <div class="input-group">
                            <label class="label" for="username">ชื่อผู้ใช้</label>
                            <input class="input--style-4 lockusername" type="text" name="username" required>
                        </div>


                        <div class="input-group">
                            <label class="label" for="password">รหัสผ่าน</label>
                            <input class="input--style-4 lockusername" type="password" name="password" required>

                        </div>
                        <div class="input-group" style="text-align: right;">
                            <button type="submit" name="login_user" class="input--style-4 lockusername" style=" color: white;    margin:0px;    background: #1a73e8;">เข้าสู่ระบบ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>