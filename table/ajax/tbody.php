<?php
require_once(__DIR__ . "/../../require/connectDB.php");
if (!isset($_SESSION)) {
    session_start();
}
$sql = "SELECT * FROM `table`";
if (!$result = mysqli_query($conn, $sql)) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
while ($row = mysqli_fetch_array($result)) { ?>
    <tr>
        <td scope="row"><?php echo $row["table_id"] ?></td>
        <td><?php echo $row["table_people"] ?></td>
        <td>
            <?php
            if (!$row["table_status"]) {
                echo 'ว่าง';
            } else
                echo 'กำลังใช้บริการ';
            ?>
        </td>
        <td>
            <?php
            if (!$row["table_status"]) {
                echo "-";
            } else {
                $tableId = $row['table_id'];
                $sql = "SELECT code FROM check_in WHERE table_id=$tableId ORDER BY check_in_id DESC LIMIT 1";
                $resultCode = mysqli_query($conn, $sql);
                if (mysqli_num_rows($resultCode) > 0) {
                    // output data of each row
                    while ($rowCode = mysqli_fetch_array($resultCode)) {
                        echo $rowCode["code"];
                    }
                }
            }
            ?>
        </td>
        <td>
            <?php
            if ($_SESSION["role"] == "admin") {
            ?>
                <button type="button" class="btn btn-primary" onclick=<?php echo "editTable(" . $row["table_id"] . ")" ?> data-toggle="modal" data-target="#editTable">แก้ไข</button>
            <?php } ?>
        </td>
    </tr>
<?php } ?>