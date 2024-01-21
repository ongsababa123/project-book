<title>คลังหนังสือทั้งหมด</title>
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
                                        <button type="button" class="btn btn-block-tool btn-dark btn-sm" data-toggle="modal"
                                            data-target="#modal-default">เพิ่มจำนวนหนังสือ</button>
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
                                                    <th>คำอธิบาย</th>
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
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="overlay preloader">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <div class="modal-header bg-info">
                    <h4 class="modal-title" id="title_modal" name="title_modal">เพิ่มจำนวนหนังสือ</h4>
                </div>
                <div class="modal-body">
                    <form class="mb-3" id="form_add_stock" action="javascript:void(0)" method="post"
                        enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12" id="detail_group">
                                <div class="form-group">
                                    <label>เลือกหนังสือ</label>
                                    <select class="form-control select2" style="width: 100%; height: 40px" id="book_id"
                                        name="book_id">
                                        <option selected="selected" value="">เลือกหนังสือ</option>
                                        <?php foreach ($bookData as $book): ?>
                                            <option value="<?= $book['id_book']; ?>">
                                                <?= $book['name_book']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" name="submit" value="Submit"
                                id="submit">เพิ่มจำนวนหนังสือ</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('plugins/filterizr/jquery.filterizr.min.js') ?>"></script>
    <script src="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.min.js') ?>"></script>
    <!-- Select2 -->
    <script src="<?= base_url('plugins/select2/js/select2.full.min.js'); ?>"></script>
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
                            return data.description ?? '-';
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
                            showConfirmButton: true,
                            confirmButtonText: "ตกลง",
                            allowOutsideClick: false
                        });
                        setTimeout(() => {
                            if (response.reload) {
                                getTableData();
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
                cancelButtonText: "ยกเลิก",
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
                            }, 1000);
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
        $('.select2').select2();
        $("#form_add_stock").on('submit', function (e) {
            e.preventDefault();
            if ($('#book_id').val() == '') {
                Swal.fire({
                    title: "กรุณาเลือกหนังสือ",
                    icon: 'error',
                    showConfirmButton: true,
                    confirmButtonText: "ตกลง",
                })
            } else {
                const url = '/dashboard/book/stock/create/' + $('#book_id').val();
                action_(url, 'form_add_stock');
            }
        });
    </script>
    <script>
        function change_status_(id_stock) {
            const inputOptions = {
                0: "ไม่พร้อมใช้งาน",
                1: "พร้อมใช้งาน",
                2: "กำลังเช่า",
                3: "หนังสือหาย",
                4: "หนังสือชำรุด",
                5: "หนังสือไม่สามารถใช้ต่อได้"
            };

            Swal.fire({
                title: "เลือกสถานะที่ต้องการเปลี่ยน",
                html: `
                <select id="swal-input2" class="form-control">
                    ${Object.keys(inputOptions).map(key => `<option value="${key}">${inputOptions[key]}</option>`).join('')}
                </select>
                <br id="additional-input_" style="display: none;">
                <input id="additional-input" class="form-control" style="display: none;" placeholder="คำอธิบาย">
            `,
                focusConfirm: false,
                showCancelButton: true,
                cancelButtonText: "ยกเลิก",
                confirmButtonText: "ตกลง",

                preConfirm: () => {
                    const selectValue = document.getElementById("swal-input2").value;
                    const inputValue2 = (selectValue === '4') ? document.getElementById("additional-input").value : '';
                    return [selectValue, inputValue2];
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>' + 'dashboard/book/stock/changestatus/' + id_stock + '/' + result.value[0],
                        type: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        data: {
                            selectValue: result.value[0],
                            description: result.value[1]
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
                            // Handle success
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
                                }, 1000);
                            } else {
                                Swal.fire({
                                    title: response.message,
                                    icon: 'error',
                                    showConfirmButton: true,
                                    confirmButtonText: "ตกลง",
                                });
                            }
                        },
                        error: function (error) {
                            // Handle error
                            console.error(error);
                        }
                    });
                }
            });

            // Show/hide additional input based on select value
            document.getElementById("swal-input2").addEventListener("change", function () {
                const additionalInput = document.getElementById("additional-input");
                const additionalInput_ = document.getElementById("additional-input_");
                additionalInput.style.display = (this.value === '4') ? 'block' : 'none';
                additionalInput_.style.display = (this.value === '4') ? 'block' : 'none';
            });
        }
    </script>