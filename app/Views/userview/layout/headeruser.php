<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Paper Kit by Creative Tim
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="<?= base_url('assets/fontgoogle.css') ?>" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/paper-kit.css') ?>" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?= base_url('assets/demo/demo.css') ?>" rel="stylesheet" />

</head>
<style>
        * {
        font-family: 'Kanit', sans-serif;
    }
</style>
<body class="landing-page sidebar-collapse">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="300">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="https://demos.creative-tim.com/paper-kit/index.html" rel="tooltip"
                    title="Coded by Creative Tim" data-placement="bottom" target="_blank">
                    sadasdฟหกฟหกฟห
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
                    <li class="nav-item">
                        <a href="../index.html" class="nav-link"><i class="nc-icon nc-layout-11"></i> Components</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://demos.creative-tim.com/paper-kit-2/docs/1.0/getting-started/introduction.html"
                            target="_blank" class="nav-link"><i class="nc-icon nc-book-bookmark"></i> Documentation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom"
                            href="https://twitter.com/CreativeTim" target="_blank">
                            <i class="fa fa-twitter"></i>
                            <p class="d-lg-none">Twitter</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom"
                            href="https://www.facebook.com/CreativeTim" target="_blank">
                            <i class="fa fa-facebook-square"></i>
                            <p class="d-lg-none">Facebook</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="Follow us on Instagram" data-placement="bottom"
                            href="https://www.instagram.com/CreativeTimOfficial" target="_blank">
                            <i class="fa fa-instagram"></i>
                            <p class="d-lg-none">Instagram</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="Star on GitHub" data-placement="bottom"
                            href="https://www.github.com/CreativeTimOfficial" target="_blank">
                            <i class="fa fa-github"></i>
                            <p class="d-lg-none">GitHub</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="page-header" data-parallax="true"
        style="background-image: url('<?= base_url('dist/img/background.png') ?>');">
        <div class="filter"></div>
        <div class="container">
            <div class="motto text-center">
                <h1>Example page</h1>
                <h3>Start designing your landing page here.</h3>
                <br />
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn btn-outline-neutral btn-round"><i
                        class="fa fa-play"></i>Watch video</a>
                <button type="button" class="btn btn-outline-neutral btn-round">Download</button>
            </div>
        </div>
    </div>

    <footer class="footer   footer-white ">
        <div class="container">
            <div class="row">
                <nav class="footer-nav">
                    <ul>
                        <li>
                            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com/" target="_blank">Blog</a>
                        </li>
                        <li>
                            <a href="https://www.creative-tim.com/license" target="_blank">Licenses</a>
                        </li>
                    </ul>
                </nav>
                <div class="credits ml-auto">
                    <span class="copyright">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
                    </span>
                </div>
            </div>
        </div>
    </footer>
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

</body>

</html>