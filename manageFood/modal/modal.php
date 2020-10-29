<div class="modal fade" id="insertFoodType" tabindex="-1" role="dialog" aria-labelledby="insertFoodTypeTitle" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <form method="post" id="insertFoodType_form">
            <div class="modal-content">
                <div class="modal-header">
                    <!--Modal Header -->
                    <h5 class="modal-title" id="insertFoodTypeTitle">เพิ่มประเภทอาหาร</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--Modal Body -->
                    <div class="form-group row">
                        <label for="foodTypeName" class="col-sm-3 col-form-label">ชื่อประเภทอาหาร</label>
                        <div class="col-sm-9">
                            <input type="text" style="font-size:85%;" class="form-control" name="foodTypeName" id="foodTypeName" placeholder="ชื่อประเภทอาหาร" required="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!--Modal Footer -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-success" id="insert">ตกลง</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="insertFood" tabindex="-1" role="dialog" aria-labelledby="insertFoodTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" id="insertFood_form" onsubmit="return false">
            <div class="modal-content">
                <div class="modal-header">
                    <!--Modal Header -->
                    <h5 class="modal-title" id="insertFoodTitle">เพิ่มข้อมูลอาหาร</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--Modal Body -->
                    <div class="form-group row">
                        <input type="hidden" id="foodID" name="foodID" />
                        <label for="foodName" class="col-sm-12 col-form-label">ชื่ออาหาร</label>
                        <div class="col-sm-12">
                            <input type="text" style="font-size:85%;" class="form-control" name="foodName" id="foodName" placeholder="ชื่ออาหาร" required="">
                        </div>
                        <label for="foodPrice" class="col-sm-12 col-form-label">ราคา</label>
                        <div class="col-sm-12">
                            <input type="number" style="font-size:85%;" class="form-control" name="foodPrice" id="foodPrice" min="1" placeholder="ราคาของอาหาร" required="">
                        </div>
                        <label for="foodType" class="col-sm-12 col-form-label">ประเภท</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="foodType" id="foodType" style="font-size:85%;">
                                <?php
                                $tab_result = mysqli_query($conn, $tab_query);
                                while ($row = mysqli_fetch_array($tab_result)) {
                                ?>
                                    <option value="<?php echo $row["food_type_id"] ?>">
                                        <?php echo $row["food_type_name"] ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group pt-1">
                            <label for="file" class="col-sm-12">รูปภาพอาหาร</label>
                            <input type="file" class="col-sm-12" name="file" id="file" accept=".jpeg,.png,.jpg,.gif" />
                            <span id="uploaded_image"></span>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!--Modal Footer -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-success">ตกลง</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Modal -->
<!-- Modal -->
<div class="modal fade" id="deleteFoodType" tabindex="-1" role="dialog" aria-labelledby="deleteFoodTypeTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" id="deleteFoodType_form">
            <div class="modal-content">
                <div class="modal-header">
                    <!--Modal Header -->
                    <h5 class="modal-title" id="deleteFoodTypeTitle">ลบประเภทอาหาร</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--Modal Body -->
                    <div class="form-group row">

                        <label for="foodType" class="col-sm-2 col-form-label">ประเภท</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="foodType" id="dFoodType" style="font-size:85%;">
                                <?php
                                $tab_result = mysqli_query($conn, $tab_query);
                                while ($row = mysqli_fetch_array($tab_result)) {
                                ?>
                                    <option value="<?php echo $row["food_type_id"] ?>">
                                        <?php echo $row["food_type_name"] ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!--Modal Footer -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-success">ตกลง</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Modal -->

<!-- Modal -->
<div class="modal fade" id="editFoodType" tabindex="-1" role="dialog" aria-labelledby="editFoodTypeTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" id="editFoodType_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFoodTypeTitle">แก้ไขประเภทอาหาร</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">

                        <label for="foodType" class="col-sm-3 col-form-label">ชื่อประเภทอาหารเดิม</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="foodType" id="eFoodType" style="font-size:85%;">
                                <?php
                                $tab_result = mysqli_query($conn, $tab_query);
                                while ($row = mysqli_fetch_array($tab_result)) {
                                ?>
                                    <option value="<?php echo $row["food_type_id"] ?>">
                                        <?php echo $row["food_type_name"] ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <label for="newFoodTypeName" class="col-sm-3 col-form-label">ชื่อประเภทอาหารใหม่</label>
                        <div class="col-sm-9">
                            <input type="text" style="font-size:85%;" class="form-control" name="newFoodTypeName" id="newFoodTypeName" placeholder="ชื่อประเภทอาหารใหม่" required="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-success">ตกลง</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#insertFood').on('show.bs.modal', function(event) {
            $("#insertFood_form").reset;
            $('#uploaded_image').html("");
        });
    });
</script>