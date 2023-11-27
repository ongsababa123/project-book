<title>Profile</title>
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
                        <input type="number" class="form-control" placeholder="กรอกเบอร์โทรศัพท์" id="phone"
                            name="phone" value="<?= $user_data[0]['phone'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>อีเมล์</label>
                        <input type="text" placeholder="กรอกอีเมล์ของคุณ" class="form-control" id="email" name="email"
                            value="<?= $user_data[0]['email_user'] ?>" required />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" placeholder="กรอกรหัสผ่านของคุณ (กรณีเปลี่ยนรหัสผ่าน)"
                            class="form-control" id="password" name="password" />
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
    });

    $("#form_user").on('submit', function (e) {
        e.preventDefault();
        var url = 
        action_("dashboard/customer/edit/" + <?php echo session()->get('id'); ?>, 'form_user');
    });
</script>
<script>
    function action_(url, form) {
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
                console.log(response);
                if (response.success) {
                    Swal.fire({
                        title: response.message,
                        icon: 'success',
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                    setTimeout(() => {
                        if (response.reload) {
                            window.location.reload();
                        }
                    }, 2000);
                } else {
                    if (response.validator) {
                        var mes = "";
                        if (response.validator.email) {
                            mes += 'ช่องอีเมลจะต้องมีที่อยู่อีเมลที่ถูกต้องหรือมีอีเมล์ซ้ำในระบบ.' + '<br><hr/>'
                        }
                        if (response.validator.name) {
                            mes += 'ชื่อต้องมีอย่างน้อย 2 ตัว.' + '<br><hr/>';
                        }
                        if (response.validator.last) {
                            mes += 'นามสกุลต้องมีอย่างน้อย 2 ตัว.' + '<br><hr/>';
                        }
                        if (response.validator.phone) {
                            mes += 'เบอร์ติดต่อต้องมี 10 หลัก.' + '<br>';
                        }
                        Swal.fire({
                            title: mes,
                            icon: 'error',
                            showConfirmButton: true,
                            width: '55%'
                        });
                    } else {
                        Swal.fire({
                            title: response.message,
                            icon: 'error',
                            showConfirmButton: true
                        });
                    }
                }
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    title: "เกิดข้อผิดพลาด",
                    icon: 'error',
                    showConfirmButton: true
                });
            }
        });
    }
</script>