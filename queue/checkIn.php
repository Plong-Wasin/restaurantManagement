<?php
require_once("../require/connectDB.php");
$sql = "SELECT * FROM `table` WHERE table_status=0";
if (!$result = mysqli_query($conn, $sql)) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    include_once("../require/req.php")
    ?>
</head>

<body>
    <div class="container">
        <h2 class="text-center">เลือกโต๊ะที่ลูกค้าจะนั่ง</h2>
        <div class="form-group">
            <label for="table">เลือกโต๊ะที่ลูกค้าจะนั่ง</label>
            <div id="selectTable">
                <select class="form-control" id="table">
                    <?php while ($row = mysqli_fetch_array($result)) {
                        if (!$row["table_status"]) {
                    ?>
                            <option value="<?php echo $row["table_id"] ?>">โต๊ะ <?php echo $row["table_id"] ?> นั่งได้ <?php echo $row["table_people"] ?> คน</option>
                    <?php }
                    } ?>
                </select>
            </div>
        </div>
        <div class="text-right">
            <button id="genCode" type="button" class="btn btn-primary text-right">ต่อไป</button>
        </div>
        <div id="show">
        </div>
        <button type="button" class="btn btn-primary" onclick="printDiv('show');">พิมพ์รหัสให้ลูกค้า</button>
    </div>
</body>
<script>
    $(document).ready(function() {
        $("#genCode").click(function() {
            // console.log(document.getElementById("table").value);
            $.ajax({
                url: "../checkIn/ajax/generateCode.php",
                method: "POST",
                data: {
                    tableNo: document.getElementById("table").value
                },

                success: function(data) {
                    // alert(data);
                    $("#show").html(data);

                }
            });
            $.ajax({
                url: "../checkIn/ajax/selectTable.php",
                success: function(data) {
                    // alert(data);
                    $("#selectTable").html(data);

                }
            });
        });
    });

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>

</html>