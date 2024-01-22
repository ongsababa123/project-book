<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="<?= base_url('assets/fontgoogle.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('dist/sweetalert/sweetalert2.min.css'); ?>">

    <!-- CSS Files -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/paper-kit.css') ?>" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?= base_url('assets/demo/demo.css') ?>" rel="stylesheet" />
    <link rel="icon" href="<?= base_url('dist/img/icon/favicon.ico') ?>" type="image/gif">

    <title>ลืมรหัสผ่าน</title>

</head>
<style>
    * {
        font-family: 'Kanit', sans-serif;
    }

    .card-register {
        background-color: #86d9ab;
    }
</style>

<body class="register-page sidebar-collapse">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top bg-success">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="<?= site_url('/') ?>" rel="tooltip" title="Coded by Creative Tim" style="font-size: medium"
                    data-placement="bottom">
                    ร้านบางเล่ม
                </a>
                <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navigation" aria-controls="navigation-index" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown" id="dropdown">
                        <a href="#" id="navbarDropdownMenu" data-toggle="dropdown" aria-haspopup="true" style="font-size: medium"
                            aria-expanded="false" class="nav-link" >รายละเอียด</i></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenu">
                            <?php foreach ($details as $key => $value): ?>
                                <a class="dropdown-item" style="font-size: medium">
                                    <?= $key + 1 ?> :
                                    <?= $value['text_details'] ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('/book/booklist') ?>" class="nav-link" style="font-size: medium"> รายการหนังสือ</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('/contact') ?>" class="nav-link" style="font-size: medium"> ติดต่อเรา</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="page-header" style="background-image: url('<?= base_url('dist/img/background2.jpg') ?>');">
        <div class="filter"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 ml-auto mr-auto ">
                    <div class="card card-register">
                        <h1 class="title mx-auto">ลืมรหัสผ่าน</h1>
                        <div class="social-line text-center">
                            <img src="<?= base_url('dist/img/logo11.png') ?>">
                        </div>
                        <form id="forgot_password" action="javascript:void(0)" method="post"
                            enctype="multipart/form-data">
                            <label>อีเมล์</label>
                            <input type="text" class="form-control" placeholder="อีเมล์" id="email" name="email"
                                required>
                            <button type="submit" class="btn btn-warning btn-block btn-round bg-warning" name="submit"
                                value="Submit" id="submit">ยืนยัน</button>
                        </form>
                        <div class="forgot">
                            <a href="<?= site_url('login') ?>" class="btn btn-link btn-default">ล็อคอิน</a>
                            <a href="<?= site_url('register') ?>" class="btn btn-link btn-default">สมัครสมาชิก</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="<?= base_url('assets/js/core/jquery.min.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/core/popper.min.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/core/bootstrap.min.js') ?>" type="text/javascript"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="<?= base_url('assets/js/plugins/bootstrap-switch.js') ?>"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="<?= base_url('assets/js/plugins/nouislider.min.js') ?>" type="text/javascript"></script>
    <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
    <script src="<?= base_url('assets/js/plugins/moment.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/bootstrap-datepicker.js') ?>" type="text/javascript"></script>
    <!-- Control Center for Paper Kit: parallax effects, scripts for the example pages, etc -->
    <script src="<?= base_url('assets/js/paper-kit.js?v=2.2.0') ?>" type="text/javascript"></script>
    <script src="<?= base_url('dist/sweetalert/sweetalert2.js'); ?>"></script>

    <script>
        $(document).ready(function () {
            $(".overlay").hide();
        });

        $("#forgot_password").on('submit', function (e) {
            e.preventDefault();
            action_('request_resetpassword', 'forgot_password');
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
                beforeSend: function () {
                    // Show loading indicator here
                    var loadingIndicator = Swal.fire({
                        title: 'กําลังดําเนินการ...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
                },
                success: function (response) {
                    Swal.close();
                    if (response.success) {
                        Swal.fire({
                            title: response.message,
                            icon: 'success',
                            showConfirmButton: true,
                            allowOutsideClick: false
                        });
                        setTimeout(() => {
                            if (response.reload) {
                                window.location.href = '<?= site_url('resetpassword/') ?>' + response.data;
                            }
                        }, 2000);
                    } else {
                        Swal.fire({
                            title: response.message,
                            icon: 'error',
                            showConfirmButton: true,
                            confirmButtonText: "ตกลง",
                        });
                    }
                },
            });
        }
    </script>
</body>

</html>