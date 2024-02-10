<title>รายงานเข้า-ออก</title>
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
<style>
    #form_details_history {
        display: none;
    }

    #form_details_image {
        display: none;
    }
</style>
<style>
    .select2 {
        width: 100% !important;
    }

    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 37px;
        user-select: none;
        -webkit-user-select: none;
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>รายงานเข้า-ออก</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/dashboard/index'); ?>">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">รายงานเข้า-ออก</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card" id="customer_Table">
                            <div class="card-header bg-navy">
                                <h2 class="card-title"></h2>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>ประเภท</label>
                                            <select class="form-control select2" style="width: 100%;" id="type"
                                                name="type">
                                                <option selected="selected" value="0">ทั้งหมด</option>
                                                <option value="1">เข้าสู่ระบบ</option>
                                                <option value="2">ออกจากระบบ</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label>ประเภทผู้ใช้</label>
                                        <select class="form-control select2" style="width: 100%;" id="user_type"
                                            name="user_type">
                                            <option selected="selected" value="0">ทั้งหมด</option>
                                            <option value="1">ผู้จัดการระบบ</option>
                                            <option value="2">เจ้าของร้าน</option>
                                            <option value="3">พนักงานร้าน</option>
                                            <option value="4">ลูกค้า</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>วันที่ต้องคืน</label>
                                            <div class="input-group date" id="date_activity__"
                                                data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input gray-text"
                                                    data-target="#date_activity" name="date_activity" id="date_activity"
                                                    required />
                                                <div class="input-group-append" data-target="#date_activity"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2" style="margin-top: 30px;">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-dark"
                                            onclick="getTableData()">ค้นหา</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="table_customer" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ชื่อ - นามสกุล</th>
                                                    <th>ประเภทผู้ใช้</th>
                                                    <th>ประเภท</th>
                                                    <th>วันที่</th>
                                                    <th>เวลา</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="overlay dark">
                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                            </div>
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
            getTableData();
        });
    </script>
    <script>
        $('.select2').select2()
        $('#date_activity').datetimepicker({
            format: 'YYYY-MM-DD',
        });
    </script>
    <script>
        function getTableData() {
            var type = document.getElementById('type').value;

            // ดึงค่าจาก dropdown ประเภทผู้ใช้
            var user_type = document.getElementById('user_type').value;

            // ดึงค่าจากวันที่
            var date_activity = document.getElementById('date_activity').value;

            console.log(type, user_type, date_activity);
            if ($.fn.DataTable.isDataTable('#table_customer')) {
                $('#table_customer').DataTable().destroy();
            }
            $('#table_customer').DataTable({
                "processing": $("#customer_Table .overlay").show(),
                "pageLength": 10,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?php echo site_url('dashboard/activity/getdata'); ?>",
                    'type': 'POST',
                    data: {
                        type: type,
                        user_type: user_type,
                        date_activity: date_activity
                    },
                },
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "ordering": false,
                "lengthChange": false,
                "autoWidth": false,
                "searching": true,
                "drawCallback": function (settings) {
                    $("#customer_Table .overlay").hide();
                    var daData = settings.json.data;
                    if (daData.length == 0) {
                        $('#table_customer tbody').html(`
                        <tr>
                            <td colspan="8" class="text-center">
                                ยังไม่มีข้อมูล
                            </td>
                        </tr>`
                        );
                    }
                },
                'columns': [
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return meta.settings.oAjaxData.start += 1;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data['data_user'].name + ' ' + data['data_user'].lastname;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            if (data.type_user == 1) {
                                return `<span class='badge bg-info'>ผู้จัดการระบบ</span>`;
                            } else if (data.type_user == 2) {
                                return `<span class='badge bg-maroon'>เจ้าของร้าน</span>`;
                            } else if (data.type_user == 3) {
                                return `<span class='badge bg-primary'>พนักงานร้าน</span>`;
                            } else if (data.type_user == 4) {
                                return `<span class='badge bg-purple'>ลูกค้า</span>`;
                            }
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            if (data.type == 1) {
                                return `<span class='badge bg-success'>เข้าสู่ระบบ</span>`;
                            } else if (data.type == 2) {
                                return `<span class='badge bg-danger'>ออกจากระบบ</span>`;
                            }
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.date_activity;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.time_activites;
                        }
                    },
                ]
            });
            $('[data-toggle="tooltip"]').tooltip();
        }
    </script>
    <script>
        function preventSpacebar(e) {
            if (e.keyCode === 32) {
                e.preventDefault();
            }
        }

        document.getElementById('date_activity').addEventListener('keydown', preventSpacebar);
    </script>