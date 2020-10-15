<?php
include("../require/connectDB.php");
$orderid = mysqli_real_escape_string($conn, $_POST["data"]); ?>
</head>

<body>
    <?php
    $totalFood_amount = 0;
    $totalPrice = 0;
    $change = 0;
    $cash = 0;
    ?>
    <table>
        <tr>
            <th>ชื่ออาหาร</th>
            <th>จำนวน</th>
            <th>ราคา(ต่อหนึ่งรายการ)</th>
            <th>ราคา(ทั้งหมด)</th>
        </tr>
        <?php
        $checkIn = "SELECT * FROM `check_in` WHERE table_id = $orderid and paid_timestamp is NULL ";
        $check = mysqli_query($conn, $checkIn);
        while ($record = mysqli_fetch_array($check, MYSQLI_ASSOC)) {
            $checkInId = $record['check_in_id'];
            $tableId = $record['table_id'];
        }
        $subSql = "SELECT order_list.food_name,order_list.food_price,SUM(order_list.food_amount) as sumFood_amount FROM check_in INNER JOIN order_time ON check_in.check_in_id=order_time.check_in_id INNER JOIN order_list ON order_time.order_time_id = order_list.order_time_id WHERE check_in.check_in_id=$checkInId AND order_list.food_cook=3 GROUP BY order_list.food_id,order_list.food_price";
        $subResult = mysqli_query($conn, $subSql);
        while ($subRow = mysqli_fetch_array($subResult, MYSQLI_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $subRow['food_name'] . "</td>";
            echo "<td>" . $subRow['sumFood_amount'] . "</td>";
            echo "<td>" . $subRow['food_price'] . "</td>";
            echo "<td>" . $subRow['sumFood_amount'] * $subRow['food_price'] . "</td>";
        ?>
            <?php echo '</tr>'; ?>
        <?php
            $totalFood_amount =  $totalFood_amount + $subRow['sumFood_amount'];
            $totalPrice =   $totalPrice + $subRow['sumFood_amount'] * $subRow['food_price'];
        }
        ?>
        <tr>
            <td>รวม</td>
            <td><?php echo $totalFood_amount ?></td>
            <td>---</td>
            <td><?php echo $totalPrice ?> บาท</td>
        </tr>

    </table>
    <div id=cal>
    </div>
    เงินสด
    <input class="fname" id=fname type="text" name="text_plain" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" onchange="cal(<?php echo $totalPrice ?>)" />

    <div id=cal>
    </div>
    <button class="CheckBin" onclick="CheckBin(<?php echo $checkInId ?> , <?php echo $tableId ?> )">คิดเงิน</button>
    <script>
        function CheckBin(checkInId, tableId, cash) {
            $n = cash;
            if (confirm("ยืนยัน"))
                $.ajax({
                    url: "./Cashier_db/CheckBin.php",
                    method: "POST",
                    data: {
                        data: checkInId,
                        data1: tableId,

                    },
                    success: function(data) {
                        alert("คิดเงินเสร็จสิ้น");
                        location.reload('./CashierScreen.php');
                    }
                });
        }

        function PrintBin(checkInId, tableId, cash) {
            $n = cash;
            if (confirm("ยืนยัน"))
                $.ajax({
                    url: "./Cashier_db/PrintBin.php",
                    method: "POST",
                    data: {
                        data: checkInId,
                        data1: tableId,

                    },
                    success: function(data) {
                        window.open("./Cashier_db/PrintBin.php");
                    }
                });
        }

        src = "https://code.jquery.com/jquery-3.5.1.min.js"

        function cal(totalPrice) {
            $.ajax({
                url: "./Cashier_db/Cal.php",
                method: "POST",
                data: {
                    data: totalPrice,
                    data1: document.getElementById("fname").value,
                },
                success: function(data) {
                    $("#cal").html(data);
                }
            });
        }
    </script>