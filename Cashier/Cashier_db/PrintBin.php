<?php
include("../../require/connectDB.php");
?>
<html>

<body>
    <table>
        <tr>
            <th style="text-align: center;">ใบเสร็จรับเงิน</th>
        </tr>
        <tr>
            <th style=" text-align: center;"><?php echo "Today is " . date("Y/m/d") . "<br>"; ?></th>
        </tr>
        <tr>
            <td>Peter</td>
            <td>Griffin</td>
            <td>$100</td>
        </tr>
        <tr>
            <td>Cleveland</td>
            <td>Brown</td>
            <td>$250</td>
        </tr>
    </table>
</body>

</html>
<script>
    window.print()
</script>