<?php
require_once("server.php")
?>
<?php
$readstaff = "SELECT * FROM users";
$result = mysqli_query($conn, $readstaff);
if ($result) {
    while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
        <tr>
            <td scope="row"><?php echo $record['username'] ?> </td>
            <td><?php echo $record['role'] ?> </td>
            <td><?php echo $record['password'] ?> </td>
            <td>
                <div class="ButtonDelete">
                    <button class="btn btn-success" type="button" name="id-to-del" value=" <?php echo $record['username'] ?> " onclick="deletestaff('<?php echo $record['username'] ?> ')">ลบ</button>
                </div>
            </td>
        </tr>
<?php
    }
}
?>