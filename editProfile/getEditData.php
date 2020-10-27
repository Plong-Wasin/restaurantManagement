<?php
include("../Session/Check_Session.php");
$username = "";
$db = mysqli_connect("localhost", "root", "", "restaurant_db");
if (isset($_POST['username'])) {

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $id = mysqli_real_escape_string($db, $_POST['iduser']);
    $Email = mysqli_real_escape_string($db, $_POST['email']);
    $birthDate = mysqli_real_escape_string($db, $_POST['birthday']);
    $Password_1 = mysqli_real_escape_string($db, $_POST['newPassword_1']);
    $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $contact_number = mysqli_real_escape_string($db, $_POST['contact_number']);

    $set = $birthDate;
    //echo $Email;
    $user_check_query_username = "SELECT * FROM users WHERE username ='$username'";
    $result_username = mysqli_query($db, $user_check_query_username);
    if (mysqli_num_rows($result_username) > 0) {
        while ($row_username = mysqli_fetch_array($result_username)) {
            if ($row_username['id'] !== $id) {
                echo 'error_username';
                exit();
            }
        }
    }
    $user_check_query_email = "SELECT * FROM users WHERE Email ='$Email'";
    $result_email = mysqli_query($db, $user_check_query_email);
    if (mysqli_num_rows($result_email) > 0) {
        while ($row_email = mysqli_fetch_array($result_email)) {
            if ($row_email['id'] !== $id) {
                echo 'error_email';
                exit();
            }
        }
    }
    $birthDate = explode("/", $birthDate);
    //get age from date or birthdate
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
        ? ((date("Y") - $birthDate[2]) - 1)
        : (date("Y") - $birthDate[2]));
    if ($age < 15) {

        echo 'error_date';
        exit();
    }

    // $sqlbirthDate = "UPDATE users SET birthdate = STR_TO_DATE('$set','%Y/%m/%d') WHERE id='$id'";
    $sql_date = "UPDATE users SET birthdate = '$birthDate[2]/$birthDate[1]/$birthDate[0]' WHERE id='$id'";
    if (mysqli_query($db, $sql_date)) {
        echo "date updated successfully";
        '<br>';
    } else {
        echo "Error date updating record: " . mysqli_error($db);
    }

    $sqlEmail = "UPDATE users SET Email = '$Email' WHERE id='$id'";
    if (mysqli_query($db, $sqlEmail)) {
        echo " Email updated successfully";
        '<br>';
    } else {
        echo "Error Email updating record: ";
        '<br>' . mysqli_error($db);
    }

    $sqlusername = "UPDATE users SET username = '$username' WHERE id='$id'";
    if (mysqli_query($db, $sqlusername)) {
        echo " username updated successfully";
        '<br>';
    } else {
        echo "Errorusername updating record: ";
        '<br>' . mysqli_error($db);
    }

    $sqlfirst_name = "UPDATE users SET first_name = '$first_name' WHERE id='$id'";
    if (mysqli_query($db, $sqlfirst_name)) {
        echo " first_name updated successfully";
        '<br>';
    } else {
        echo "Error first_name updating record: ";
        '<br>' . mysqli_error($db);
    }

    $sqllast_name = "UPDATE users SET last_name = '$last_name' WHERE id='$id'";
    if (mysqli_query($db, $sqllast_name)) {
        echo "last_name updated successfully";
        '<br>';
    } else {
        echo "Error last_name updating record: ";
        '<br>' . mysqli_error($db);
    }
    $sqlcontact_number = "UPDATE users SET contact_number='$contact_number'WHERE id='$id'";
    if (mysqli_query($db, $sqlcontact_number)) {
        echo "contact_number updated successfully";
        '<br>';
    } else {
        echo "Error contact_number updating record: ";
        '<br>' . mysqli_error($db);
    }

    $sqltitle = "UPDATE users SET title = '$title' WHERE id='$id'";
    if (mysqli_query($db, $sqltitle)) {
        echo "title updated successfully";
        '<br>';
    } else {
        echo "Error titler updating record: ";
        '<br>' . mysqli_error($db);
    }

    if ($Password_1 != null) {
        $sql_password = "UPDATE users SET `password` = '$Password_1'  WHERE id='$id'";
        if (mysqli_query($db, $sql_password)) {
            echo "password updated successfully";
        } else {
            echo "Error All updating record: " . mysqli_error($db);
        }
    }
    $_SESSION['username'] = $username;
}
echo '<script>alert("แก้ไขเรียบร้อยแล้ว")</script>';
// header("location:./AdminScreenMain.php");    
?> <script>
    window.onload = function() {
        setTimeout(() => {
            window.top.location.reload();
        }, 100);
    }
</script>