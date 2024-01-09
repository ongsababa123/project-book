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
                <div class="row" id="customSwitch_status">
                    <div class="col-sm-12">
                        <div class="form-group" id="customSwitch">
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" class="custom-control-input" id="customSwitch3"
                                    name="customSwitch3" onclick="change_status()">
                                <label class="custom-control-label" for="customSwitch3" id="LabelcustomSwitch3"></label>
                            </div>
                        </div>
                    </div>
                </div>
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
<script src="<?= base_url('plugins/bs-custom-file-input/bs-custom-file-input.min.js'); ?>"></script>

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
            $('#submit').prop('disabled', true);
        } else {
            $("#password").prop("disabled", true);
            $('#submit').prop('disabled', false);
            $("#password").val("");
            removeAlert();

        }
    })
</script>
<script>
    function change_status() {
        const isChecked = document.getElementById("customSwitch3").checked;
        if (isChecked) {
            $(".modal-body #LabelcustomSwitch3").text("เปิดใช้งาน");
        } else {
            $(".modal-body #LabelcustomSwitch3").text("แบล็คลิส");
        }
    }
</script>
<script>
    document.getElementById('password').addEventListener('input', function () {
        // Remove any existing alert
        removeAlert();

        if (this.value.length < 5) {
            // Create and append a danger alert
            createAlert('danger', 'รหัสผ่านต้องมีความยาวอย่างน้อย 5 ตัวอักษร');
            $('#submit').prop('disabled', true);
        } else {
            // Check for special characters
            if (!/[^\w\s]/.test(this.value)) {
                // Create and append a success alert
                removeAlert();
                $('#submit').prop('disabled', false);

            } else {
                createAlert('danger', 'รหัสผ่านห้ามใช้เครื่องหมายพิเศษ');
                $('#submit').prop('disabled', true);
            }
        }
    });

    function createAlert(type, message) {
        var alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-' + type + ' alert-dismissible';
        alertDiv.innerHTML = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
            '<h5><i class="icon fas fa-ban"></i> Alert!</h5>' +
            message;

        document.body.appendChild(alertDiv);
        $('#password_group').append(alertDiv);
    }

    function removeAlert() {
        var existingAlert = document.querySelector('.alert');
        if (existingAlert) {
            existingAlert.parentNode.removeChild(existingAlert);
        }
    }
</script>