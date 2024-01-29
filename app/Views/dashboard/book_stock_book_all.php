<title>ภาพรวมคลังหนังสือ</title>
<link rel="stylesheet" href="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.css'); ?>">
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('plugins/select2/css/select2.min.css'); ?>">
<style>
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 40px;
        user-select: none;
        -webkit-user-select: none;
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
<style>
    /* Hide the up and down arrows for number input */
    .swal2-input[type="number"]::-webkit-inner-spin-button,
    .swal2-input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .swal2-input[type="number"] {
        -moz-appearance: textfield;
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>ภาพรวมคลังหนังสือ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/dashboard/index'); ?>">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">ภาพรวมคลังหนังสือ</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-navy">
                                <h4 class="card-title">
                                    <i class="fas fa-book"></i>
                                    คลังหนังสือ
                                </h4>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="table_stock_all" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>จำนวนหนังสือทั้งหมด</th>
                                                    <th>จำนวนหนังสือในคลังทั้งหมด</th>
                                                    <th>ไม่พร้อมใช้งาน</th>
                                                    <th>พร้อมใช้งาน</th>
                                                    <th>จอง</th>
                                                    <th>กำลังเช่า</th>
                                                    <th>หนังสือหาย</th>
                                                    <th>หนังสือชำรุด</th>
                                                    <th>หนังสือไม่สามารถใช้ต่อได้</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td id="book_all"></td>
                                                    <td id="stock_all"></td>
                                                    <td id="not_ready_all"></td>
                                                    <td id="ready_all"></td>
                                                    <td id="reserve_all"></td>
                                                    <td id="rental_all"></td>
                                                    <td id="lost_all"></td>
                                                    <td id="damaged_all"></td>
                                                    <td id="not_use_all"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="overlay dark" id="overlay1">
                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-lightblue">
                                <h4 class="card-title">
                                </h4>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="table_book_stock"
                                            class="table table-hover table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ชื่อหนังสือ</th>
                                                    <th>จำนวนหนังสือในคลังทั้งหมด</th>
                                                    <th>ไม่พร้อมใช้งาน</th>
                                                    <th>พร้อมใช้งาน</th>
                                                    <th>จอง</th>
                                                    <th>กำลังเช่า</th>
                                                    <th>หนังสือหาย</th>
                                                    <th>หนังสือชำรุด</th>
                                                    <th>หนังสือไม่สามารถใช้ต่อได้</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="overlay dark" id="overlay2">
                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <script src="<?= base_url('plugins/filterizr/jquery.filterizr.min.js') ?>"></script>
    <script src="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.min.js') ?>"></script>
    <!-- Select2 -->
    <script src="<?= base_url('plugins/select2/js/select2.full.min.js'); ?>"></script>
    <script>
        $(document).ready(function () {
            getTableData();
            getTableData_count_all();
        })
    </script>
    <script>
        function getTableData() {
            if ($.fn.DataTable.isDataTable('#table_book_stock')) {
                $('#table_book_stock').DataTable().destroy();
            }
            $('#table_book_stock').DataTable({
                "processing": $('#overlay2').show(),
                "pageLength": 10,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?php echo site_url('dashboard/book/book_stock_all/getdata'); ?>",
                    'type': 'GET',
                    'dataSrc': 'data',
                },
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "ordering": false,
                "lengthChange": false,
                "autoWidth": false,
                "searching": true,
                "drawCallback": function (settings) {
                    $('#overlay2').hide();
                    var daData = settings.json.data;
                    if (daData.length == 0) {
                        $('#table_book_stock tbody').html(`
                        <tr>
                            <td colspan="10" class="text-center">
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
                            return data.name_book;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.stock_check.count_all_stock;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.stock_check.notready_book;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.stock_check.ready_book;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.stock_check.reserve_book;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.stock_check.rental_book;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.stock_check.lost_book;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.stock_check.damaged_book;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.stock_check.not_use_book;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return `<button type="button" class="btn btn-block-tool btn-info btn-sm mb-2" onclick="add_book(${data.id_book})">เพิ่มหนังสือ</button>`;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return `<a type="button" class="btn btn-block-tool btn-warning btn-sm mb-2" target="_blank" href="<?= site_url('dashboard/book/stock/index/'); ?>${data.id_book}">จัดการคลัง</a>`;
                        }
                    },
                ]
            });
            $('[data-toggle="tooltip"]').tooltip();
        }
    </script>
    <script>
        function getTableData_count_all() {
            $('#overlay1').show();
            $.ajax({
                url: '<?= base_url('dashboard/book/stock/getdata/countall') ?>',
                type: "GET",
                dataType: "JSON",
                success: function (response) {
                    $('#overlay1').hide();
                    console.log(response);
                    $('#book_all').text(response.data.count_all_book + ' เล่ม');
                    $('#stock_all').text(response.data.count_all_stock + ' เล่ม');
                    $('#not_ready_all').text(response.data.notready_book + ' เล่ม');
                    $('#ready_all').text(response.data.ready_book + ' เล่ม');
                    $('#reserve_all').text(response.data.reserve_book + ' เล่ม');
                    $('#rental_all').text(response.data.rental_book + ' เล่ม');
                    $('#lost_all').text(response.data.lost_book + ' เล่ม');
                    $('#damaged_all').text(response.data.damaged_book + ' เล่ม');
                    $('#not_use_all').text(response.data.not_use_book + ' เล่ม');
                }
            })
        }
    </script>
    <script>
        function add_book(id_book) {
            Swal.fire({
                title: "กรุณาใส่จำนวนหนังสือที่ต้องการเพิ่ม",
                input: "number",
                inputAttributes: {
                    autocapitalize: "off",
                    allowArrowKeys: false  // Disable arrow controls
                },
                showCancelButton: true,
                confirmButtonText: "ตกลง",
                cancelButtonText: "ยกเลิก",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>' + 'dashboard/book/stock/create/' + id_book,
                        type: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        data: {
                            quantity: result.value
                        },
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
                                });
                                setTimeout(() => {
                                    if (response.reload) {
                                        getTableData();
                                        getTableData_count_all();
                                    }
                                }, 1000);
                            } else {
                                Swal.fire({
                                    title: response.image_error,
                                    icon: 'error',
                                    confirmButtonText: "ตกลง",
                                    showConfirmButton: true,
                                    width: '55%'
                                });
                            }
                        }
                    })
                }
            });
        }

    </script>