<?php
require_once("../../require/connectDB.php");
if (!empty($_POST)) {
    $output = '';
}
$tableNo = mysqli_real_escape_string($conn, $_POST["tableNo"]);
do {
    $code = randString(4);
    $query = "SELECT * FROM `check_in` WHERE `code` = $code AND `paid_timestamp` IS NOT NULL";
    $result = mysqli_query($conn, $query);
    if (!$row = mysqli_fetch_array($result)) {
        break;
    }
} while (1);
$query = "
INSERT INTO check_in(table_id,code)  
    VALUES('$tableNo','$code')
";
if (mysqli_query($conn, $query)) {
    echo 'โต๊ะเบอร์ ' . $tableNo . ' รหัสเข้าใช้งานลูกค้าคือ ' . $code;
?>
    <?php
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
$query = "
    UPDATE `table`
    SET table_status = 1
    WHERE table_id = '$tableNo';
    ";
if (!mysqli_query($conn, $query)) {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
function randString($length)
{
    //    $char = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $char = "0123456789";
    $char = str_shuffle($char);
    for ($i = 0, $rand = '', $l = strlen($char) - 1; $i < $length; $i++) {
        $rand .= $char{
            mt_rand(0, $l)};
    }
    return $rand;
}
