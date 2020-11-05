<?php
require_once("../../require/connectDB.php")
?>
<div class="work">
    <button onclick="work()" class="work" style="    display: inline-flex;    height: 40px;    width: 150px;    border: 2px solid;    margin: 15px;    text-transform: uppercase;    text-decoration: none;    font-size: 16px;    letter-spacing: 1.5px;    align-items: center;    justify-content: center;    overflow: hidden; ">ที่ทำงานอยู่</button>
</div>
<div class=" notwork">
    <button onclick="notwork()" lass="notwork" style="    display: inline-flex;    height: 40px;    width: 150px;    border: 2px solid;    margin: 1px 15px 15px 15px;    text-transform: uppercase;    text-decoration: none;    font-size: 16px;    letter-spacing: 1.5px;    align-items: center;    justify-content: center;    overflow: hidden;background: darkgrey;">ออกจากงานแล้ว</button>
</div>
<table>
    <thead>
        <tr class=" table100-head">
            <th>ชื่อผู้ใช้</th>
            <th>ชื่อพนักงาน</th>
            <th>ตำแหน่ง</th>
            <th>วันที่ออก</th>
        </tr>
    </thead>
    <tbody id="tableBody">
        <?php
        $readstaff = "SELECT * FROM `users` WHERE `status` = 0 ORDER BY `users`.`date_leavework`  DESC";
        $result = mysqli_query($conn, $readstaff);
        if ($result) {
            while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $record['username'] . "</td>";
                if ($record['first_name']  == null) {
                    echo "<td>" . "ยังไม่มีข้อมูล" . "</td>";
                } else {
                    echo "<td>" . $record['first_name'] . "     " . $record['last_name'] . "</td>";
                }
                echo "<td>" . $record['role'] . "</td>";
                //echo '<td><button type="button" name="id-to-del" value="' . $record['username'] . '" onclick="deletestaff(' . $record['username'] . ')>ลบ</button></td>';
                echo "<td>" .  $record['date_leavework'] . "</td>";
        ?>
        <?php echo '</tr>';
            }
        }
        ?>
    </tbody>
</table>