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
    </div>

</nav>