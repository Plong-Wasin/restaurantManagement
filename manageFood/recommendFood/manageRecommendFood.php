<?php
require_once("../../require/connectDB.php");
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
    $tab_query = "SELECT food_type_name FROM food_type ORDER BY food_type_id ASC";
    $tab_result = mysqli_query($conn, $tab_query);
    $tab_menu = '';
    $tab_content = '';
    $len = 0;
    while ($row = mysqli_fetch_array($tab_result)) {
        $len = $len + strlen($row["food_type_name"]);
    }
    if ($len < 190)
        include("../../require/req.php");
    else {
    ?>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <link rel="stylesheet" href="../../CSS/customBootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <?php
    }
    ?>

</head>

<body>
    <div class="container">
        <h2 class="text-center">แก้ไขเมนูแนะนำ</h2>
        <div class="row py-2">
            <button type="button" class="btn btn-secondary col-2" id="back">กลับ</button>
            <div class="col-8"></div>
            <button type="button" id="save" class="btn btn-primary col-2">บันทึก</button>
        </div>
        <div class="py-2">
            <?php
            include("./ajax/foodTypeBar.php");
            ?>
        </div>


        <div class="alert alert-success" role="alert" style="display: none;" id="alertSuccess">
            ทำการบันทึกสำเร็จ
        </div>
        <div class="alert alert-danger" role="alert" style="display: none;" id="alertDanger">
            ไม่มียังไม่มีการเปลี่ยนแปลงข้อมูล
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th width=120px><input type="checkbox" name="" id="select_all"> select all</th>
                    <th width="200" class="text-center">รูป</th>
                    <th>ชื่ออาหาร</th>
                    <th>ราคา (บาท)</th>
                </tr>
            </thead>
            <tbody id="tableFoodList">
                <tr>
                    <td>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        var oldData;
        var alertSuccessNoneDisplayTimeout;
        var alertDangerNoneDisplayTimeout;
        $(document).ready(function() {
            oldData = getCheckbox();
            $(".nav-item").click(function() {
                if (oldData != getCheckbox()) {
                    if (confirm("ต้องการที่จะละทิ้งการบันทึกไหม")) {
                        callAjaxSelectFoodType(this);
                    }
                } else {
                    callAjaxSelectFoodType(this);
                }
            });
            $("#save").on("click", function() {
                if (oldData != getCheckbox()) {
                    $.ajax({
                        url: './ajax/echoJson.php',
                        method: 'POST',
                        data: {
                            data: getCheckbox()
                        },
                        beforeSend: function() {},
                        success: function(data) {
                            oldData = getCheckbox();
                            clearTimeout(alertSuccessNoneDisplayTimeout);
                            document.getElementById("alertDanger").style.display = "none";
                            document.getElementById("alertSuccess").style.display = "block";
                            alertSuccessNoneDisplayTimeout = setTimeout(() => {
                                document.getElementById("alertSuccess").style.display = "none";
                            }, 1000);
                        }
                    });
                } else {
                    clearTimeout(alertDangerNoneDisplayTimeout);
                    document.getElementById("alertSuccess").style.display = "none";
                    document.getElementById("alertDanger").style.display = "block";
                    alertDangerNoneDisplayTimeout = setTimeout(() => {
                        document.getElementById("alertDanger").style.display = "none";
                    }, 1000);
                }
            });
            $(".nav-item.active").click();
            $("#back").on("click", function() {
                if (oldData != getCheckbox()) {
                    if (confirm("ต้องการที่จะละทิ้งการบันทึกไหม"))
                        window.location.href = "../manageFood.php";
                } else {
                    window.location.href = "../manageFood.php";
                }
            });
        });

        function callAjaxSelectFoodType(click) {
            $('.navbar-collapse').collapse('hide');
            $(".nav-item.active").removeClass("active");
            $(click).addClass("active");
            $.ajax({
                url: "./ajax/selectFoodType.php",
                method: "POST",
                data: {
                    foodTypeId: $(click).children(".nav-link").data("value")
                },
                success: function(data) {
                    $("#tableFoodList").html(data);
                    oldData = getCheckbox();
                }
            });
        }

        function getCheckbox() {
            let rawData = '[';
            for (i = 0; i < document.getElementsByClassName("checkbox").length; i++) {
                if (i != 0) {
                    rawData = rawData + ",";
                }
                rawData = rawData + '{"id":\"' + document.getElementsByClassName("checkbox")[i].value + '\","checked":' + document.getElementsByClassName("checkbox")[i].checked + '}';
            }
            rawData = rawData + ']';
            return rawData;
        }
        $(document).ready(function() {
            $("#select_all").on('click', function() {
                if (this.checked) {
                    $('.checkbox').each(function() {
                        this.checked = true;
                    })
                } else {
                    $('.checkbox').each(function() {
                        this.checked = false;
                    })
                }
            })
            $(".checkbox").on('click', function() {
                if ($(".checkbox:checked").length == $('.checkbox').length) {
                    $("#select_all").prop("checked", true);
                } else {
                    $("#select_all").prop("checked", false);

                }
            })
        });
        $(document).ajaxStop(function() {
            $(".checkbox").on('click', function() {
                if ($(".checkbox:checked").length == $('.checkbox').length) {
                    $("#select_all").prop("checked", true);
                } else {
                    $("#select_all").prop("checked", false);

                }
            });
            if ($(".checkbox:checked").length == $('.checkbox').length) {
                $("#select_all").prop("checked", true);
            } else {
                $("#select_all").prop("checked", false);

            }
        })
    </script>
</body>

</html>