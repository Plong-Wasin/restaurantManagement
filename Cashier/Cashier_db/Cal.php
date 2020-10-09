<?php
include("../../require/connectDB.php");
$totalprice = mysqli_real_escape_string($conn, $_POST["data"]);
$Cash = mysqli_real_escape_string($conn, $_POST["data1"]);
$Change = $Cash - $totalprice;
?>
<tr>
    <td>เงินสด</td>
    <td><?php echo $Cash ?> บาท</td>
</tr>

<tr>
    <td>ราคาอาหาร</td>
    <td><?php echo $totalprice ?> บาท</td>
</tr>

<tr>
    <td>เงินทอน</td>
    <td><?php echo $Change ?> บาท</td>
</tr>