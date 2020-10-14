<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .bg-none {
            padding: 0;
            border: none;
            background: none;
        }
    </style>
</head>

<body>
    <!-- <div class="text-center">
        <button><img src="./src/img/notification-bell.png" alt=""></button>
    </div> -->
    <!-- Example single danger button -->
    <div class="container">
        <div class="text-right">
            <div class="btn-group dropleft">
                <button class="bg-none" id="notification" type="button" style="display: none;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="./src/img/notification-bell-color.png" alt="" width="25px" height="25px">
                </button>
                <div class="dropdown-menu">
                    <?php
                    require_once("./require/connectDB.php");
                    $notification = 0;
                    $sql = "SELECT * FROM order_list WHERE food_cook=0";
                    if ($result = mysqli_query($conn, $sql)) {
                        // Return the number of rows in result set
                        $rowcount = mysqli_num_rows($result);
                        if ($rowcount) {
                            $notification = 1;
                    ?>
                            <a class="dropdown-item" href="./Kitchen/KitchenScreen.php">มีออเดอร์ที่ยังไม่ได้ทำ</a>
                        <?php
                        }
                    }
                    $sql = "SELECT * FROM order_list WHERE food_cook=2";
                    if ($result = mysqli_query($conn, $sql)) {
                        // Return the number of rows in result set
                        $rowcount = mysqli_num_rows($result);
                        if ($rowcount) {
                            $notification = 1;
                        ?>
                            <a class="dropdown-item" href="#">มีออเดอร์ที่รอการส่ง</a>
                        <?php
                        }
                    }
                    if ($notification == 1) {
                        ?>
                        <script>
                            document.getElementById("notification").style.display = "inline-block";
                        </script>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>