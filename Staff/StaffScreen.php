<?php include('../Session/Check_Session.php'); ?>
<?php
include('./Staff_db/server.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>พนักงาน</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../../CSS/Staff.css">
</head>

<body>
    <?php include("../Sidebar/Sidebar.php") ?>
    <div id="spanusers">
        <table>
            <tr>
                <th>ชื่อพนักงาน</th>
                <th>ตำแหน่ง</th>
                <th>รหัสผ่าน</th>
                <th>ลบพนักงาน</th>
            </tr>
            <tbody id="tableBody">
                <?php
                $readstaff = "SELECT * FROM users";
                $result = mysqli_query($conn, $readstaff);
                if ($result) {
                    while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $record['username'] . "</td>";
                        echo "<td>" . $record['role'] . "</td>";
                        echo "<td>" . $record['password'] . "</td>";
                        //echo '<td><button type="button" name="id-to-del" value="' . $record['username'] . '" onclick="deletestaff(' . $record['username'] . ')>ลบ</button></td>';
                ?>
                        <td>
                            <div class="ButtonDelete">
                                <button class="btn btn-success" type="button" name="id-to-del" value=" <?php echo $record['username'] ?> " onclick="deletestaff('<?php echo $record['username'] ?> ')">ลบ</button>
                            </div>
                        </td>
                <?php echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="register">
        <form id="registerForm" method="POST" onsubmit="return false">
            <div class="HeaderRegister">เพิ่ม/ลบพนักงาน </div>
            <div class="BodyRegister">
                <div class="Input">
                    <label for="username">ชื่อพนักงาน<br></label>
                    <Input type="text" name="username" required>
                </div>
                <label> ตำแหน่ง<br></label>
                <select class="selectjob" type="role" name="role" value="<?php echo $role; ?>">
                    <option value="admin">ผู้ดูแลร้าน</option>
                    <option value="WelcomeStaff">พนักงานต้อนรับ</option>
                    <option value="ServiceStaff">พนักงานบริการ</option>
                    <option value="KitchenStaff">พนักงานในห้องครัว</option>
                    <option value="CashierStaff">พนักงานเก็บเงิน</option>
                </select>
                <div class="Input">
                    <label for="password_1">รหัสผ่าน<br></label>
                    <Input type="password" name="password_1" id="password_1" required>
                </div>
                <div class="Input">
                    <label for="password_2">ยืนยันรหัสผ่าน<br></label>
                    <Input type="password" name="password_2" id="password_2" required>
                </div>
                <div class="ButtonRegister">
                    <button id="submitRegis" type="submit" name="reg_user" class="btn">Register</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            document.getElementsByClassName("ButtonRegister")[0].click();
            $('#registerForm').on("submit", function(event) {

                if (document.getElementById("password_1").value != document.getElementById("password_2").value) {
                    alert("รหัสผ่านไม่ตรงกัน");
                    document.getElementById("registerForm").reset;
                } else {
                    event.preventDefault();
                    $.ajax({
                        url: "./Staff_db/GetStaff.php",
                        method: "POST",
                        data: $('#registerForm').serialize(),
                        success: function(data) {
                            getStaff();
                            document.getElementById("registerForm").reset();
                        }
                    });
                }

            });
        });

        function getStaff() {
            $.ajax({
                url: "./Staff_db/AjexStaff.php",
                success: function(data) {
                    $("#tableBody").html(data);
                }
            });
        }

        function deletestaff(username) {
            if (confirm("แน่ใจนะที่จะลบพนักงานนี้"))
                $.ajax({
                    url: "./Staff_db/DeleteStaff.php",
                    method: "POST",
                    data: {
                        data: username
                    },
                    success: function(data) {
                        //$("#spanusers").html(data);
                        getStaff();
                        //location.reload();

                    }
                })
        }
    </script>
</body>

</html>