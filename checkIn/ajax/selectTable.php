<?php
require_once("../../require/connectDB.php");
$sql = "SELECT * FROM `table` WHERE table_status=0";
if (!$result = mysqli_query($conn, $sql)) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>
<select class="form-control" id="table">
    <?php while ($row = mysqli_fetch_array($result)) {
        if (!$row["table_status"]) {
    ?>
            <option value="<?php echo $row["table_id"] ?>">โต๊ะ <?php echo $row["table_id"] ?> นั่งได้ <?php echo $row["table_people"] ?> คน</option>
    <?php }
    } ?>
</select>