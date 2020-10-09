<?php
//insert.php  
include("../../require/connectDB.php");
if (!empty($_POST)) {
    $output = '';
}
$id = $_POST["tableID"];
$people = mysqli_real_escape_string($conn, $_POST["editTablePeople"]);
echo $id . '<br>';

$query = "
    UPDATE `table`
    SET table_people = '$people'
    WHERE table_id = '$id';
    ";

if (mysqli_query($conn, $query)) {
    echo "New record created successfully";
    echo $query;
?>

<?php
} else {
?>

<?php
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
