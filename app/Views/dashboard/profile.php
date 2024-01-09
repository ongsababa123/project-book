<title>โปรไฟล์</title>
<link rel="stylesheet" href="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.css'); ?>">


<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>โปรไฟล์</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/dashboard/index'); ?>">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">โปรไฟล์</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card" id="history_user">
                            <div class="card-header">
                                <h2 class="card-title"></h2>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-3">
                                        <!-- Profile Image -->
                                        <div class="card card-primary card-outline">
                                            <div class="card-body box-profile">
                                                <div class="text-center">
                                                    <img class="profile-user-img img-fluid img-circle"
                                                        src="<?= base_url('dist/img/avatar6.png'); ?>"
                                                        alt="User profile picture">
                                                </div>
                                                <h3 class="profile-username text-center">
                                                    <?= $data_user[0]['name'] . ' ' . $data_user[0]['lastname'] ?>
                                                </h3>

                                                <p class="text-muted text-center">
                                                    <?php
                                                    if ($data_user[0]['type_user'] == 1) {
                                                        echo 'ผู้จัดการระบบ admin';
                                                    } else if ($data_user[0]['type_user'] == 2) {
                                                        echo 'เจ้าของร้าน';
                                                    } else if ($data_user[0]['type_user'] == 3) {
                                                        echo 'พนักงาน';
                                                    } else {
                                                        echo 'ลูกค้า';
                                                    }
                                                    ?>
                                                </p>

                                                <ul class="list-group list-group-unbordered mb-3">
                                                    <li class="list-group-item">
                                                        <b>Email</b> <a class="float-right">
                                                            <?= $data_user[0]['email_user'] ?>
                                                        </a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Phone</b> <a class="float-right">
                                                            <?= $data_user[0]['phone'] ?>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <a href="#" class="btn btn-primary btn-block" data-toggle="modal"
                                                    data-target="#modal-default"
                                                    onclick="load_modal(1)"><b>แก้ไขข้อมูล</b></a>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="modal-default">
        <div id="CRUD_UserModal">
            <?= $this->include("modal/CRUD_UserModal"); ?>
        </div>
    </div>
    <script>
        function load_modal(load_check) {
            CRUD_UserModal = document.getElementById("CRUD_UserModal");
            $(".modal-body #name").val('');
            $(".modal-body #last").val('');
            $(".modal-body #email").val('');
            $(".modal-body #phone").val('');
            if (load_check == 1) {
                CRUD_UserModal.style.display = "block";
                $(".modal-body #name").val('<?= $data_user[0]['name'] ?>');
                $(".modal-body #last").val('<?= $data_user[0]['lastname'] ?>');
                $(".modal-body #email").val('<?= $data_user[0]['email_user'] ?>');
                $(".modal-body #phone").val('<?= $data_user[0]['phone'] ?>');
                $('#customSwitch_status').hide();
                $("#password").prop("disabled", true);

                $(".modal-header #title_modal").text("แก้ไขข้อมูลผู้ใช้");
                $(".modal-footer #submit").text("แก้ไขข้อมูลผู้ใช้");
                $(".modal-body #url_route").val("dashboard/edit/user/profile/" + <?= $data_user[0]['id_user'] ?>);
            }
        }
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

    <script src="<?= base_url('plugins/filterizr/jquery.filterizr.min.js') ?>"></script>
    <script src="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.min.js') ?>"></script>