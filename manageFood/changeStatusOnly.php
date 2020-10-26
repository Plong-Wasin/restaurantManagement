<?php
include("../Session/Check_Session.php");
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
$tab_query = "SELECT food_type_name FROM food_type ORDER BY food_type_id ASC";
$tab_result = mysqli_query($conn, $tab_query);
$tab_menu = '';
$tab_content = '';
$len = 0;
while ($row = mysqli_fetch_array($tab_result)) {
    $len = $len + strlen($row["food_type_name"]);
}
?>
<script>
    $(document).ready(function() {

        $(".nav-item").click(function() {
            $('.navbar-collapse').collapse('hide');
            $(".nav-item.active").removeClass("active");
            $(this).addClass("active");
            $.ajax({
                url: "./ajax/kitchenSelectFoodType.php",
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

    function callAjaxKitchenSelectFoodType() {
        $.ajax({
            url: "./ajax/kitchenSelectFoodType.php",
            method: "POST",
            data: {
                foodTypeId: $(".nav-item.active").children(".nav-link").data("value")
            },
            success: function(data) {
                $("#tableFoodList").html(data);
            }
        });
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
                callAjaxKitchenSelectFoodType();
            }
        });
    }
</script>

</head>

<body>
    <div class="container">
        <h2 class="text-center p-2">จัดการเมนูอาหาร</h2>

        <nav class="navbar <?php if ($len < 170) echo "navbar-expand-lg"; ?> navbar-light bg-light">
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
                include_once("./ajax/kitchenSelectFoodType.php");
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>