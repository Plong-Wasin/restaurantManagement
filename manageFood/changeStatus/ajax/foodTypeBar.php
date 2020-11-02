<?php
require_once(__DIR__ . "/../../../require/connectDB.php");

$tab_query = "SELECT food_type_name FROM food_type ORDER BY food_type_id ASC";
$tab_result = mysqli_query($conn, $tab_query);
$tab_menu = '';
$tab_content = '';
$len = 0;
while ($row = mysqli_fetch_array($tab_result)) {
    $len = $len + strlen($row["food_type_name"]);
}
?>

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
            if (isset($_POST['foodTypeId'])) {
                $i = 1;
            } else {
                $_POST['foodTypeId'] = 0;
            }

            while ($row = mysqli_fetch_array($tab_result)) {
                if ($i == 0 || $_POST['foodTypeId'] == $row['food_type_id']) {
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
    // $(document).ready(function() {
    //     let oldData = getCheckbox();
    //     $(".nav-item").click(function() {
    //         if (oldData != getCheckbox()) {
    //             console.log(oldData)
    //             console.log(getCheckbox())
    //             if (confirm("ต้องการที่จะละทิ้งการบันทึกไหม")) {
    //                 $('.navbar-collapse').collapse('hide');
    //                 $(".nav-item.active").removeClass("active");
    //                 $(this).addClass("active");
    //                 $.ajax({
    //                     url: "./ajax/selectFoodType.php",
    //                     method: "POST",
    //                     data: {
    //                         foodTypeId: $(this).children(".nav-link").data("value")
    //                     },
    //                     success: function(data) {
    //                         $("#tableFoodList").html(data);
    //                         oldData = getCheckbox();
    //                     }
    //                 });
    //             }
    //         }
    //     });
    // });
    // $(document).ready(function() {
    //     $(".nav-item").click(function() {
    //         $('.navbar-collapse').collapse('hide');
    //         $(".nav-item.active").removeClass("active");
    //         $(this).addClass("active");
    //         $.ajax({
    //             url: "./ajax/selectFoodType.php",
    //             method: "POST",
    //             data: {
    //                 foodTypeId: $(this).children(".nav-link").data("value")
    //             },
    //             success: function(data) {
    //                 $("#tableFoodList").html(data);
    //             }
    //         });
    //     });
    // });
</script>