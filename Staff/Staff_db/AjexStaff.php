<?php
require_once("../../require/connectDB.php")
?>
<?php
$readstaff = "SELECT * FROM users";
$result = mysqli_query($conn, $readstaff);
if ($result) {
    while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $record['username'] . "</td>";
        echo "<td>" . $record['first_name'] . "     " . $record['last_name'] . "</td>";
        echo "<td>" . $record['role'] . "</td>";
        echo "<td>" . $record['password'] . "</td>";
        //echo '<td><button type="button" name="id-to-del" value="' . $record['username'] . '" onclick="deletestaff(' . $record['username'] . ')>ลบ</button></td>';
?>
        <td>
            <img class="ImgDelete" style="width: 20px;height: 27px;" value=" <?php echo $record['username'] ?> " onclick="deletestaff('<?php echo $record['username'] ?> ')" src="../src/img/t.png">
            <img class="ImgDelete" style="width: 20px;height: 20px;margin-bottom: 3px;" value="" src="../src/img/edit.png" onclick="window.location.href='../editProfile/editProfileByadmin.php?id=<?php echo $record['id'] ?>'">
        </td>
<?php echo '</tr>';
    }
}
?>