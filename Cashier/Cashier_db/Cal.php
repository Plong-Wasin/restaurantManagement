<?php
include("../../require/connectDB.php");
$totalprice = mysqli_real_escape_string($conn, $_POST["data"]);
$Cash = mysqli_real_escape_string($conn, $_POST["data1"]);
$Change = $Cash - $totalprice;
?>
<link rel="stylesheet" href="../CSS/css/tableCheckBin.css">
<table>
    <tr>
        <td>เงินสด</td>
        <td><?php echo $Cash ?></td>
        <td>บาท</td>
    </tr>

    <tr>
        <td>ราคาอาหาร</td>
        <td><?php echo $totalprice ?></td>
        <td>บาท</td>
    </tr>

    <tr>
        <td>เงินทอน</td>
        <td><?php echo $Change ?></td>
        <td>บาท</td>
    </tr>
</table>