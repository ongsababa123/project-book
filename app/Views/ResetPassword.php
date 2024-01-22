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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="icon" href="<?= base_url('dist/img/icon/favicon.ico') ?>" type="image/gif">
    <title>รีเซ็ตรหัสผ่าน</title>

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
                <a class="navbar-brand" href="<?= site_url('/') ?>" rel="tooltip" title="Coded by Creative Tim"
                    style="font-size: medium" data-placement="bottom">
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
                        <a href="#" id="navbarDropdownMenu" data-toggle="dropdown" aria-haspopup="true"
                            style="font-size: medium" aria-expanded="false" class="nav-link">รายละเอียด</i></a>
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
                        <a href="<?= site_url('/book/booklist') ?>" class="nav-link" style="font-size: medium">
                            รายการหนังสือ</a>
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
                <div class="col-lg-4 ml-auto mr-auto">
                    <div class="card card-register">
                        <h2 class="title mx-auto">สร้างรหัสผ่านใหม่</h2>
                        <div class="social-line text-center">
                            <img src="<?= base_url('dist/img/logo11.png') ?>">
                        </div>
                        <form class="mb-3" id="forgotpassword_form" action="javascript:void(0)" method="post"
                            enctype="multipart/form-data">
                            <input type="text" class="form-control" placeholder="อีเมล์" id="email" name="email"
                                value="<?= $email ?>" hidden>
                            <input type="textarea" class="form-control" placeholder="อีเมล์" id="pin" name="pin"
                                value="<?= $pin ?>" hidden>
                            <label>รหัสผ่าน</label>
                            <input type="password" class="form-control" placeholder="รหัสผ่าน" name="password"
                                id="password" required oninput="checkPassword()">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="" id="showpassword1"
                                        name="showpassword1">แสดงรหัสผ่าน
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <label>ยืนยันรหัสผ่าน</label>
                            <input type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน"
                                name="password_confirmation" id="password_confirmation" required
                                oninput="checkPassword()">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="" id="showpassword2"
                                        name="showpassword2">แสดงรหัสผ่าน
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <br>
                            <div class="alert alert-danger" role="alert" id="lengthAlert" style="display: none;">
                                รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร
                            </div>
                            <div class="alert alert-danger" role="alert" id="symbolAlert" style="display: none;">
                                รหัสผ่านห้ามใช้เครื่องหมายพิเศษ
                            </div>
                            <div class="alert alert-danger" role="alert" id="charAlert" style="display: none;">
                                รหัสผ่านจะต้องมีตัวอักษร และตัวเลข
                            </div>
                            <div class="alert alert-danger" role="alert" id="confirmAlert" style="display: none;">
                                รหัสผ่านและยืนยันรหัสผ่านต้องตรงกัน
                            </div>
                            <button type="submit" class="btn btn-warning btn-block btn-round bg-warning" name="submit"
                                value="Submit" id="submit">ยืนยันรหัสผ่าน</button>
                        </form>
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
            updateSubmitButton();
        });

        $("#forgotpassword_form").on('submit', function (e) {
            e.preventDefault();
            action_('update/resetpassword', 'forgotpassword_form');
        });
    </script>
    <script>
        function action_(url, form) {
            var formData = new FormData(document.getElementById(form));
            $.ajax({
                url: '<?= base_url('update/resetpassword') ?>',
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
                            confirmButtonText: "ตกลง",
                            allowOutsideClick: false
                        }).then((result) => {
                            // Check if the user clicked the confirm button
                            if (result.isConfirmed) {
                                // Redirect to the login page, you may need to adjust the URL
                                window.location.href = '<?= site_url('login') ?>';
                            }
                        });
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
    <script>
        function checkPassword() {
            var passwordInput = document.getElementById("password");
            var confirmPasswordInput = document.getElementById("password_confirmation");
            var lengthAlert = document.getElementById("lengthAlert");
            var symbolAlert = document.getElementById("symbolAlert");
            var charAlert = document.getElementById("charAlert");
            var confirmAlert = document.getElementById("confirmAlert");
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


            if (passwordInput.value === confirmPasswordInput.value) {
                confirmAlert.style.display = "none";
            } else {
                confirmAlert.style.display = "block";
            }
            console.log(passwordInput.value != confirmPasswordInput.value);
            updateSubmitButton();
        }

        function updateSubmitButton() {
            var passwordInput = document.getElementById("password");
            var confirmPasswordInput = document.getElementById("password_confirmation");

            // Check ว่า checkbox ถูกติ๊ก และรหัสผ่านตรงตามเงื่อนไขหรือไม่
            if (passwordInput.value.length >= 8 && !/[^\w\s]/.test(passwordInput.value) && /^(?=.*\d)(?=.*[a-zA-Z])/.test(passwordInput.value) && passwordInput.value === confirmPasswordInput.value) {
                $('#submit').prop('disabled', false);
            } else {
                $('#submit').prop('disabled', true);
            }
        }
    </script>
        <script>
        const passwordInput1 = document.getElementById('password');
        const passwordInput2 = document.getElementById('password_confirmation');
        const showPasswordCheckbox1 = document.getElementById('showpassword1');
        const showPasswordCheckbox2 = document.getElementById('showpassword2');

        showPasswordCheckbox1.addEventListener('change', function () {
            if (this.checked) {
                passwordInput1.type = 'text';
            } else {
                passwordInput1.type = 'password';
            }
        });
        showPasswordCheckbox2.addEventListener('change', function () {
            if (this.checked) {
                passwordInput2.type = 'text';
            } else {
                passwordInput2.type = 'password';
            }
        });
    </script>
</body>

</html>