<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="overlay preloader">
            <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
        <div class="modal-header bg-info">
            <h4 class="modal-title" id="title_modal" name="title_modal"></h4>
        </div>
        <div class="modal-body">
            <form class="mb-3" id="form_user" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>ชื่อผู้ใช้</label>
                            <input type="text" class="form-control" placeholder="กรอกชื่อสมาชิก" id="name" name="name"
                                required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>นามสกุลผู้ใช้</label>
                            <input type="text" class="form-control" placeholder="กรอกนามสกุลสมาชิก" id="last"
                                name="last" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>อีเมล์</label>
                    <input type="email" class="form-control" placeholder="กรอกอีเมล์" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>เบอร์โทรศัพท์</label>
                    <input type="number" class="form-control" placeholder="กรอกเบอร์โทรศัพท์" id="phone" name="phone"
                        required>
                </div>

                <div class="form-group" id="password_group">
                    <label>รหัสผ่าน</label>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">เปลี่ยนรหัสผ่าน</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="กรอกรหัสผ่าน">
                    </div>
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
    });

    $("#form_user").on('submit', function (e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_user');
    });
</script>
<script>
    $("#exampleCheck1").on('click', function () {
        if ($(this).is(':checked')) {
            $("#password").prop("disabled", false);
        }else{
            $("#password").prop("disabled", true);
        }
    })
</script>