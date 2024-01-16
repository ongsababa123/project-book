<title>คลังหนังสือทั้งหมด</title>
<link rel="stylesheet" href="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.css'); ?>">

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>คลังหนังสือทั้งหมด</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/dashboard/index'); ?>">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">คลังหนังสือทั้งหมด</li>
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
                            <div class="card-header bg-lightblue">
                                <h4 class="card-title">
                                </h4>
                                <div class="card-tools">
                                    <?php if (session()->get('type') == '2'): ?>
                                        <button type="button"
                                            class="btn btn-block-tool btn-dark btn-sm" onclick="add_Book_Stock()">เพิ่มจำนวนหนังสือ</button>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="table_book_stock" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ชื่อหนังสือ</th>
                                                    <th>รหัสหนังสือ</th>
                                                    <th>สถานะหนังสือ</th>
                                                    <th>การกระทำ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>

    <script src="<?= base_url('plugins/filterizr/jquery.filterizr.min.js') ?>"></script>
    <script src="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.min.js') ?>"></script>
    <script>
        $(document).ready(function () {
            getTableData();
        })
    </script>
    <script>
        function getTableData() {
            if ($.fn.DataTable.isDataTable('#table_book_stock')) {
                $('#table_book_stock').DataTable().destroy();
            }
            $('#table_book_stock').DataTable({
                "processing": $("#customer_Table .overlay").show(),
                "pageLength": 10,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?php echo site_url('dashboard/book/stock/getdata/'); ?>" + 0,
                    'type': 'GET',
                    'dataSrc': 'data',
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
                        $('#table_book_stock tbody').html(`
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
                            return data.name_book;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.id_number_;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            var status_book = data.status_stock;
                            var statusMap = {
                                0: "<span class='badge bg-danger'>ยังไม่พร้อมใช้งาน</span>",
                                1: "<span class='badge bg-success'>พร้อมใช้งาน</span>",
                                2: "<span class='badge bg-info'>กำลังเช่า</span>",
                                3: "<span class='badge bg-danger'>หนังสือหาย</span>",
                                4: "<span class='badge bg-danger'>หนังสือชำรุด</span>",
                                5: "<span class='badge bg-danger'>หนังสือไม่สามารถใช้ต่อได้</span>"
                            };
                            return statusMap[status_book] || '';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return `<button type="button" class="btn btn-block-tool btn-info btn-sm mb-2" onclick="change_status_(${data.id_stock})">เปลี่ยนสถานะ</button>`;
                        }
                    },
                ]
            });
            $('[data-toggle="tooltip"]').tooltip();
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
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                        setTimeout(() => {
                            if (response.reload) {
                                window.location.reload();
                            }
                        }, 2000);
                    } else {
                        Swal.fire({
                            title: response.image_error,
                            icon: 'error',
                            confirmButtonText: "ตกลง",
                            showConfirmButton: true,
                            width: '55%'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        title: "เกิดข้อผิดพลาด",
                        icon: 'error',
                        showConfirmButton: true,
                        confirmButtonText: "ตกลง",
                    });
                }
            });
        }
    </script>
    <script>
        function confirm_Alert(text, url) {
            Swal.fire({
                title: text,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                confirmButtonText: "ตกลง",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>' + url,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
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
                    }).done(function (response) {
                        Swal.close();
                        if (response.success) {
                            Swal.fire({
                                title: response.message,
                                icon: 'success',
                                showConfirmButton: true,
                                confirmButtonText: "ตกลง",
                            });
                            setTimeout(() => {
                                if (response.reload) {
                                    getTableData();
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
                    });
                }
            });
        }
    </script>
    <script>
        var bookData = <?php echo json_encode($bookData); ?>;

        function add_Book_Stock() {
            // Create an options object for inputOptions
            var options = {};
            bookData.forEach(element => {
                if (element.status_project != 0) {
                    options[element.id_book] = element.name_book;
                }
            });
            Swal.fire({
                title: "เลือกหนังสือที่ต้องการเพิ่ม",
                input: "select",
                inputOptions: options,
                inputPlaceholder: "เลือกหนังสือ",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                confirmButtonText: "ตกลง",
                cancelButtonText: "ปิด",
                inputValidator: (value) => {
                    return new Promise((resolve) => {
                        if (value) {
                            var url = '/dashboard/book/stock/create/' + value;
                            $.ajax({
                                url: '<?= base_url() ?>' + url,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
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
                            }).done(function (response) {
                                Swal.close();
                                console.log(response);
                                if (response.success) {
                                    Swal.fire({
                                        title: response.message,
                                        icon: 'success',
                                        showConfirmButton: true,
                                        confirmButtonText: "ตกลง",
                                    });
                                    setTimeout(() => {
                                        if (response.reload) {
                                            getTableData();
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
                            });
                        } else {
                            resolve("กรุณาเลือกสถานะ");
                        }
                    });
                }
            });
        }
    </script>