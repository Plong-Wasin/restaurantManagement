<?php
require_once(__DIR__ . "/../../require/connectDB.php");
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">หมวดหมู่</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <?php
            $sql = "SELECT * FROM setting WHERE name='recommend'";
            $result = mysqli_query($conn, $sql);
            $recommend = 0;
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_array($result)) {
                    if ($row["value"] == "1") { ?>
                        <li class="nav-item active">
                            <a class="nav-link" id="tab_recommend" href="#" data-value="0"><?php echo "เมนูแนะนำ" ?></a>
                        </li>
                    <?php
                        $recommend = 1;
                    }
                }
            }
            $tab_query = "SELECT * FROM food_type ORDER BY food_type_id ASC";
            $tab_result = mysqli_query($conn, $tab_query);
            $tab_menu = '';
            $tab_content = '';
            $i = 0;
            if (isset($_POST['foodTypeId'])) {
                $i = 1;
            } else {
                $_POST['foodTypeId'] = 0;
            }
            while ($row = mysqli_fetch_array($tab_result)) {
                if (($i == 0 || $_POST['foodTypeId'] == $row['food_type_id']) && $recommend == 0) {
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
<script>
    $(document).ready(function() {
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
                }
            });
        });
    });
</script>