<?php
require_once("../../require/connectDB.php");
$search = mysqli_real_escape_string($conn, $_POST['search']);
//print_r($search);
//$search = str_split($search);
$len = mb_strlen($search, 'UTF-8');
$result = [];
for ($i = 0; $i < $len; $i++) {
    if ($search[$i] == "\\") {
        $result[] = mb_substr($search, $i, 2, 'UTF-8');
        $i = $i + 1;
    } else {
        $result[] = mb_substr($search, $i, 1, 'UTF-8');
    }
}
$result;
?>

<?php
$query = "SELECT * FROM food WHERE ";
foreach ($result as &$searchSplit) {
    $query .= "food_name Like '%" . $searchSplit . "%' AND ";
}
$query = rtrim($query, "AND ");
//echo $query;
$query .= "ORDER BY food_name ASC";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
?>
    <tr>
        <td scope="row"><img src="../src/img/food/<?php echo $row["food_image"] ?>" height="auto" width="100%" class="img-thumbnail" /></td>
        <td><?php echo $row["food_name"] ?></td>
        <td><?php echo $row["food_price"] ?></td>
        <td><button class="btn btn-primary" val="<?php echo $row["food_id"] ?>" onclick="orderFood('<?php echo $row['food_id'] ?>','<?php echo $row['food_name'] ?>',<?php echo $row['food_price'] ?>);" data-toggle="modal" data-target="#modalOrder">สั่งอาหาร</button></td>
    </tr>
<?php
}

?>