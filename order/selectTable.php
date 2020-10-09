<?php
require_once("../require/connectDB.php");
$sql = "SELECT * FROM `table`";
if (!$result = mysqli_query($conn, $sql)) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    include_once("../require/req.php")
    ?>
</head>

<body>
    <div class="container">
        <h2 class="text-center">เลือกโต๊ะของลูกค้า</h2>
        <div class="form-group">
            <form method="POST" action="./orderFood.php">
                <label for="table">เลือกโต๊ะที่ลูกค้าจะสั่ง</label>
                <select class="form-control" id="table" name="table_id">
                    <?php while ($row = mysqli_fetch_array($result)) {
                        if ($row['table_status']) {
                    ?>
                            <option value="<?php echo $row["table_id"] ?>">โต๊ะ <?php echo $row["table_id"] ?> นั่งได้ <?php echo $row["table_people"] ?> คน </option>
                    <?php }
                    } ?>
                </select>
                <div class="text-right p-4">
                    <button type="submit" class="btn btn-primary">ต่อไป</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>