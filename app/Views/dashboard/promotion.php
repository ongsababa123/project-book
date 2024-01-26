<title>ข้อมูลการจัดการโปรโมชั่น</title>
<link rel="stylesheet" href="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.css'); ?>">
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url('plugins/daterangepicker/daterangepicker.css'); ?>">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet"
    href="<?= base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('plugins/select2/css/select2.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?= base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
<style>
    .select2 {
        width: 100% !important;
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
    /* Select2 CSS ที่คุณต้องการ */

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
                        <h1>ข้อมูลการจัดการโปรโมชั่น</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/dashboard/index'); ?>">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">ข้อมูลการจัดการโปรโมชั่น</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card" id="promotion_Table">
                            <div class="card-header">
                                <h2 class="card-title"></h2>
                                <div class="card-tools">
                                    <?php if (session()->get('type') == '2'): ?>
                                        <button type="button" class="btn btn-block-tool btn-success btn-sm"
                                            data-toggle="modal" data-target="#modal-default"
                                            onclick="load_modal(1)">สร้างโปรโมชั่น</button>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="table_promotion" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ภาพโปรโมชั่น</th>
                                                    <th>รายละเอียดโปรโมชั่น</th>
                                                    <th>ประเภทโปรโมชั่น</th>
                                                    <th>ราคาส่วนลด</th>
                                                    <th>ประเภทการลด</th>
                                                    <th>วันที่สิ้นสุดโปรโมชั่น</th>
                                                    <th>สถานะ</th>
                                                    <th></th>
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
    <div class="modal fade" id="modal-default">
        <div id="Create_Promotion">
            <?= $this->include("modal/Create_Promotion"); ?>
        </div>
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
        function load_modal(load_check, data_encode) {
            Create_Promotion = document.getElementById("Create_Promotion");
            var data_book = <?php echo json_encode($book); ?>;
            var data_category = <?php echo json_encode($category); ?>;

            $(".modal-body #id_book_cat").empty();
            $(".modal-body #id_book_cat_2").val('');
            $(".modal-body #number_cal").val('');
            $(".modal-body #end_date_promotion").val('');
            $(".modal-body #detail_promotion").val('');
            $(".modal-body #detail_promotion_show").val('');
            $(".modal-body #id_book_cat").prop("disabled", false);
            $(".modal-body #id_book_cat_2").prop("disabled", false);
            $(".modal-body #answer_1").prop("disabled", false);
            $(".modal-body #answer_2").prop("disabled", false);
            $(".modal-body #answer_1_1").prop("disabled", false);
            $(".modal-body #answer_2_1").prop("disabled", false);
            $(".modal-body #answer_3").prop("disabled", false);
            $(".modal-body #answer_4").prop("disabled", false);
            $(".modal-body #number_cal").prop("disabled", false);
            $(".modal-body #detail_promotion_show").prop("disabled", true);

            if (load_check == 1) {
                Create_Promotion.style.display = "block";
                $(".modal-body #status_check").hide();
                $(".modal-body #answer_1").prop('checked', true);
                $(".modal-body #answer_3").prop('checked', true);
                $(".modal-body #book_cat_2").hide();
                $(".modal-body #book_cat_1").show();
                data_book.forEach(element_book_cr => {
                    var newOption = $('<option>').val(element_book_cr.id_book).text(element_book_cr.name_book);
                    $(".modal-body #id_book_cat").append(newOption);
                });
                var imageSrc = '<?= base_url("dist/img/image-preview.png"); ?>';
                $(".modal-body #image-preview___").attr("src", imageSrc);
                $(".modal-body #mage-preview-extra__").attr("href", imageSrc);

                $(".modal-header #title_modal").text("สร้างข้อมูลโปรโมชั่น");
                $(".modal-footer #submit").text("สร้างข้อมูลโปรโมชั่น");
                $(".modal-body #url_route").val("dashboard/promotion/create");
                change_text();
            } else if (load_check == 2) {
                Create_Promotion.style.display = "block";
                const rowData = JSON.parse(decodeURIComponent(data_encode));
                $(".modal-body #status_check").show();
                if (rowData.status == 1) {
                    $(".modal-body #answer_5").prop('checked', true);
                } else {
                    $(".modal-body #answer_6").prop('checked', true);
                }
                
                $(".modal-body #id_book_cat").prop("disabled", true);
                $(".modal-body #id_book_cat_2").prop("disabled", true);
                $(".modal-body #answer_1").prop("disabled", true);
                $(".modal-body #answer_2").prop("disabled", true);
                $(".modal-body #answer_1_1").prop("disabled", true);
                $(".modal-body #answer_2_1").prop("disabled", true);
                if (rowData.type_promotion == 1) {
                    $(".modal-body #book_cat_1").show();
                    $(".modal-body #book_cat_2").hide();
                    $(".modal-body #answer_1").prop('checked', true);
                    data_book.forEach(element_book_cr => {
                        var newOption = $('<option>').val(element_book_cr.id_book).text(element_book_cr.name_book);
                        if (element_book_cr.id_book == rowData.id_book_cat) {
                            $(".modal-body #id_book_cat").append(newOption.prop('selected', true));
                        } else {
                            $(".modal-body #id_book_cat").append(newOption);
                        }
                    });
                } else if (rowData.type_promotion == 2) {
                    $(".modal-body #book_cat_1").show();
                    $(".modal-body #book_cat_2").hide();
                    $(".modal-body #answer_2").prop('checked', true);
                    data_category.forEach(element_category_cr => {
                        var newOption = $('<option>').val(element_category_cr.id_category).text(element_category_cr.name_category);
                        if (element_category_cr.id_category == rowData.id_book_cat) {
                            $(".modal-body #id_book_cat").append(newOption.prop('selected', true));
                        } else {
                            $(".modal-body #id_book_cat").append(newOption);
                        }
                    })
                } else if (rowData.type_promotion == 3) {
                    $(".modal-body #book_cat_1").hide();
                    $(".modal-body #book_cat_2").show();
                    $(".modal-body #answer_1_1").prop('checked', true);
                    $(".modal-body #id_book_cat_2").val(rowData.id_book_cat);
                } else if (rowData.type_promotion == 4) {
                    $(".modal-body #book_cat_1").hide();
                    $(".modal-body #book_cat_2").show();
                    $(".modal-body #answer_2_1").prop('checked', true);
                    $(".modal-body #id_book_cat_2").val(rowData.id_book_cat);
                }

                $(".modal-body #answer_3").prop("disabled", true);
                $(".modal-body #answer_4").prop("disabled", true);
                if (rowData.type_sale == 1) {
                    $(".modal-body #answer_3").prop('checked', true);
                } else {
                    $(".modal-body #answer_4").prop('checked', true);
                }
                if (rowData.image_promotion == null) {
                    var imageSrc = '<?= base_url("dist/img/image-preview.png"); ?>';
                } else {
                    var imageSrc = "data:image/png;base64," + rowData.image_promotion;
                }
                $(".modal-body #image-preview___").attr("src", imageSrc);
                $(".modal-body #image-preview-extra__").attr("href", imageSrc);
                $(".modal-body #number_cal").val(rowData.number_cal);
                $(".modal-body #number_cal").prop("disabled", true);
                $(".modal-body #end_date_promotion").val(rowData.date_end);

                $(".modal-body #detail_promotion").val(rowData.details);
                $(".modal-body #detail_promotion_show").val(rowData.details);

                $(".modal-header #title_modal").text("แก้ไขข้อมูลโปรโมชั่น");
                $(".modal-footer #submit").text("แก้ไขข้อมูลโปรโมชั่น");
                $(".modal-body #url_route").val("dashboard/promotion/edit/" + rowData.id_promotion);

            }
        }
    </script>
    <script>
        $(document).ready(function () {
            getTableData();
        });
    </script>
    <script>
        function getTableData() {
            var data_book = <?php echo json_encode($book); ?>;
            var data_category = <?php echo json_encode($category); ?>;

            if ($.fn.DataTable.isDataTable('#table_promotion')) {
                $('#table_promotion').DataTable().destroy();
            }
            $('#table_promotion').DataTable({
                "processing": $("#admin_Table .overlay").show(),
                "pageLength": 10,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?php echo site_url('dashboard/promotion/getdata'); ?>",
                    'type': 'GET',
                    'dataSrc': 'data',
                },
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "ordering": false,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false,
                "drawCallback": function (settings) {
                    $("#promotion_Table .overlay").hide();
                    var daData = settings.json.data;
                    if (daData.length == 0) {
                        $('#table_promotion tbody').html(`
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
                            if (data.image_promotion == null) {
                                return "ไม่มีรูปภาพ"
                            } else {
                                var imageSrc = 'data:image/png;base64,' + data.image_promotion;
                                return '<a href="' + imageSrc + '" data-toggle="lightbox" id="image-preview-extra">' +
                                    '<img class="img-fluid" style="width: 15rem;" src="' + imageSrc + '" alt="white sample" id="image-preview" />' +
                                    '</a>';
                            }
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.details;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            if (data.type_promotion == 1) {
                                return "หนังสือ"
                            } else if (data.type_promotion == 2) {
                                return "หมวดหมู่"
                            } else if (data.type_promotion == 3) {
                                return "เมื่อเช่าครบ(ครั้ง)"
                            } else if (data.type_promotion == 4) {
                                return "เมื่อเช่ามากกว่า(/เล่ม)"
                            } else {
                                return "-"
                            }
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            if (data.type_promotion == 0) {
                                return "-"
                            } else {
                                return data.number_cal;
                            }
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            if (data.type_sale == 1) {
                                return "คิดแบบลบ"
                            } else if (data.type_sale == 2) {
                                return "คิดแบบเปอร์เซ็นต์"
                            } else {
                                return "-"
                            }
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.date_end ?? '-';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            var status = data.status;
                            if (status == 1) {
                                return `<span class='badge bg-success'>ใช้งาน</span>`;
                            } else if (status == 0) {
                                return `<span class='badge bg-danger'>ปิดใช้งาน</span>`;
                            } else {
                                return status;
                            }
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            const encodedRowData = encodeURIComponent(JSON.stringify(row));
                            <?php if (session()->get('type') == '2'): ?>
                                return `<button type="button" class="btn btn-warning" onclick="load_modal(2,'${encodedRowData}')" data-toggle="modal" data-target="#modal-default">แก้ไขโปรโมชั่น</button>`;
                            <?php else: ?>
                                return ``;
                            <?php endif; ?>
                        }

                    },
                ]
            });
            $('[data-toggle="tooltip"]').tooltip();
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
                                showConfirmButton: false
                            });
                            setTimeout(() => {
                                if (response.reload) {
                                    window.location.reload();
                                }
                            }, 2000);
                        } else {
                            Swal.fire({
                                title: response.message,
                                icon: 'error',
                                confirmButtonText: "ตกลง",
                                showConfirmButton: true
                            });
                        }
                    });
                }
            });
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
                        confirmButtonText: "ตกลง",
                        showConfirmButton: true
                    });
                }
            });
        }
    </script>