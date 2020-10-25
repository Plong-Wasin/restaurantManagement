<?php
if ($_POST["topic"] == "ภาพรวม") {
?>
    <tr>
        <th>ลำดับ</th>
        <th>วันเวลาที่เข้า</th>
        <th>วันเวลาที่จ่ายเงิน</th>
        <th class="text-right">ยอดขาย(บาท)</th>
    </tr>
<?php
} else {
?>
    <tr>
        <th>ชื่ออาหาร</th>
        <th class="text-right">ราคาต่อหน่วย</th>
        <th class="text-right">จำนวน</th>
        <th class="text-right">ราคารวม</th>
    </tr>
<?php } ?>