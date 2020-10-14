<?php include('../Session/Check_Session.php'); ?>
<?php
include("../require/connectDB.php");

//echo mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <?php include("../Sidebar/Sidebar2.php") ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจัดการร้านอาหาร</title>
    <link rel="stylesheet" type="text/css" href="../CSS/plusMinus.css">
    <script src="../js/plusMinus.js"></script>
    <?php
    include("../require/req.php");
    ?>
    <script>
        $(document).ready(function() {
            $('#addTable_form').on("submit", function(event) {
                event.preventDefault();
                $.ajax({
                    url: "./ajax/addTable.php",
                    method: "POST",
                    data: $('#addTable_form').serialize(),
                    success: function(data) {
                        $(".modal").modal("hide");
                        document.getElementById('addTable_form').reset();
                        callAjaxTbody();
                    }
                });
            })

            $('#editTable_form').on("submit", function(event) {
                event.preventDefault();
                $.ajax({
                    url: "./ajax/editTable.php",
                    method: "POST",
                    data: $('#editTable_form').serialize(),
                    success: function(data) {
                        callAjaxTbody();
                        $(".modal").modal("hide");
                        document.getElementById("editTable_form").reset();
                    }
                });
            })
            $('#deleteTable_form').on("submit", function(event) {
                event.preventDefault();
                $.ajax({
                    url: "./ajax/deleteTable.php",
                    method: "POST",
                    data: $('#deleteTable_form').serialize(),
                    success: function(data) {
                        callAjaxTbody();
                        $(".modal").modal("hide");
                        document.getElementById("deleteTable_form").reset();
                    }
                });
            })
            $('#editTable').on('shown.bs.modal', function(e) {
                document.getElementById("editTable_form").reset();
            })

        });


        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        function editTable(id) {
            document.getElementById("editTableTitle2").innerText = id;
            document.getElementById("tableID").value = id;
        }

        function callAjaxTbody() {
            $.ajax({
                url: './ajax/tbody.php',
                method: 'POST',
                success: function(data) {
                    $("#tbody").html(data);
                }
            });
        }
    </script>
</head>

<body>
    <div class="container">
        <h2 class="text-center m-1">จัดการโต๊ะ</h2>
        <div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addTable">
                เพิ่มโต๊ะ
            </button>
            <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#deleteTable">
                ลบโต๊ะ
            </button>
        </div>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>เบอร์โต๊ะ</th>
                        <th>จำนวนคนต่อโต๊ะ</th>
                        <th>สถานะ</th>
                        <th>รหัสเข้าใช้งานของลูกค้า</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php include_once("./ajax/tbody.php"); ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addTable" tabindex="-1" role="dialog" aria-labelledby="addTableTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" id="addTable_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">เพิ่มโต๊ะ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="numberTableAdded" class="col-sm-12 col-form-label">จำนวนโต๊ะที่ต้องการเพิ่ม</label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-2 pt-1">
                                        <span class="minus" onclick="minus('numberTableAdded')">-</span>
                                    </div>
                                    <div class="col-8 text-right">
                                        <input type="number" style="font-size:85%;" class="form-control text-right" name="numberTableAdded" id="numberTableAdded" placeholder="จำนวนโต๊ะที่ต้องการเพิ่ม" min="1" max="99" required="" step="1">
                                    </div>
                                    <div class="col-2 text-right pt-1">
                                        <span class="plus" onclick="plus('numberTableAdded')">+</span>
                                    </div>
                                </div>
                            </div>
                            <label for="tablePeople" class="col-sm-12 col-form-label">จำนวนคนต่อโต๊ะ (ส่วนใหญ่)</label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-2 pt-1">
                                        <span class="minus" onclick="minus('tablePeople')">-</span>
                                    </div>
                                    <div class="col-8 text-right">
                                        <input type="number" onkeypress="return isNumberKey(event)" style="font-size:85%;" class="form-control text-right" name="tablePeople" id="tablePeople" min="1" max="99" required="" placeholder="จำนวนคนต่อโต๊ะ (ส่วนใหญ่)" step="1">
                                    </div>
                                    <div class="col-2 text-right pt-1">
                                        <span class="plus" onclick="plus('tablePeople')">+</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-success">เพิ่ม</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="editTable" tabindex="-1" role="dialog" aria-labelledby="editTableTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" id="editTable_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTableTitle">แก้ไขคนต่อโต๊ะ โต๊ะเบอร์ </h5>
                        <h5 class="modal-title" id="editTableTitle2"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <input type="hidden" id="tableID" name="tableID" />
                            <label for="editTablePeople" class="col-sm-12 col-form-label">แก้ไขจำนวนคนต่อโต๊ะ</label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-2 pt-1">
                                        <span class="minus" onclick="minus('editTablePeople')">-</span>
                                    </div>
                                    <div class="col-8 text-right">
                                        <input type="number" onkeypress="return isNumberKey(event)" style="font-size:85%;" class="form-control text-right" name="editTablePeople" id="editTablePeople" min="1" max="99" placeholder="จำนวนคนต่อโต๊ะ" required="" step="1">
                                    </div>
                                    <div class="col-2 text-right pt-1">
                                        <span class="plus" onclick="plus('editTablePeople')">+</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-success">แก้ไข</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="deleteTable" tabindex="-1" role="dialog" aria-labelledby="deleteTableTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" id="deleteTable_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">ลบโต๊ะ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="numberTableDeleted" class="col-sm-12 col-form-label">จำนวนโต๊ะที่ต้องการลบ (จะลบจากโต๊ะสุดท้าย)</label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-2 pt-1">
                                        <span class="minus" onclick="minus('numberTableDeleted')">-</span>
                                    </div>
                                    <div class="col-8 text-right">
                                        <input type="number" style="font-size:85%;" class="form-control text-right" name="numberTableDeleted" id="numberTableDeleted" placeholder="จำนวนโต๊ะที่ต้องการลบ (จะลบจากโต๊ะสุดท้าย)" min="1" max="99" required="" step="1">
                                    </div>
                                    <div class="col-2 text-right pt-1">
                                        <span class="plus" onclick="plus('numberTableDeleted')">+</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-danger">ลบ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>