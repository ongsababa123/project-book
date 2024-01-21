<title>รายงานการขาย</title>
<link rel="stylesheet" href="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.css'); ?>">
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url('plugins/daterangepicker/daterangepicker.css'); ?>">
<!-- Tempusdominus Bootstrap 4 -->
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('plugins/select2/css/select2.min.css'); ?>">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?= base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
<link rel="stylesheet"
    href="<?= base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">

<body class="hold-transition sidebar-mini">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>รายงานการขาย
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><a>รายงานการขาย</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card card-navy card-tabs">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" class="score-radio" id="answer_day" name="r_" value="1"
                                                checked onclick="change_radio(this)">
                                            <label for="answer_day" id="label_answer_day">ยอดขายรายวัน</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" class="score-radio" id="answer_mounth" name="r_"
                                                value="2" onclick="change_radio(this)">
                                            <label for="answer_mounth" id="label_answer_mounth">ยอดขายรายเดือน</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" class="score-radio" id="answer_year" name="r_" value="3"
                                                onclick="change_radio(this)">
                                            <label for="answer_year" id="label_answer_year">ยอดขายรายปี</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-2" id="day">
                                        <div class="form-group">
                                            <label>วัน</label>
                                            <div class="input-group date" id="datetimepicker_day"
                                                data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#datetimepicker_day" data-toggle="datetimepicker" />
                                                <div class="input-group-append" data-target="#datetimepicker_day"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2" id="mounth">
                                        <div class="form-group">
                                            <label>เดือน</label>
                                            <div class="input-group date" id="datetimepicker_month"
                                                data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#datetimepicker_month" data-toggle="datetimepicker" />
                                                <div class="input-group-append" data-target="#datetimepicker_month"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2" id="year">
                                        <div class="form-group">
                                            <label>ปี</label>
                                            <div class="input-group date" id="datetimepicker_year"
                                                data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#datetimepicker_year" data-toggle="datetimepicker" />
                                                <div class="input-group-append" data-target="#datetimepicker_year"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6 col-sm-6">
                        <div class="card card-navy">
                            <div class="card-header border-0">
                                <h3 class="card-title">Products</h3>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-bars"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Sales</th>
                                            <th>More</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Some Product
                                            </td>
                                            <td>$13 USD</td>
                                            <td>
                                                <small class="text-success mr-1">
                                                    <i class="fas fa-arrow-up"></i>
                                                    12%
                                                </small>
                                                12,000 Sold
                                            </td>
                                            <td>
                                                <a href="#" class="text-muted">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Another Product
                                            </td>
                                            <td>$29 USD</td>
                                            <td>
                                                <small class="text-warning mr-1">
                                                    <i class="fas fa-arrow-down"></i>
                                                    0.5%
                                                </small>
                                                123,234 Sold
                                            </td>
                                            <td>
                                                <a href="#" class="text-muted">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Amazing Product
                                            </td>
                                            <td>$1,230 USD</td>
                                            <td>
                                                <small class="text-danger mr-1">
                                                    <i class="fas fa-arrow-down"></i>
                                                    3%
                                                </small>
                                                198 Sold
                                            </td>
                                            <td>
                                                <a href="#" class="text-muted">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Perfect Item
                                                <span class="badge bg-danger">NEW</span>
                                            </td>
                                            <td>$199 USD</td>
                                            <td>
                                                <small class="text-success mr-1">
                                                    <i class="fas fa-arrow-up"></i>
                                                    63%
                                                </small>
                                                87 Sold
                                            </td>
                                            <td>
                                                <a href="#" class="text-muted">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6">
                        <div class="card card-navy card-tabs">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    <!-- InputMask -->
    <script src="<?= base_url('plugins/moment/moment.min.js'); ?>"></script>
    <!-- date-range-picker -->
    <script src="<?= base_url('plugins/daterangepicker/daterangepicker.js'); ?>"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
    <!-- Select2 -->
    <script src="<?= base_url('plugins/select2/js/select2.full.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/filterizr/jquery.filterizr.min.js') ?>"></script>
    <script src="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.min.js') ?>"></script>
    <script>
        $(document).ready(function () {
            var value = ['value' == 1];
            change_radio(value)
        });
    </script>
    <script>
        $(function () {
            $('#datetimepicker_year').datetimepicker({
                viewMode: 'years',
                format: 'YYYY',
            });
            $('#datetimepicker_month').datetimepicker({
                viewMode: 'months',
                format: 'YYYY-MM',
            });
            $('#datetimepicker_day').datetimepicker({
                format: 'YYYY-MM-DD',
            });
        });
    </script>
    <script>
        function change_radio(value) {
            console.log(value.value);

            if (value.value == 1) {
                $("#mounth").hide();
                $("#year").hide();
                $("#day").show();
            } else if (value.value == 2) {
                $("#mounth").show();
                $("#year").hide();
                $("#day").hide();
            } else {
                $("#mounth").hide();
                $("#year").show();
                $("#day").hide();
            }
        }
    </script>