<!-- Button trigger modal -->
<?php

?>
<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>

<!-- Modal -->
<div class="modal fade" id="addQueue" tabindex="-1" role="dialog" aria-labelledby="addQueueTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" id="addQueue_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addQueueTitle">เพิ่มคิว</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="queueName" class="col-sm-12 col-form-label">ชื่อผู้จอง</label>
                        <div class="col-sm-12">
                            <input type="text" style="font-size:85%;" class="form-control" name="queueName" id="queueName" placeholder="ชื่อผู้จอง" required="">
                        </div>
                        <label for="queuePeople" class="col-sm-12 col-form-label">จำนวนคน</label>
                        <div class="col-sm-12">
                            <input type="number" onkeypress="return isNumberKey(event)" style="font-size:85%;" class="form-control" name="queuePeople" id="queuePeople" min="1" max="99" placeholder="จำนวนคน" required="" step="1">
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


<!-- Modal -->
<div class="modal fade" id="checkInModal" tabindex="-1" role="dialog" aria-labelledby="checkInTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เลือกโต๊ะให้ลูกค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="bodyCheckInModal">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save</button> -->
            </div>
        </div>
    </div>
</div>