<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
    include("../../require/req.php");
    ?>
</head>

<body>
    <div class="container">
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
                    <th width=10%></th>
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
            for (i = 0; i < document.getElementsByClassName("form-check-input").length; i++) {
                if (i != 0) {
                    rawData = rawData + ",";
                }
                rawData = rawData + '{"id":\"' + document.getElementsByClassName("form-check-input")[i].value + '\","checked":' + document.getElementsByClassName("form-check-input")[i].checked + '}';
            }
            rawData = rawData + ']';
            return rawData;
        }
    </script>
</body>

</html>