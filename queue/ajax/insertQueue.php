<?php
include('../../require/connectDB.php');
$name = mysqli_real_escape_string($conn, $_POST["queueName"]);
$people = mysqli_real_escape_string($conn, $_POST["queuePeople"]);
$query = "
   INSERT INTO queue(queue_name,queue_people)  
    VALUES('$name','$people')
   ";
if (mysqli_query($conn, $query)) {
    echo "New record created successfully";
?>

<?php
} else {
?>

<?php
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
