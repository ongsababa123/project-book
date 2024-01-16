<title>คลังหนังสือ :
    <?= $bookData['name_book'] ?>
</title>
<link rel="stylesheet" href="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.css'); ?>">

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>คลังหนังสือ :
                            <?= $bookData['name_book'] ?>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/dashboard/index'); ?>">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">คลังหนังสือ :
                                <?= $bookData['name_book'] ?>
                            </li>
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
                                        <button type="button" class="btn btn-block-tool btn-dark btn-sm"
                                            onclick="confirm_Alert('ยืนยันการเพิ่มจำนวนหนังสือ', '/dashboard/book/stock/create/<?= $bookData['id_book'] ?>')">เพิ่มจำนวนหนังสือ</button>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <?php
                                        // Assuming $book['pic_book'] contains the base64-encoded image data
                                        if ($bookData['pic_book'] === null) {
                                            $imageSrc = base_url('dist/img/image-preview.png');
                                        } else {
                                            $base64Data = $bookData['pic_book'];
                                            $decodedData = base64_decode($base64Data);
                                            $imageSrc = 'data:image/png;base64,' . base64_encode($decodedData);
                                        }
                                        ?>
                                        <a href="<?= $imageSrc ?>" data-toggle="lightbox"
                                            data-title="<?= $bookData['name_book'] ?>" data-gallery="gallery">
                                            <img src="<?= $imageSrc ?>" class="img-fluid mb-2" alt="white sample"
                                                width="100" />
                                        </a>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="table_book_stock" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
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
        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function (event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.btn[data-filter]').on('click', function () {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>
    <script>
        $(document).ready(function () {
            getTableData();
        })
    </script>
    <script>
        var bookData = <?php echo json_encode($bookData); ?>;
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
                    'url': "<?php echo site_url('dashboard/book/stock/getdata/'); ?>" + bookData.id_book,
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
        function change_status_(id_stock) {
            // Create an options object for inputOptions
            Swal.fire({
                title: "เลือกสถานะที่ต้องการเปลี่ยน",
                input: "select",
                inputOptions: {
                    0: "ไม่พร้อมใช้งาน",
                    1: "พร้อมใช้งาน",
                    2: "กำลังเช่า",
                    3: "หนังสือหาย",
                    4: "หนังสือชำรุด",
                    5: "หนังสือไม่สามารถใช้ต่อได้"
                },
                inputPlaceholder: "เลือกสถานะ",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "ตกลง",
                cancelButtonText: "ปิด",
                inputValidator: (value) => {
                    return new Promise((resolve) => {
                        if (value) {
                            var url = 'dashboard/book/stock/changestatus/' + id_stock + '/' + value;
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