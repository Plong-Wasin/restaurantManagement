<?php include('../Session/Check_Session.php');
include("../require/connectDB.php");
$tab_query = "SELECT * FROM food_type ORDER BY food_type_id ASC";
$tab_result = mysqli_query($conn, $tab_query);
if (mysqli_num_rows($tab_result) == 0) {
?>
    <script>
        alert("ยังไม่มีเมนูอาหาร กรุณาเพิ่มเมนูก่อน");
    </script>
<?php
    if ($_SESSION["role"] == "admin") {

        echo '<script>window.location.href="../Admin/AdminScreenMain.php";</script>';
        // header("Location:../Admin/AdminScreenMain.php");
    } else {
        echo '<script>window.location.href="../editProfile/editProfile.php";</script>';
        // header("Location:../editProfile/editProfile.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

    <link rel="stylesheet" href="../CSS/css/selectOrderFoodStaff.css">
</head>

<body>
    <select class="selectOrderFoodStaff" id="mySelect" onchange="myFunction()">
        <option value=0>
            <div class="optionST">เลือกโต๊ะ</div>
        </option>
        <?php
        $query1 = "SELECT table_id,table_status FROM `table` WHERE table_status = 1";
        $result1 = mysqli_query($conn, $query1);

        while ($re = mysqli_fetch_array($result1, MYSQLI_ASSOC)) { ?>
            <option value="<?php echo $re['table_id']; ?>">โต๊ะที่ <?php echo $re['table_id']; ?></option>
        <?php }  ?>

    </select>



    <div id="orderfood">
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        function myFunction() {
            $tableID = document.getElementById("mySelect").value;
            document.getElementById("mySelect").style.display = "none";
            if ($tableID != 0) {
                $.ajax({
                    url: "./orderFood.php",
                    method: "POST",
                    data: {
                        data: $tableID,
                    },

                    success: function(data) {
                        $("#orderfood").html(data);

                    }
                });
            }
        }
    </script>


</body>

</html>