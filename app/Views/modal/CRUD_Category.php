<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="overlay preloader">
            <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
        <div class="modal-header bg-info">
            <h4 class="modal-title" id="title_modal" name="title_modal"></h4>
        </div>
        <div class="modal-body">
            <form class="mb-3" id="form_category" action="javascript:void(0)" method="post"
                enctype="multipart/form-data">
                <div class="form-group" id="customSwitch">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="customSwitch3" name="customSwitch3" onclick="change_status()">
                        <label class="custom-control-label" for="customSwitch3" id="LabelcustomSwitch3"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label>ชื่อหมวดหมู่</label>
                    <input type="text" class="form-control" placeholder="กรอกชื่อหมวดหมู่" id="name_category"
                        name="name_category" required>
                </div>
                <div class="form-group">
                    <label>รายละเอียด</label>
                    <textarea class="form-control" rows="3" placeholder="กรอกรายละเอียด" id="detail_category"
                        name="detail_category" required></textarea>
                </div>
                <input type="text" id="url_route" name="url_route" hidden>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="submit" value="Submit" id="submit"></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".overlay").hide();
        change_status();
    });

    $("#form_category").on('submit', function (e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_category');
    });
</script>
<script>
    function change_status() {
        const isChecked = document.getElementById("customSwitch3").checked;
            if (isChecked) {
                $(".modal-body #LabelcustomSwitch3").text("เปิดใช้งาน");
            } else {
                $(".modal-body #LabelcustomSwitch3").text("ปิดใช้งาน");
            }
    }

</script>