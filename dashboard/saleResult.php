<?php include('../Session/Check_Session.php'); ?>
<?php
require_once "../require/connectDB.php";
?>
<!doctype html>
<html lang="th">

<head>
    <title>ระบบจัดการร้านอาหาร</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <?php
    include_once "../require/req.php";
    ?>
</head>

<body>
    <div class="container" style=" background-color: none;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">ประวัติการขาย</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">ภาพรวม</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">อาหารที่ขาย</a>
                    </li>
                </ul>
            </div>
        </nav>
        <span class=" custom-control-inline" style="padding: 10px 10px 10px 10px;border-width: thin;border-color: black;margin: 10px;"">
            <label for=" formDate" style="padding: 15px 5px 5px 0px;">เริ่ม</label>
            <input type="date" id="formDate" onchange="onchangeFormDate();">
        </span>
        <span class="custom-control-inline" style="padding: 10px 10px 10px 10px;border-width: thin;border-color: black;margin: 10px;"">
            <label for=" toDate" style="padding: 15px 5px 5px 0px;">ถึง</label>
            <input type="date" id="toDate" onchange="onchangeToDate();">

        </span>
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-primary active" id="test" style="z-index : 0;"><input type="radio" name="options" id="option1" checked>วันนี้</label>
            <label class="btn btn-primary" style="z-index : 0;"><input type="radio" name="options" id="option2">7 วัน</label>
            <label class="btn btn-primary" style="z-index : 0;"><input type="radio" name="options" id="option3">เดือนนี้</label>
            <label class="btn btn-secondary" id="filterButton" style="z-index : 0;"><input type="radio" name="options" id="option4" disabled>ตามเวลาที่กำหนด</label>
        </div>


        <div>
            <div class="text-right">ยอดขายรวม <span id="total"> </span> บาท </div>
            <div class="text-right">ยอดจ่ายจริง <span id="realTotal"> </span> บาท</div>
            <table class="table">
                <thead id="thead">
                    <tr>

                        <th>วันเวลาที่เข้า</th>
                        <th>วันเวลาที่จ่ายเงิน</th>
                        <th class="text-right">ยอดขาย(บาท)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="result">
                    <?php
                    include_once "./ajax/getTbody.php";
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
<script>
    $(document).ready(function() {
        var numTotal = <?php echo $total ?>;
        document.getElementById("total").innerText = numTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("toDate").setAttribute("max", today);
        document.getElementById("formDate").setAttribute("max", today);
        $(".nav-item").click(function() {
            $('.navbar-collapse').collapse('hide');
            $(".nav-item.active").removeClass("active");
            $(this).addClass("active");
            $.ajax({
                url: './ajax/getThead.php',
                method: 'POST',
                data: {
                    topic: $(".nav-item.active")[0].innerText
                },
                beforeSend: function() {},
                success: function(data) {
                    $("#thead").html(data);
                }
            });
            callAjaxGetTbody($(".btn.active").children())
        });
    });

    function onchangeFormDate() {
        document.getElementById("toDate").setAttribute("min", document.getElementById("formDate").value);

    }

    function onchangeToDate() {
        document.getElementById("formDate").setAttribute("max", document.getElementById("toDate").value);
    }
    $("#formDate,#toDate").on("change", function() {
        if (document.getElementById("formDate").value != null || document.getElementById("toDate").value != null || document.getElementById("formDate").value != "" || document.getElementById("toDate").value != "") {
            document.getElementById("option4").disabled = false;
            document.getElementById("filterButton").classList.add('btn-primary');
            document.getElementById("filterButton").classList.remove('btn-secondary');
        }
        document.getElementById("filterButton").classList.forEach(findActive);
    })
    $(":radio").click(function() {
        callAjaxGetTbody(this);
    });

    function callAjaxGetTbody(click) {
        if ($(click)[0].id != "option4") {
            $.ajax({
                url: './ajax/getTbody.php',
                method: 'POST',
                data: {
                    data: $(click)[0].id,
                    topic: $(".nav-item.active")[0].innerText
                },
                beforeSend: function() {},
                success: function(data) {
                    $("#result").html(data);
                }
            });
        } else {
            $.ajax({
                url: './ajax/getTbody.php',
                method: 'POST',
                data: {
                    data: $(click)[0].id,
                    form: document.getElementById("formDate").value,
                    to: document.getElementById("toDate").value,
                    topic: $(".nav-item.active")[0].innerText
                },
                beforeSend: function() {},
                success: function(data) {
                    $("#result").html(data);
                }
            });
        }

    }

    function findActive(value, index, array) {
        if (value == "active") {
            $.ajax({
                url: './ajax/getTbody.php',
                method: 'POST',
                data: {
                    data: "option4",
                    form: document.getElementById("formDate").value,
                    to: document.getElementById("toDate").value
                },
                beforeSend: function() {},
                success: function(data) {
                    $("#result").html(data);
                }
            });
        }
    }
</script>

</html>