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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>ชื่ออาหาร</th>
                    <th class="text-right">ราคาต่อหน่วย</th>
                    <th class="text-right">จำนวน</th>
                    <th class="text-right">ราคารวม</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT order_list.food_name,order_list.food_price,sum(order_list.food_amount) as sum_food_amount,sum(order_list.food_amount)*order_list.food_price AS total_price FROM check_in INNER JOIN order_time ON check_in.check_in_id=order_time.check_in_id INNER JOIN order_list ON order_time.order_time_id = order_list.order_time_id WHERE order_list.food_cook=3 AND check_in.paid_timestamp IS NOT NULL GROUP BY order_list.food_name,order_list.food_price ORDER BY order_list.food_name";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td scope="row"><?php echo $row["food_name"] ?></td>
                            <td class="text-right"><?php echo number_format($row["food_price"]) ?></td>
                            <td class="text-right"><?php echo number_format($row["sum_food_amount"]) ?></td>
                            <td class="text-right"><?php echo number_format($row["total_price"]) ?></td>
                        </tr>
                        <tr style="" class="subTable<?php echo $i ?> table-secondary">
                            <th colspan="2">วัน/เดือน/ปี</th>
                            <th class="text-right">จำนวน</th>
                            <th class="text-right">ราคารวม(บาท)</th>
                        </tr>
                        <?php
                        $subSql = "SELECT order_list.food_name,DATE(check_in.paid_timestamp) AS paidDate,order_list.food_amount,order_list.food_amount*order_list.food_price AS total_price FROM check_in INNER JOIN order_time ON check_in.check_in_id=order_time.check_in_id INNER JOIN order_list ON order_time.order_time_id = order_list.order_time_id WHERE order_list.food_cook=3 AND check_in.paid_timestamp  IS NOT NULL AND order_list.food_name='{$row["food_name"]}' GROUP BY order_list.food_name,order_list.food_price,DATE(check_in.paid_timestamp)";
                        $subResult = mysqli_query($conn, $subSql);
                        if (mysqli_num_rows($subResult) > 0) {
                            // output data of each row
                            while ($subRow = mysqli_fetch_array($subResult)) {
                        ?>
                                <tr class="subTable<?php echo $i ?> table-info">
                                    <?php //$date = $subRow['paidDate']; 
                                    $date = date_create($subRow["paidDate"]);
                                    ?>
                                    <td scope="row" colspan="2"><?php echo date_format($date, "d/m/Y"); //echo date_format($subRow["paidDate"], "Y/m/d H:i:s");
                                                                ?></td>
                                    <td class="text-right"><?php echo $subRow['food_amount'] ?></td>
                                    <td class="text-right"><?php echo number_format($subRow['total_price']) ?></td>
                                </tr>
                <?php }
                        }
                    }
                }
                ?>

            </tbody>
        </table>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>