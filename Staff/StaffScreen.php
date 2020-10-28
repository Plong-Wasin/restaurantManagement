<?php include('../Session/Check_Session.php'); ?>
<?php
include('../require/connectDB.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>พนักงาน</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../CSS/css/main.css">
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
    <div class="limiter">
        <div class="container-table100">
            <div class="wrap-table100">
                <div class="table100">
                    <div id="spanusers">
                        <table>
                            <thead>
                                <tr class="table100-head">
                                    <th>ชื่อผู้ใช้</th>
                                    <th>ชื่อพนักงาน</th>
                                    <th>ตำแหน่ง</th>
                                    <th>รหัสผ่าน</th>
                                    <th>แก้ไขข้อมูล</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <?php
                                $readstaff = "SELECT * FROM users";
                                $result = mysqli_query($conn, $readstaff);
                                if ($result) {
                                    while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td>" . $record['username'] . "</td>";
                                        if ($record['first_name']  == 0) {
                                            echo "<td>" . "ยังไม่มีข้อมูล" . "</td>";
                                        } else {
                                            echo "<td>" . $record['first_name'] . "     " . $record['last_name'] . "</td>";
                                        }
                                        echo "<td>" . $record['role'] . "</td>";
                                        echo "<td>" . $record['password'] . "</td>";
                                        //echo '<td><button type="button" name="id-to-del" value="' . $record['username'] . '" onclick="deletestaff(' . $record['username'] . ')>ลบ</button></td>';
                                ?>
                                        <td>
                                            <img class="ImgDelete" style="width: 20px;height: 27px;" value=" <?php echo $record['username'] ?> " onclick="deletestaff('<?php echo $record['username'] ?> ')" src="../src/img/t.png">
                                            <img class="ImgDelete" style="width: 20px;height: 20px;margin-bottom: 3px;" value="" src="../src/img/edit.png" onclick="window.location.href='../editProfile/editProfileByadmin.php?id=<?php echo $record['id'] ?>'">
                                        </td>
                                <?php echo '</tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
            <div class="wrapper wrapper--w680">
                <div class="card card-4">
                    <div class="card-body">
                        <h2 class="title">เพิ่มพนักงาน</h2>
                        <form id="registerForm" method="POST" onsubmit="return false">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label" for="username">ชื่อผู้ใช้<br></label>
                                    <input class="input--style-4" type="text" name="username" id="username" required>
                                </div>
                            </div>
                            <div class="input-group">
                                <label class="label">ตำแหน่ง</label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select class="selectjob" type="role" name="role" value="<?php echo $role; ?>" required>
                                        <option disabled="disabled" selected="selected" value="">เลือกตำแหน่ง</option>
                                        <option value="admin">ผู้ดูแลร้าน</option>
                                        <option value="WelcomeStaff">พนักงานต้อนรับ</option>
                                        <option value="ServiceStaff">พนักงานบริการ</option>
                                        <option value="KitchenStaff">พนักงานในห้องครัว</option>
                                        <option value="CashierStaff">พนักงานเก็บเงิน</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label" for="password_1">รหัสผ่าน<br></label>
                                    <input class="input--style-4" type="text" type="password" name="password_1" id="password_1" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label" for="password_2">ยืนยันรหัสผ่าน<br></label>
                                    <input class="input--style-4" type="text" type="password" name="password_2" id="password_2" required>
                                </div>
                            </div>
                            <div cclass="p-t-15">
                                <div class="ButtonRegister">
                                    <button class="btn btn--radius-2 btn--blue" id="ButtonRegister" type="submit" name="reg_user" class="btn">ยืนยัน</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jquery JS-->
        <script src="../CSS/vendor/jquery/jquery.min.js"></script>
        <!-- Vendor JS-->
        <script src="../CSS/vendor/select2/select2.min.js"></script>
        <script src="../CSS/vendor/datepicker/moment.min.js"></script>
        <script src="../CSS/vendor/datepicker/daterangepicker.js"></script>

        <!-- Main JS-->
        <script src="../CSS/js/global.js"></script>
</body>
<script>
    $(document).ready(function() {
        document.getElementsByClassName("ButtonRegister")[0].click();
        $('#registerForm').on("submit", function(event) {
            if (document.getElementById("password_1").value != document.getElementById("password_2").value) {
                alert("รหัสผ่านไม่ตรงกัน");
                document.getElementById("registerForm").reset;
            } else if (document.getElementById("username").value.length < 6 || document.getElementById("username").value.length > 10) {
                alert("ชื่อผู้ใช้ต้องมีไม่น้อยกว่า 6 ตัวอักษร และ ห้ามเกิน 10 ตัวอักษร");
                document.getElementById("username").value = '';
            } else if (document.getElementById("password_1").value.length < 6 || document.getElementById("password_1").value.length > 10) {
                alert("รหัสผ่านต้องมีไม่น้อยกว่า 6 ตัวอักษร และ ห้ามเกิน 10 ตัวอักษร");
                document.getElementById("password_1").value = '';
                document.getElementById("password_2").value = '';
            } else {
                event.preventDefault();
                $.ajax({
                    url: "./Staff_db/GetStaff.php",
                    method: "POST",
                    data: $('#registerForm').serialize(),
                    success: function(data) {
                        if (data == 'error') {
                            alert("มีชื่อผู้ใช้นี้อยู่แล้ว");
                            document.getElementById("username").value = '';
                        } else {
                            alert("เพิ่มพนักงานเรียบร้อยแล้ว");
                            getStaff();
                            document.getElementById("registerForm").reset();
                        }
                    }
                });
            }

        });
    });

    function getStaff() {
        $.ajax({
            url: "./Staff_db/AjexStaff.php",
            success: function(data) {
                $("#tableBody").html(data);
            }
        });
    }

    function deletestaff(username) {
        if (confirm("แน่ใจนะที่จะลบพนักงานนี้"))
            $.ajax({
                url: "./Staff_db/DeleteStaff.php",
                method: "POST",
                data: {
                    data: username
                },
                success: function(data) {
                    //$("#spanusers").html(data);
                    getStaff();
                    //location.reload();

                }
            })
    }
</script>


</html>