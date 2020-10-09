<?php include('../Session/Check_Session.php'); ?>
<?php
require_once("../require/connectDB.php");
?>
<!DOCTYPE html>
<html lang="th">

<head></head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ระบบจัดการร้านอาหาร</title>
<?php
include_once("../require/req.php");
include("../Sidebar/Sidebar.php");
?>
<script>
    $(document).ready(function() {
        // document.getElementsByClassName("btn btn-success col-2")[0].click();
        $('#insertFoodType_form').on("submit", function(event) {
            event.preventDefault();
            $.ajax({
                url: "./ajax/insertFoodType.php",
                method: "POST",
                data: $('#insertFoodType_form').serialize(),
                beforeSend: function() {
                    //document.getElementById("insert").innerText = "กำลังประมวลผล";
                },
                success: function(data) {
                    $('#insertFoodType_form')[0].reset();
                    if (data != "")
                        alert(data.replace("<br>", "\n"));
                    //location.reload();
                }
            });
        });
        $(document).on('change', '#file', function() {

            $('#uploaded_image').html('<img src="#" id="picture" height="150" width="225" class="img-thumbnail" />');
            readURL(this);
        });
        $('#insertFood_form').on("submit", function(event) {
            try {
                var name = document.getElementById("file").files[0].name;
                var form_data = new FormData();
                var ext = name.split('.').pop().toLowerCase();
                if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    alert("Invalid Image File");
                } else {
                    var oFReader = new FileReader();
                    oFReader.readAsDataURL(document.getElementById("file").files[0]);
                    var f = document.getElementById("file").files[0];
                    var fsize = f.size || f.fileSize;
                    if (fsize > 2000000) {
                        alert("Image File Size is very big");
                    } else {
                        form_data.append("file", document.getElementById('file').files[0]);
                        $.ajax({
                            url: "upload.php",
                            method: "POST",
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            beforeSend: function() {
                                $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                            },
                            success: function(data) {
                                try {
                                    $('#uploaded_image').html(data);
                                    callAjaxInsertFood();
                                } catch (error) {
                                    console.log(err)
                                }

                            }
                        });
                    }
                }
            } catch (error) {
                callAjaxInsertFood();
            }


        });
        $('#deleteFoodType_form').on("submit", function(event) {
            event.preventDefault();
            $.ajax({
                url: "./ajax/deleteFoodType.php",
                method: "POST",
                data: $('#deleteFoodType_form').serialize(),
                beforeSend: function() {
                    //document.getElementById("insert").innerText = "กำลังประมวลผล";
                },
                success: function(data) {
                    //$('#insertFoodType_form')[0].reset();
                    //$('#insertFoodType').modal('hide');

                    location.reload();

                }
            });
        });
        $('#editFoodType_form').on("submit", function(event) {
            //alert("123");
            event.preventDefault();
            $.ajax({
                url: "./ajax/editFoodType.php",
                method: "POST",
                data: $('#editFoodType_form').serialize(),
                beforeSend: function() {
                    //document.getElementById("insert").innerText = "กำลังประมวลผล";
                },
                success: function(data) {
                    //$('#insertFoodType').modal('hide');

                    location.reload();

                }
            });
        });
        $(".nav-item").click(function() {
            $('.navbar-collapse').collapse('hide');
            $(".nav-item.active").removeClass("active");
            $(this).addClass("active");
            $.ajax({
                url: "./ajax/selectFoodType.php",
                method: "POST",
                data: {
                    foodTypeId: $(this).children(".nav-link").data("value")
                },
                success: function(data) {
                    $("#tableFoodList").html(data);
                }
            });
        });
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

    function callAjaxInsertFood() {
        event.preventDefault();
        $.ajax({
            url: "./ajax/insertFood.php",
            method: "POST",
            data: $('#insertFood_form').serialize(),
            beforeSend: function() {
                //document.getElementById("insert").innerText = "กำลังประมวลผล";
            },
            success: function(data) {
                $('#insertFoodType_form')[0].reset();
                //$('#insertFoodType').modal('hide');
                // alert();
                //location.reload();
                $("#insertFood").modal('hide');
                callAjaxSelectFoodType();
            }
        });
    }

    function callAjaxSelectFoodType() {
        $.ajax({
            url: "./ajax/selectFoodType.php",
            method: "POST",
            data: {
                foodTypeId: $(".nav-item.active").children(".nav-link").data("value")
            },
            success: function(data) {
                $("#tableFoodList").html(data);
            }
        });
    }

    function editFood(food_id) {
        document.getElementById("insertFood_form").reset()
        document.getElementById("insertFoodTitle").innerText = "แก้ไขข้อมูลอาหาร";
        $.ajax({
            url: "./ajax/getData.php",
            method: "POST",
            data: {
                data: food_id
            },
            success: function(data) {
                var json = JSON.parse(data)
                $("#foodID").val(json.food_id);
                console.log($("#foodID").val);
                $("#foodName").val(json.food_name);
                $("#foodPrice").val(json.food_price);
                $("#foodType").val(json.food_type_id);
                if (json.food_image != null) {
                    $("#uploaded_image").html('<img src="../src/img/food/' + json.food_image + '" height="150" width="225" class="img-thumbnail" /><input type="hidden" id="imageName" name="imageName" value="' + json.food_image + '" />')
                }
            }
        });
    }

    function insertFoodButton() {
        $("#uploaded_image").html();
        document.getElementById("insertFood_form").reset();
        document.getElementById("insertFoodTitle").innerText = "เพิ่มอาหาร";
        $('#foodID').val('');
    }

    function deleteFood(food_id) {
        if (confirm("แน่ใจนะที่จะลบรายการนี้")) {
            $.ajax({
                url: "./ajax/deleteFood.php",
                method: "POST",
                data: {
                    data: food_id
                },
                success: function(data) {

                    callAjaxSelectFoodType();

                }
            });
        }
    }

    function changeStatus(food_id, food_have) {
        $.ajax({
            url: './ajax/changeStatus.php',
            method: 'POST',
            data: {
                food_id: food_id,
                food_have: food_have
            },
            beforeSend: function() {},
            success: function(data) {
                callAjaxSelectFoodType();
            }
        });
    }
</script>

</head>

<body>
    <div class="container">
        <h2 class="text-center p-2">จัดการเมนูอาหาร</h2>
        <div class="row pb-2">
            <button type="button" class="btn btn-primary col-2" data-toggle="modal" data-target="#insertFoodType">เพิ่มประเภทอาหาร</button>
            <button type="button" class="btn btn-secondary col-2" data-toggle="modal" data-target="#editFoodType">แก้ไขชื่อประเภทอาหาร</button>
            <button type="button" class="btn btn-danger col-2" data-toggle="modal" data-target="#deleteFoodType">ลบประเภทอาหาร</button>
            <div class="col-4"></div>
            <button type="button" class="btn btn-success col-2" data-toggle="modal" data-target="#insertFood" onclick="insertFoodButton();">เพิ่มอาหาร</button>
        </div>


        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">หมวดหมู่</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                    $tab_query = "SELECT * FROM food_type ORDER BY food_type_id ASC";
                    $tab_result = mysqli_query($conn, $tab_query);
                    $tab_menu = '';
                    $tab_content = '';
                    $i = 0;
                    while ($row = mysqli_fetch_array($tab_result)) {
                        if ($i == 0) {
                            $firstFoodType = $row['food_type_id'];
                    ?>
                            <li class="nav-item active">
                                <a class="nav-link" id="tab_<?php echo $row["food_type_id"] ?> " href="#" data-value="<?php echo $row["food_type_id"] ?>"><?php echo $row["food_type_name"]; ?></a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" id="tab_<?php echo $row["food_type_id"] ?> " href="#" data-value="<?php echo $row["food_type_id"] ?>"><?php echo $row["food_type_name"]; ?></a>
                            </li>
                    <?php
                        }
                        $i++;
                    }
                    ?>
                </ul>
            </div>

        </nav>

        <table class="table">
            <thead>
                <tr>
                    <th width="200" class="text-center">รูป</th>
                    <th>ชื่ออาหาร</th>
                    <th>ราคา (บาท)</th>
                    <th class="text-center">สถานะ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tableFoodList">
                <?php
                include_once("./ajax/selectFoodType.php");
                ?>
            </tbody>
        </table>
    </div>
    <?php
    include_once("./modal/modal.php");
    ?>
</body>

</html>