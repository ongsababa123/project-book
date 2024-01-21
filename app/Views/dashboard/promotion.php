<title>ข้อมูลการจัดการโปรโมชั่น</title>

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
                                                    <th>สถานะ</th>
                                                    <th>action</th>
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
        function load_modal(load_check) {
            Create_Promotion = document.getElementById("Create_Promotion");

            if (load_check == 1) {
                Create_Promotion.style.display = "block";
                $(".modal-header #title_modal").text("สร้างข้อมูลโปรโมชั่น");
                $(".modal-footer #submit").text("สร้างข้อมูลโปรโมชั่น");
                $(".modal-body #url_route").val("dashboard/promotion/create");
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
                            var imageSrc = 'data:image/png;base64,' + data.image_promotion;
                            return '<a href="' + imageSrc + '" data-toggle="lightbox" id="image-preview-extra">' +
                                '<img class="img-fluid" style="width: 15rem;" src="' + imageSrc + '" alt="white sample" id="image-preview" />' +
                                '</a>';
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
                            <?php if (session()->get('type') == '2'): ?>
                                var status = data.status;
                                if (status == 1) {
                                    return `<button type="button" class="btn btn-warning" onclick="confirm_Alert('ต้องการปิดใช้งานใช้หรือไม่','dashboard/promotion/edit/${data.id_promotion}/0')">แก้ไขสถานะ</button>`;
                                } else if (status == 0) {
                                    return `<button type="button" class="btn btn-warning" onclick="confirm_Alert('ต้องการเปิดใช้งานใช้หรือไม่','dashboard/promotion/edit/${data.id_promotion}/1')">แก้ไขสถานะ</button>`;
                                }
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