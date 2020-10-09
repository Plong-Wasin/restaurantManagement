<?php

require("../require/connectDB.php");
include("server.php");
$table_id = mysqli_real_escape_string($conn, $_POST["data"]);

if (isset($_POST['data']))
    $tableId = $_POST['data'];
if ($tableId == null)
    //header("Location:../customer/enterCode.php");
?>
<?php
include_once("../require/req.php");
?>
<script>
    $(document).ready(function() {
        // setTimeout(() => {
        //     $("#cartIcon").click();
        // }, 500);
        $("#foodAmount").bind('keyup mouseup', goToCalPrice);
        $('#foodOrder_form').on("submit", function(event) {
            event.preventDefault();
            $.ajax({
                url: "./ajax/insertOrderFood.php",
                method: "POST",
                data: $('#foodOrder_form').serialize() + "&tableId=" + <?php echo $tableId; ?>,
                beforeSend: function() {
                    //document.getElementById("insert").innerText = "กำลังประมวลผล";
                },
                success: function(data) {
                    $('#foodOrder_form')[0].reset();
                    $('#modalOrder').modal('hide');
                }
            });
        });
        $("#currentCart,#cartIcon").click(function() {
            $("#history").removeClass("active");
            $("#currentCart").addClass("active");
            callAjaxGetData();
            // callAjaxGetData();
        });
        $(".nav-item").click(function() {
            document.getElementById("search").value = '';
            $('.navbar-collapse').collapse('hide');
            $(".nav-item.active").removeClass("active");
            //console.log($(this)[0].children[0].attributes.value.value);

            //console.log($(this).children(".nav-link").data("value"));
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

        $('#history').on("click", function(event) {
            callAjaxHistoryOrder();
        });
        $('#search').on('search', function() {
            callAjaxSelectFoodType();
        });
        $('#search').on('keyup mouseup', function() {
            if ($('#search').val().replaceAll(" ", "") == '') {
                callAjaxSelectFoodType();
            } else {
                event.preventDefault();
                $.ajax({
                    url: './ajax/searchFood.php',
                    method: 'POST',
                    data: {
                        search: $('#search').val().replaceAll(" ", "")
                    },
                    beforeSend: function() {},
                    success: function(data) {
                        $("#tableFoodList").html(data);
                    }
                });
            }
        });

    })

    function logout() {
        location.reload('../orderStaffSceen.php');
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

    function callAjaxConfirmOrder() {
        $.ajax({
            url: "./ajax/confirmOrder.php",
            method: "POST",
            data: {
                tableId: <?php echo $tableId ?>
            },
            success: function(data) {
                callAjaxGetData();
            }
        });

    }

    function callAjaxHistoryOrder() {
        $.ajax({
            url: "./ajax/historyOrder.php",
            method: "POST",
            data: {
                tableId: <?php echo $tableId; ?>
            },
            success: function(result) {
                $("#table").html(result);
            }
        });
    }

    function deleteHistoryRecord(order_list_id) {
        if (confirm("แน่ใจที่จะยกเลิกรายการอาหาร")) {
            $.ajax({
                url: "./ajax/deleteHistoryRecord.php",
                method: "POST",
                data: {
                    order_list_id: order_list_id
                },
                success: function(result) {
                    callAjaxHistoryOrder();
                }
            });
        }
    }

    function callAjaxGetData() {
        $.ajax({
            url: "./ajax/getData.php",
            method: "POST",
            data: {
                tableId: <?php echo $tableId ?>
            },
            success: function(result) {
                $("#table").html(result);
            }
        });
    }


    function goToCalPrice() {
        if (document.getElementById("foodAmount").value > 99) {
            document.getElementById("foodAmount").value = 99;
        } else if (document.getElementById("foodAmount").value == "") {

        } else if (document.getElementById("foodAmount").value < 1) {
            document.getElementById("foodAmount").value = 1;
        }
        var foodPrice = document.getElementById("foodPrice").value;
        calPrice(foodPrice);
    }



    function orderFood(foodId, foodName, foodPrice) {
        document.getElementById("foodAmount").onchange = function() {
            calPrice(foodPrice);
        }
        document.getElementById("foodOrder_form").reset();
        document.getElementById("total").innerText = 0;
        document.getElementById("foodId").value = foodId;
        document.getElementById("foodPrice").value = foodPrice;
        document.getElementById("modalOrderTitle").innerText = "สั่ง " + foodName + "ราคา " + foodPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " ต่อหน่วย";
        event.preventDefault();
        $.ajax({
            url: './ajax/checkEmpty.php',
            method: 'POST',
            data: {
                foodId: foodId
            },
            beforeSend: function() {},
            success: function(data) {
                if (data == '0') {
                    callAjaxSelectFoodType();
                    setTimeout(() => {
                        $("#modalOrder").modal('hide');
                    }, 500);

                }
            }
        });
    }



    function calPrice(foodPrice) {
        var amount = document.getElementById("foodAmount").value;
        var total = foodPrice * amount;
        document.getElementById("total").innerText = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    }

    function minus() {
        if (isNaN(document.getElementById("foodAmount").value) || document.getElementById("foodAmount").value == "")
            document.getElementById("foodAmount").value = 1
        else if (document.getElementById("foodAmount").value > 1)
            document.getElementById("foodAmount").value = parseInt(document.getElementById("foodAmount").value) - 1;
        goToCalPrice();
    }

    function plus() {
        if (isNaN(document.getElementById("foodAmount").value) || document.getElementById("foodAmount").value == "")
            document.getElementById("foodAmount").value = 1
        else if (document.getElementById("foodAmount").value < 99)
            document.getElementById("foodAmount").value = parseInt(document.getElementById("foodAmount").value) + 1;
        goToCalPrice();
    }

    function deleteOrder(orderId) {
        if (confirm("แน่ใจนะที่จะลบรายการนี้")) {
            $.ajax({
                url: "./ajax/deleteOrder.php",
                method: "POST",
                data: {
                    data: orderId
                },
                success: function(data) {
                    callAjaxGetData();
                }
            });
        }
    }
</script>
<style>
    .minus,
    .plus {
        cursor: pointer;

        border-radius: 4px;
        padding: 6px 10px 6px 10px;
        border: 1px solid #ddd;

        vertical-align: middle;
        text-align: center;
    }

    .number-cart-icon {
        position: relative;
        border-radius: 2.75rem;
        min-width: .6875rem;
        line-height: 1.2em;
        padding: 0 .3125rem;
        text-align: center;
        height: 1rem;
        border: .125rem solid #ee4d2d;
        color: #ee4d2d;
        background-color: #fff;
        left: 1rem;
        top: -3rem;
        margin-right: -.875rem;
    }

    .bg-none {
        padding: 0;
        border: none;
        background: none;
    }
</style>
</head>

<body>
    <div class="container">
        <div class="text-right">
            <button type="button" class="btn btn-primary" onclick="logout();">เลือกโต๊ะ</button>
        </div>
        <h2 class="text-center py-3">สั่งอาหารโต๊ะ <?php echo $tableId; ?></h2>


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
                <input class="form-control mr-sm-2" id="search" type="search" placeholder="Search" aria-label="Search">
            </div>


        </nav>
        <div class="text-right">
            <button id="cartIcon" class="bg-none" type="button" data-toggle="modal" data-target="#modalCart">
                <img src="../src/img/dinner.png" class="rounded float-right" width="50" height="auto" alt="">
                <div id="cartNo">
                    <!-- <span class="number-cart-icon">1</span> -->
            </button>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th width="200" class="text-center">รูป</th>
                    <th>ชื่ออาหาร</th>
                    <th>ราคา (บาท)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tableFoodList">
                <?php
                include("./ajax/selectFoodType.php");
                ?>
                <!-- <?php
                        $food_query = "SELECT * FROM food WHERE food_type_id=" . $firstFoodType . " ORDER BY  food_have DESC, food_name ASC";
                        $food_result = mysqli_query($conn, $food_query);
                        while ($row = mysqli_fetch_array($food_result)) {
                        ?>
                    <tr>
                        <td scope="row"><img src="../src/img/food/<?php echo $row["food_image"] ?>" height="auto" width="100%" class="img-thumbnail" /></td>
                        <td><?php echo $row["food_name"] ?></td>
                        <td><?php echo $row["food_price"] ?></td>
                        <?php
                            if ($row["food_have"] == 1) {
                        ?>
                            <td><button class="btn btn-primary" val="<?php echo $row["food_id"] ?>" onclick="orderFood('<?php echo $row['food_id'] ?>','<?php echo $row['food_name'] ?>',<?php echo $row['food_price'] ?>);" data-toggle="modal" data-target="#modalOrder">สั่งอาหาร</button></td>
                        <?php
                            } else {
                        ?>
                            <td><button class="btn btn-secondary" disabled val="<?php echo $row["food_id"] ?>" onclick="orderFood('<?php echo $row['food_id'] ?>','<?php echo $row['food_name'] ?>',<?php echo $row['food_price'] ?>);" data-toggle="modal" data-target="#modalOrder">อาหารหมด</button></td>

                        <?php
                            }
                        ?>
                    </tr>
                <?php
                        }
                ?> -->
            </tbody>
        </table>
    </div>
    <!-- Button trigger modal
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalOrder">
        สั่งอาหาร
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="modalOrder" tabindex="-1" role="dialog" aria-labelledby="modalOrderTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" id="foodOrder_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalOrderTitle">สั่งอาหาร</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="foodId" name="foodId">
                        <input type="hidden" id="foodPrice" name="foodPrice">
                        <label for="foodAmount" class="col-sm-12 col-form-label">จำนวน</label>
                        <div class="col-sm-12">

                            <div class="row">
                                <div class="col-2 pt-1">
                                    <span class="minus" onclick="minus()">-</span>
                                </div>
                                <div class="col-8 text-right">
                                    <input id="foodAmount" type="number" style="font-size:85%;" class="form-control text-right" name="foodAmount" id="foodAmount" min="1" max="99" placeholder="จำนวนที่ต้องการสั่ง" required="">
                                </div>
                                <div class="col-2 text-right pt-1">
                                    <span class="plus" onclick="plus()">+</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <div class="row">
                                <div class="col-2">
                                    รวม
                                </div>
                                <div class="col-8 text-right" id="total">
                                    0
                                </div>
                                <div class="col-2 text-right">
                                    บาท
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-primary">สั่งอาหาร</button>
                    </div>
                </div>
            </form>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade " id="modalCart" tabindex="-1" role="dialog" aria-labelledby="cartTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">รายการอาหารที่สั่ง</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <nav class="nav nav-pills nav-justified m-1" id="tab">
                        <a class="nav-link active m-1" data-toggle="tab" id="currentCart">ตะกร้าสั่งอาหาร</a>
                        <a class="nav-link m-1" data-toggle="tab" id="history">ประวัติการสั่งอาหาร</a>
                    </nav>
                    <div id="table">
                        <table class="table" id="cartTable">
                            <thead>
                                <tr>
                                    <th scope="col">ชื่ออาหาร</th>
                                    <th scope="col">จำนวน</th>
                                    <th scope="col">ราคาต่อหน่วย</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="cart">
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>