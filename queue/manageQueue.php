<?php include('../Session/Check_Session.php'); ?>
<?php
include("../require/connectDB.php");
$query = "SELECT * FROM queue ORDER BY queue_book_timestamp ASC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจัดการร้านอาหาร</title>
    <?php
    include("../require/req.php");
    ?>
    <script>
        var page = 2;
        $(document).ready(function() {
            $('#addQueue_form').on("submit", function(event) {
                event.preventDefault();
                $.ajax({
                    url: "./ajax/insertQueue.php",
                    method: "POST",
                    data: $('#addQueue_form').serialize(),
                    success: function(data) {
                        $("#addQueue").modal("hide");
                    }
                });
            })
            selectMode(page);
            $('#btnSelectTable').on("click", function(event) {
                $.ajax({
                    url: "./checkIn.php",
                    success: function(data) {
                        // $('#addQueue_form')[0].reset();
                        //location.reload();
                        $("#bodyCheckInModal").html(data);
                    }
                });
            });
        })
        $(document).on('click', '#tab>.nav-link', function() {
            page = $(this).attr("id");
            selectMode(page);
        })
        setInterval(() => {
            selectMode(page);
        }, 1000);

        function cancelQueue(id) {
            $.ajax({
                url: "./ajax/cancelQueue.php",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    //location.reload();
                }
            })
        }

        function inQueue(id) {
            $.ajax({
                url: "./ajax/inQueue.php",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    //location.reload();
                }
            })
        }

        function selectMode(mode) {
            $.ajax({
                url: "./ajax/selectQueue.php",
                method: "POST",
                data: {
                    mode: mode
                },
                success: function(data) {
                    $("#queueTable").html(data);
                }
            })
        }


        function deleteQueue(mode) {
            if (confirm("แน่ใจไหม รายการคิวทั้งหมดจะถูกลบ")) {
                $.ajax({
                    url: "./ajax/deleteQueue.php",
                    method: "POST",
                    data: {
                        mode: mode
                    },
                    success: function(data) {
                        location.reload();
                    }
                })
            }
        }

        /* function resetAddQueue_form() {
             document.getElementById("addQueue_form").reset();
         }*/

        $(document).on('hidden.bs.modal', '#addQueue', function() {
            document.getElementById("addQueue_form").reset();
        })
    </script>
</head>


<body>

    <?php
    include("../Sidebar/Sidebar.php");
    include("./modal/modal.php");
    ?>
    <div class="container">
        <h2 class="text-center m-1">จัดการคิว</h2>
        <nav class="nav nav-pills nav-justified m-1">
            <button type="button" class="btn btn btn-danger  nav-link m-1" onclick="deleteQueue(1);">ลบคิวทั้งหมด</button>
            <button type="button" class="btn btn btn-danger  nav-link m-1" onclick="deleteQueue(2);">ลบคิวที่เข้าร้านแล้วทั้งหมด</button>
            <button type="button" class="btn btn-primary  nav-link m-1" data-toggle="modal" data-target="#addQueue">
                เพิ่มคิว
            </button>
            <button id="btnSelectTable" type="button" class="btn btn-success  nav-link m-1" data-toggle="modal" data-target="#checkInModal">
                เลือกโต๊ะ
            </button>
        </nav>
        <nav class="nav nav-pills nav-justified m-1" id="tab">
            <a class="nav-link m-1" data-toggle="tab" onclick="selectMode(1);" id="1">ทั้งหมด</a>
            <a class="nav-link active m-1" data-toggle="tab" onclick="selectMode(2);" id="2">อยู่ในคิว</a>
            <a class="nav-link m-1" data-toggle="tab" onclick="selectMode(3);" id="3">เข้าร้านแล้ว</a>
            <!--<button type="button" class="btn btn-primary btn-lg" onclick="selectMode(1);">ทั้งหมด</button>
            <button type="button" class="btn btn-primary btn-lg" onclick="selectMode(2);">อยู่ในคิว</button>
            <button type="button" class="btn btn-primary btn-lg" onclick="selectMode(3);">เข้าร้านแล้ว</button>
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addQueue">
                เพิ่มคิว
            </button>-->
        </nav>

        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">ชื่อ</th>
                    <th class="text-center">จำนวนคน</th>
                    <th class="text-center">สถานะ</th>
                    <th class="text-center">เวลาที่จอง</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="queueTable">
                <?php
                include("./ajax/selectQueue.php");
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>