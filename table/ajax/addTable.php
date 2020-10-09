<?php
include('../../require/connectDB.php');
$sql = "SELECT * FROM `table`";
if (!$result = mysqli_query($conn, $sql)) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
$max = mysqli_num_rows($result);
echo gettype($max);
$number = mysqli_real_escape_string($conn, $_POST["numberTableAdded"]);
$people = mysqli_real_escape_string($conn, $_POST["tablePeople"]);
$query = "
   INSERT INTO `table`(table_id,table_people)  
    VALUES
   ";
for ($i = 1; $i <= $number; $i++) {
    $query .= " (" . strval($max + $i) . ",$people),";
}
$query = rtrim($query, ",");
echo $max;
if (mysqli_query($conn, $query)) {
    echo "New record created successfully";
?>

<?php
} else {
?>

<?php
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
