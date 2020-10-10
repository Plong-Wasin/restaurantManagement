<?php
include(__DIR__ . "/../../require/connectDB.php");
if (!isset($_POST["mode"])) {
    $_POST["mode"] = 2;
}
if ($_POST["mode"] == 1) {
    $query = "SELECT * FROM queue ORDER BY queue_book_timestamp ASC";
} elseif ($_POST["mode"] == 2) {
    $query = "SELECT * FROM queue WHERE queue_in_timestamp IS NULL
    ORDER BY queue_book_timestamp ASC";
} elseif ($_POST["mode"] == 3) {
    $query = "SELECT * FROM (Select * FROM queue WHERE queue_in_timestamp IS NOT NULL ORDER BY queue_book_timestamp DESC ) SUB ORDER BY queue_book_timestamp ASC";
}

$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_array($result)) {

?>
    <tr class=<?php
                if (is_null($row["queue_in_timestamp"])) {
                    echo "table-primary text-center";
                } else
                    echo "table-success text-center";
                ?>>
        <td scope="row" class="text-center"><?php echo $row["queue_name"] ?></td>
        <td class="text-center"><?php echo $row["queue_people"] ?></td>
        <td class="text-center">
            <?php
            if (is_null($row["queue_in_timestamp"])) {
                echo "กำลังอยู่ในคิว";
            } else
                echo "เข้าร้านแล้ว";
            ?>
        </td>
        <td class="text-center">
            <?php
            echo $row["queue_book_timestamp"];
            ?>
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-secondary" onclick="cancelQueue(<?php echo $row['queue_id'] ?>);">ยกเลิก</button>
            <button type="button" class="btn btn-success" onclick="inQueue(<?php echo $row['queue_id'] ?>);" <?php
                                                                                                                if (!is_null($row["queue_in_timestamp"])) {
                                                                                                                    echo "disabled";
                                                                                                                }
                                                                                                                ?>>เข้าร้าน</button>
        </td>
    </tr>
<?php } ?>