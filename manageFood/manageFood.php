<?php include('../Session/Check_Session.php'); ?>
<?php
require_once("../require/connectDB.php");
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจัดการร้านอาหาร</title>
    <?php
    include_once("../require/req.php");
    $tab_query = "SELECT food_type_name FROM food_type ORDER BY food_type_id ASC";
    $tab_result = mysqli_query($conn, $tab_query);
    $tab_menu = '';
    $tab_content = '';
    $len = 0;
    while ($row = mysqli_fetch_array($tab_result)) {
        $len = $len + strlen($row["food_type_name"]);
    }
    ?>
</head>
<link rel="stylesheet" href="../CSS/enlarge.css">

<script>
    window.onload = function() {
        $(".nav-item.active").click();
    }
    $(document).ready(function() {
        $('#insertFoodType_form').on("submit", function(event) {
            event.preventDefault();
            $.ajax({
                url: "./ajax/insertFoodType.php",
                method: "POST",
                data: $('#insertFoodType_form').serialize(),
                beforeSend: function() {},
                success: function(data) {
                    $('#insertFoodType_form')[0].reset();
                    if (data != "") {
                        alert(data.replace("<br>", "\n"));
                    } else {
                        $("#insertFoodType").modal("hide");
                        callAjaxFoodTypeBar();
                    }
                }
            });
        });
        $(document).on('change', '#file', function() {
            $('#uploaded_image').html('<img src="#" id="picture" height="150" width="225" class="img-thumbnail" />');
            readURL(this);
        });
        $('#insertFood_form').on("submit", function(event) {
            event.preventDefault();
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
                beforeSend: function() {},
                success: function(data) {
                    // location.reload();
                    $(".modal").modal("hide");
                    callAjaxSelectFoodType();
                    callAjaxFoodTypeBar();
                }
            });
        });
        $('#editFoodType_form').on("submit", function(event) {
            event.preventDefault();
            $.ajax({
                url: "./ajax/editFoodType.php",
                method: "POST",
                data: $('#editFoodType_form').serialize(),
                beforeSend: function() {},
                success: function(data) {
                    if (data != "") {
                        alert(data);
                    } else {
                        callAjaxFoodTypeBar();
                        $(".modal").modal("hide");
                    }
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
                    //alert($(".nav-item.active").children(".nav-link").data("value"));
                    if ($(".nav-item.active").children(".nav-link").data("value") == 0) {
                        document.getElementById("divEditRecommend").style.display = "block";
                    } else
                        document.getElementById("divEditRecommend").style.display = "none";

                }
            });
        });
        var selectFoodType = "";
        $('#editFoodType,#insertFood,#deleteFoodType').on('shown.bs.modal', function(e) {
            $.ajax({
                url: './ajax/tagSelectFoodType.php',
                method: 'POST',
                success: function(data) {
                    if (selectFoodType != data) {
                        $("#eFoodType,#foodType,#dFoodType").html(data);
                        selectFoodType = data;
                    }
                }
            });
        });
        $('#editFoodType').on('shown.bs.modal', function(e) {
            $("#editFoodType_form").trigger("reset");
        });
        callAjaxSelectFoodType();
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

        $.ajax({
            url: "./ajax/insertFood.php",
            method: "POST",
            data: $('#insertFood_form').serialize(),
            beforeSend: function() {
                // alert($('#insertFood_form').serialize());
            },
            success: function(data) {
                if (data != "") {
                    alert("มีชื่อนี้อยู่แล้ว");
                } else {
                    $('#insertFoodType_form')[0].reset();
                    $("#insertFood").modal('hide');
                    callAjaxSelectFoodType();
                }
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
        let foodType = $("#foodType").val();
        document.getElementById("insertFood_form").reset();
        $("#foodType").val(foodType);
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

    function callAjaxFoodTypeBar() {
        event.preventDefault();
        $.ajax({
            url: './ajax/foodTypeBar.php',
            method: 'POST',
            data: {
                foodTypeId: $(".nav-item.active").children(".nav-link").data("value")
            },
            beforeSend: function() {},
            success: function(data) {
                $("#foodTypeBar").html(data);
            }
        });
    }
</script>
</head>

<body>
    <div id="myModal" class="modal2" onclick="document.getElementById('myModal').style.display = 'none';" style="display: none;">

        <!-- The Close Button -->
        <span class="close">&times;</span>

        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="img01">
    </div>
    <div class="container">
        <!-- <h2 class="text-center p-2">จัดการเมนูอาหาร</h2> -->
        <?php
        if ($_SESSION['role'] == 'admin') {
        ?>
            <div class="row pb-2">
                <button type="button" class="btn btn-primary col-2" data-toggle="modal" data-target="#insertFoodType">เพิ่มประเภทอาหาร</button>
                <button type="button" class="btn btn-secondary col-2" data-toggle="modal" data-target="#editFoodType">แก้ไขชื่อประเภทอาหาร</button>
                <button type="button" class="btn btn-danger col-2" data-toggle="modal" data-target="#deleteFoodType">ลบประเภทอาหาร</button>
                <div class="col-2"></div>
                <button type="button" class="btn btn-warning col-2" onclick="window.location='./changeStatus/changeStatus.php'">แก้ไขสถานะอาหาร</button>
                <button type="button" class="btn btn-success col-2" data-toggle="modal" data-target="#insertFood" onclick="insertFoodButton();">เพิ่มอาหาร</button>
            </div>
        <?php
        }
        ?>
        <div id="foodTypeBar">
            <?php
            include("./ajax/foodTypeBar.php");
            ?>
        </div>
        <div class="text-right py-2" style="display: none;" id="divEditRecommend">
            <button type="button" class="btn btn-primary" onclick="window.location.href='./recommendFood/manageRecommendFood.php'">แก้ไขเมนูแนะนำ</button>
        </div>
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
            </tbody>
        </table>
    </div>
    <?php
    include_once("./modal/modal.php");
    ?>
</body>
<script src="../js/enlarge.js"></script>


</html>