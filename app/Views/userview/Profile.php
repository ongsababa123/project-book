<title>Profile</title>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

<style>
    .main {
        display: flex;
        flex-direction: column;
        height: 51vh;
        /* ความสูงเต็มหน้าจอ */
        margin: 0;
    }

    .section {
        flex: 1;
        /* ให้เต็มพื้นที่ที่เหลือ */
    }
</style>
<style>
    .no-arrow {
        -moz-appearance: textfield;
    }

    .no-arrow::-webkit-inner-spin-button {
        display: none;
    }

    .no-arrow::-webkit-outer-spin-button,
    .no-arrow::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
<div class="page-header page-header-xs" data-parallax="true"
    style="background-image: url('<?= base_url('dist/img/background.png') ?>');">
    <div class="filter"></div>
</div>
<div class="main">
    <div class="section profile-content" style="padding-bottom: 5rem;">
        <div class="container">
            <div class="owner">
                <div class="avatar">
                    <img src="<?= base_url('dist/img/avatar7.png') ?>" alt="Circle Image"
                        class="img-circle img-no-padding img-responsive">
                </div>
                <div class="name">
                    <h4 class="title">
                        <?= $user_data[0]['name'] ?>
                        <?= $user_data[0]['lastname'] ?>
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto text-center">
                    <p>อีเมล์ :
                        <?= $user_data[0]['email_user'] ?>
                    </p>
                    <p>เบอร์โทรศัพท์ :
                        <?= $user_data[0]['phone'] ?>
                    </p>
                    <p>จำนวนครั้งที่ยืม :
                        <?= $count_data ?>
                    </p>
                    <br />
                    <btn class="btn btn-outline-default btn-round" data-toggle="modal" data-target="#loginModal"><i
                            class="fa fa-cog"></i> แก้ไขข้อมูล</btn>
                </div>
            </div>
            <br />
        </div>
    </div>
</div>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-register">
        <div class="modal-content">
            <div class="modal-header no-border-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title text-center">แก้ไขข้อมูล</h3>
            </div>
            <div class="modal-body">
                <form class="mb-3" id="form_user" action="javascript:void(0)" method="post"
                    enctype="multipart/form-data">
                    <div class="row mb-2">
                        <div class="col">
                            <label>ชื่อ</label>
                            <input type="text" class="form-control" placeholder="กรอกชื่อของคุณ" id="name" name="name"
                                value="<?= $user_data[0]['name'] ?>" required>
                        </div>
                        <div class="col">
                            <label>นามสกุล</label>
                            <input type="text" class="form-control" placeholder="กรอกนามสกุลของคุณ" id="last"
                                name="last" value="<?= $user_data[0]['lastname'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>เบอร์โทรศัพท์</label>
                        <input id="phone" name="phone" class="no-arrow form-control"
                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                            type="number" maxlength="10" placeholder="กรอกเบอร์โทรศัพท์"
                            value="<?= $user_data[0]['phone'] ?>" required/>
                    </div>
                    <div class="form-group">
                        <label>อีเมล์</label>
                        <input type="text" placeholder="กรอกอีเมล์ของคุณ" class="form-control" id="email" name="email"
                            value="<?= $user_data[0]['email_user'] ?>" required />
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="" id="check" name="check">
                                แก้ไขรหัสผ่าน
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                        <input type="password" placeholder="กรอกรหัสผ่านของคุณ (กรณีเปลี่ยนรหัสผ่าน)"
                            class="form-control" id="password" name="password" oninput="checkPassword()" />
                    </div>
                    <div class="form-check" id="showpass">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="" id="showpassword"
                                name="showpassword">แสดงรหัสผ่าน
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <div class="alert alert-danger" role="alert" id="lengthAlert" style="display: none;">
                        รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร
                    </div>
                    <div class="alert alert-danger" role="alert" id="charAlert" style="display: none;">
                        รหัสผ่านจะต้องมีตัวอักษร และตัวเลข
                    </div>
                    <div class="alert alert-danger" role="alert" id="symbolAlert" style="display: none;">
                        รหัสผ่านห้ามใช้เครื่องหมายพิเศษ
                    </div>
                    <button type="submit" class="btn btn-block btn-round" name="submit" value="Submit"
                        id="submit">บันทึกข้อมูล</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".overlay").hide();
        $("#showpass").hide();
    });

    $("#form_user").on('submit', function (e) {
        e.preventDefault();
        var url =
            action_("dashboard/edit/user/profile/" + <?php echo session()->get('id'); ?>, 'form_user');
    });
</script>
<script>
    $('#password').prop('disabled', true);
    $('#check').on('change', function () {
        updateSubmitButton();

    });
</script>
<script>
    $('#check').on('change', function () {
        updateSubmitButton();
    });

    function checkPassword() {
        var passwordInput = document.getElementById("password");
        var lengthAlert = document.getElementById("lengthAlert");
        var symbolAlert = document.getElementById("symbolAlert");

        // Check ความยาว
        if (passwordInput.value.length >= 8) {
            lengthAlert.style.display = "none";
        } else {
            lengthAlert.style.display = "block";
        }

        // Check เครื่องหมายพิเศษ
        if (!/[^\w\s]/.test(passwordInput.value)) {
            symbolAlert.style.display = "none";
        } else {
            symbolAlert.style.display = "block";
        }

        if (/^(?=.*\d)(?=.*[a-zA-Z])/.test(passwordInput.value)) {
            charAlert.style.display = "none";
        } else {
            charAlert.style.display = "block";
        }

        updateSubmitButton();
    }

    function updateSubmitButton() {
        var checkCheckbox = $('#check').is(':checked');
        var passwordInput = document.getElementById("password");
        if (checkCheckbox) {
            $("#showpass").show();
            $('#password').prop('disabled', false);
            $('#submit').prop('disabled', true);
            if (passwordInput.value.length >= 8 && !/[^\w\s]/.test(passwordInput.value) && /^(?=.*\d)(?=.*[a-zA-Z])/.test(passwordInput.value)) {
                $('#submit').prop('disabled', false);
            } else {
                $('#submit').prop('disabled', true);
            }
        } else {
            $("#showpass").hide();
            $('#password').prop('disabled', true);
            $('#password').val('');
            $('.alert').hide();
            $('#submit').prop('disabled', false);
        }
    }
</script>
<script>
    function action_(url, form) {
        // แสดงกำลังโหลด
        Swal.fire({
            title: 'กำลังโหลด...',
            allowOutsideClick: false,
            onBeforeOpen: () => {
                Swal.showLoading();
            }
        });

        var formData = new FormData(document.getElementById(form));
        $.ajax({
            url: '<?= base_url() ?>' + url,
            type: "POST",
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function (response) {
                // ซ่อนกำลังโหลดเมื่อเสร็จสิ้น
                Swal.close();
                if (response.success) {
                    Swal.fire({
                        title: response.message,
                        icon: 'success',
                        confirmButtonText: "ตกลง",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });

                } else {
                    if (response.validator) {
                        var mes = "";
                        if (response.validator.email === "The email field must contain a valid email address.") {
                            mes += 'ช่องอีเมลจะต้องมีที่อยู่อีเมลที่ถูกต้อง.' + '<br><hr/>'
                        }
                        if (response.validator.email === "The email field must contain a unique value.") {
                            mes += 'อีเมล์นี้ถูกสมัครสมาชิกแล้ว' + '<br><hr/>'
                        }
                        if (response.validator.name) {
                            mes += 'ชื่อต้องมีอย่างน้อย 2 ตัว.' + '<br><hr/>';
                        }
                        if (response.validator.last) {
                            mes += 'นามสกุลต้องมีอย่างน้อย 2 ตัว.' + '<br><hr/>';
                        }
                        if (response.validator.phone === "The phone field must contain only numbers.") {
                            mes += 'เบอร์ติดต่อต้องมีเฉพาะตัวเลขเท่านั้น.' + '<br>';
                        }
                        if (response.validator.phone === "The phone field must be at least 10 characters in length.") {
                            mes += 'เบอร์ติดต่อต้องมี 10 หลัก.' + '<br>';
                        }
                        if (response.validator.phone === "The phone field cannot exceed 10 characters in length.") {
                            mes += 'เบอร์ติดต่อต้องมีไม่เกิน 10 หลัก.' + '<br>';
                        }
                        Swal.fire({
                            title: mes,
                            icon: 'error',
                            confirmButtonText: "ตกลง",
                            showConfirmButton: true,
                            width: '55%'
                        });
                    } else {
                        Swal.fire({
                            title: response.message,
                            icon: 'error',
                            confirmButtonText: "ตกลง",
                            showConfirmButton: true
                        });
                    }
                }
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    title: "เกิดข้อผิดพลาด",
                    icon: 'error',
                    confirmButtonText: "ตกลง",
                    showConfirmButton: true
                });
            }
        });
    }

</script>
<script>
    const passwordInput = document.getElementById('password');
    const showPasswordCheckbox = document.getElementById('showpassword');

    showPasswordCheckbox.addEventListener('change', function () {
        if (this.checked) {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
</script>