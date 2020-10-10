<?php
require_once("../../require/connectDB.php");
?>
<?php
$tab_query = "SELECT food_type_name,food_type_id FROM food_type ORDER BY food_type_id ASC";
$tab_result = mysqli_query($conn, $tab_query);
while ($row = mysqli_fetch_array($tab_result)) {
?>
    <option value="<?php echo $row["food_type_id"] ?>">
        <?php echo $row["food_type_name"] ?>
    </option>
<?php
}
?>