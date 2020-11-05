<?php
require_once("../../require/connectDB.php")
?>
<div class="work">
    <button onclick="work()" class="work" style="    display: inline-flex;    height: 40px;    width: 150px;    border: 2px solid;    margin: 15px;    text-transform: uppercase;    text-decoration: none;    font-size: 16px;    letter-spacing: 1.5px;    align-items: center;    justify-content: center;    overflow: hidden; background: darkgrey">ที่ทำงานอยู่</button>
</div>
<div class="notwork">
    <button onclick="notwork()" lass="notwork" style="    display: inline-flex;    height: 40px;    width: 150px;    border: 2px solid;    margin:1px 15px 15px 15px;    text-transform: uppercase;    text-decoration: none;    font-size: 16px;    letter-spacing: 1.5px;    align-items: center;    justify-content: center;    overflow: hidden;">ออกจากงานแล้ว</button>
</div>
<table>
    <thead>
        <tr class="table100-head">
            <th>ชื่อผู้ใช้</th>
            <th>ชื่อพนักงาน</th>
            <th>ตำแหน่ง</th>
            <th>แก้ไขข้อมูล</th>
        </tr>
    </thead>
    <tbody id="tableBody">
        <?php
        $readstaff = "SELECT * FROM users WHERE `status` = 1";
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
        ?>
                <td>
                    <img class="ImgDelete" style="width: 20px;height: 27px;" value=" <?php echo $record['username'] ?> " onclick="deletestaff('<?php echo $record['username'] ?> ')" src="../src/img/t.png">
                    <img class="ImgDelete" style="width: 20px;height: 20px;margin-bottom: 3px;" value="" src="../src/img/edit.png" onclick="window.location.href='../editProfile/editProfileByadmin.php?id=<?php echo $record['id'] ?>'">
                </td>
        <?php echo '</tr>';
            }
        }
        ?>
    </tbody>
</table>