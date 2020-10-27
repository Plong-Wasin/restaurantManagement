<?php include("../Session/Check_Session.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>พนักงาน</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
    <?php
    include("../require/connectDB.php");
    $session = $_GET['id'];
    $query = "SELECT * FROM `users` WHERE id = '$session'";
    $result = mysqli_query($conn, $query);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $username = $row['username'];
            $password = $row['password'];
            $email = $row['Email'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            if ($row['birthdate'] == null) {
                $birthdate = '';
            } else {
                $Date = $row['birthdate'];
                $setDate = date_create("$Date");
                $birthdate = date_format($setDate, "d/m/Y");
            }
            $contact_number = $row['contact_number'];
            $title = $row['title'];
            $iduser = $row['id'];
        }
    }
    ?>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">ข้อมูลระบบ</h2>
                    <form id="registerForm" method="POST">
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">ชื่อผู้ใช้

                                </label>
                                <input class="input--style-4 lockusername" type="text" name="username" id="username" value='<?php echo $username ?>' required>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">รหัสผ่านเก่า</label>
                                <input class="input--style-4" type="text" name="password" id="password" value='<?php echo $password ?>' required>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">รหัสผ่านใหม่ (เว้นถ้าไม่ต้องการเปลี่ยน)</label>
                                    <input class="input--style-4" type="text" name="newPassword_1" id="newPassword_1">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">ยืนยันรหัสผ่านใหม่</label>
                                    <input class="input--style-4" type="text" name="newPassword_2" id="newPassword_2">
                                </div>
                            </div>
                        </div>
                        <h2 class="title">ข้อมูลส่วนตัว</h2>

                        <div class="input-group">
                            <label class="label">คำนำหน้า</label>
                            <div class="rs-select2 js-select-simple select--no-search" style="width: 150px;">
                                <select class="selecttitle" type="title" name="title" value="<?php echo $gender ?>" id="title" required>
                                    <?php if ($title == null) { ?>
                                        <option disabled="disabled" selected="selected" value="">เลือก</option>
                                    <?php  } else { ?>
                                        <option disabled="disabled" value="">เลือก</option>
                                    <?php   } ?>

                                    <?php if ($title == 'Miss') { ?>
                                        <option selected="selected" value="Miss">นางสาว</option>
                                    <?php  } else { ?>
                                        <option value="Miss">นางสาว</option>
                                    <?php   } ?>
                                    <?php if ($title == 'Mrs') { ?>
                                        <option selected="selected" value="Mrs">นาง</option>
                                    <?php  } else { ?>
                                        <option value="Mrs">นาง</option>
                                    <?php   } ?>
                                    <?php if ($title == 'Mr') { ?>
                                        <option selected="selected" value="Mr">นาย</option>
                                    <?php  } else { ?>
                                        <option value="Mr">นาย</option>
                                    <?php   } ?>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">ชื่อ</label>
                                    <input class="input--style-4 lockfirst_name" type="text" name="first_name" id="first_name" value='<?php echo $first_name ?>' required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">นามสกุล</label>
                                    <input class="input--style-4 locklast_name" type="text" name="last_name" id="last_name" value='<?php echo $last_name ?>' required>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">วัน/เดือน/ปี เกิด</label>
                                    <div class="input-group-icon">
                                        <?php if ($birthdate == null) { ?>
                                            <input class="input--style-4 js-datepicker" type="text" readonly="readonly" name="birthday" id="birthday" required>
                                            <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                        <?php } else { ?>
                                            <input class="input--style-4 js-datepicker" type="text" readonly="readonly" name="birthday" id="birthday" value='<?php echo $birthdate ?>' required>
                                            <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                        <?php  } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">เบอร์โทรติดต่อ</label>
                                    <input class="input--style-4 lockNumber" type="text" name="contact_number" name="contact_number" id="contact_number" value='<?php echo $contact_number ?>' onkeyup="limit(this);">
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">E-mail</label>
                                <input class="input--style-4" type="email" name="email" id="email" value='<?php echo $email ?>' required>
                            </div>
                        </div>
                        <div cclass="p-t-15">
                            <div class="ButtonRegister">
                                <button class="btn btn--radius-2 btn--blue" id="ButtonRegister" type="submit" name="reg_user">ยืนยัน</button>
                            </div>
                        </div>
                        <input type="hidden" id="iduser" name="iduser" value="<?php echo $iduser ?>">
                        <input type="hidden" id="old_username" name="old_username" value="<?php echo $username ?>">
                        <input type="hidden" id="old_password" name="old_password" value="<?php echo $password ?>">
                        <input type="hidden" id="old_email" name="old_email" value="<?php echo $email ?>">
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

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

<script>
    $(document).ready(function() {
        document.getElementsByClassName("ButtonRegister")[0].click();
        $('#registerForm').on("submit", function(event) {
            event.preventDefault();

            if (document.getElementById("newPassword_1").value != document.getElementById("newPassword_2").value) {
                alert("รหัสผ่านไม่ตรงกัน");
                document.getElementById("newPassword_1").value = '';
                document.getElementById("newPassword_2").value = '';

            } else if (document.getElementById("old_password").value != document.getElementById("password").value) {
                alert("รหัสผ่านไม่ถูกต้อง");
                document.getElementById("password").value = '';

            } else if (document.getElementById("username").value.length < 6 || document.getElementById("username").value.length > 10) {
                alert("ชื่อผู้ใช้ต้องมีไม่น้อยกว่า 6 ตัวอักษร และ ห้ามเกิน 10 ตัวอักษร");
                document.getElementById("password").value = '';

            } else if (document.getElementById("newPassword_1").value != '') {
                if (document.getElementById("newPassword_1").value.length < 6 || document.getElementById("newPassword_1").value.length > 10) {
                    alert("รหัสใหม่ผ่านต้องมีไม่น้อยกว่า 6 ตัวอักษร และ ห้ามเกิน 10 ตัวอักษร");
                    document.getElementById("password").value = '';
                }
            } else {
                $.ajax({
                    url: "./getEditData.php",
                    method: "POST",
                    data: $('#registerForm').serialize(),
                    success: function(data) {
                        if (data === 'error_username') {
                            alert("มีชื่อผู้ใช้นี้แล้ว");
                        } else if (data === 'error_email') {
                            alert("อีเมลล์นี้ถูกใช้แล้ว");
                        } else if (data === 'error_date') {
                            alert("อายุขั้นต่ำ 15 ปี");
                        } else {
                            alert("แก้ไขข้อมูลเรียบร้อยแล้ว");
                            setTimeout(() => {
                                window.top.location.reload();
                            }, 500);

                        }

                    }
                });

            }

        });
    });
    jQuery('.lockNumber').keyup(function() {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    });

    function limit(element) {
        if (element.value.substr(0, 1) != '0') {
            element.value = '';
        } else if (element.value.substr(0, 2) == '00') {
            element.value = '';
        }
        if (element.value.length > 10) {
            element.value = element.value.substr(0, 10);
        }
    }

    jQuery('.lockfirst_name').keyup(function() {
        let english = /^[\u0E00-\u0E7Fก-ฮ]*$/;
        if (!english.test(this.value)) {
            this.value = this.value.substr(0, this.value.length - 1);
        }
    });
    jQuery('.locklast_name').keyup(function() {
        let english = /^[\u0E00-\u0E7Fก-ฮ]*$/;
        if (!english.test(this.value)) {
            this.value = this.value.substr(0, this.value.length - 1);
        }
    });
    jQuery('.lockusername').keyup(function() {
        let english = /^[A-Za-z]*$/;
        if (!english.test(this.value)) {
            this.value = this.value.substr(0, this.value.length - 1);
        }
    });
</script>

</html>


<!-- end document-->