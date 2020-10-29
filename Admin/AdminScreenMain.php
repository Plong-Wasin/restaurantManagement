<?php
include('../Session/Check_Session.php');
?>
<html>
<title>AdminScreen</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
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

<body>
    <?php
    include("../require/connectDB.php");
    $session = $_SESSION['username'];
    $query_background = "SELECT * FROM `setting` WHERE `name`='background'";
    $result_background = mysqli_query($conn, $query_background);
    if ($result_background->num_rows > 0) {
        while ($row_background = $result_background->fetch_assoc()) {
            $background_restaurant = $row_background['value'];
        }
    }
    $query_recommend = "SELECT * FROM `setting` WHERE `name`='recommend'";
    $result_recommend = mysqli_query($conn, $query_recommend);
    if ($result_recommend->num_rows > 0) {
        while ($row_recommend = $result_recommend->fetch_assoc()) {
            $recommend_restaurant = $row_recommend['value'];
        }
    }
    $query_restaurant_name = "SELECT * FROM `setting` WHERE `name`='restaurant_name'";
    $result_restaurant_name = mysqli_query($conn, $query_restaurant_name);
    if ($result_recommend->num_rows > 0) {
        while ($row_restaurant_name = $result_restaurant_name->fetch_assoc()) {
            $name_restaurant = $row_restaurant_name['value'];
        }
    }
    ?>

    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">ตั้งค่าร้าน</h2>
                    <form id="settingForm" action="./Setting_db.php" method="POST" enctype="multipart/form-data">

                        <div class="col-2">
                            <div class="input-group">
                                <label class="label" for="username">ชื่อร้าน<br></label>
                                <input class="input--style-4" type="name" name="name" id="name" value="<?php echo $name_restaurant ?>" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="label">เปิด/ปิดเมนูแนะนำ</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select class="selectjob" type="recommend" name="recommend" value="<?php echo $recommend_restaurant ?>" required>
                                    <?php
                                    if ($recommend_restaurant == '1') {
                                    ?>
                                        <option selected="selected" value="1">เปิด</option>
                                    <?php } else { ?>
                                        <option value="1">เปิด</option>
                                    <?php
                                    } ?>
                                    <?php
                                    if ($recommend_restaurant == '0') {
                                    ?>
                                        <option selected="selected" value="0">ปิด</option>
                                    <?php } else { ?>
                                        <option value="0">ปิด</option>
                                    <?php
                                    } ?>
                                </select>
                                <div class="select-dropdown"></div>
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label" for="username">โลโก้ร้าน (200x200px)<br></label>
                                        <?php if ($background_restaurant != null) { ?>
                                            <label class="label" for="username">โลโก้เก่า<br></label>
                                            <img src="../src/img/<?php echo $background_restaurant; ?>" width="200" height="200">
                                        <?php } ?>
                                        <input type="file" name="fileToUpload" id="fileToUpload" style="margin: 10px;" accept=".jpeg,.png,.jpg,.gif">
                                        <label class=" label" for="username">โลโก้ใหม่<br></label>
                                        <span id="uploaded_image"></span>
                                        <div cclass="p-t-15">
                                            <button class="btn btn--radius-2 btn--blue" id="ButtonRegister" type="submit" name="submit">ยืนยัน</button>
                                        </div>
                                    </div>
                                </div>
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
    <script>
        $(document).ready(function() {
            document.getElementsByClassName("ButtonRegister")[0].click();

        });


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#picture').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        $(document).on('change', '#fileToUpload', function() {
            $('#uploaded_image').html('<img src="#" id="picture" height="200" width="200" class="img-thumbnail" />');
            readURL(this);
        });
    </script>
</body>

</html>