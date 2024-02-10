<title>หมวดหมู่หนังสือ</title>
<?php if (session()->get('type') == '3') {
    $type_hideen = 'hidden';
    $type_disable = 'disabled';
} else {
    $type_hideen = '';
    $type_disable = '';
}
?>

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>หมวดหมู่หนังสือ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/dashboard/index'); ?>">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">หมวดหมู่หนังสือ</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card" id="category_Table">
                            <div class="card-header">
                                <h2 class="card-title"></h2>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-block-tool btn-success btn-sm"
                                        data-toggle="modal" data-target="#modal-default" onclick="load_modal(1)"
                                        <?= $type_hideen ?>>สร้างหมวดหมู่</button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="table_category" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ชื่อหมวดหมู่</th>
                                                    <th>รายละเอียด</th>
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

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="modal-default">
        <div id="CRUD_Category">
            <?= $this->include("modal/CRUD_Category"); ?>
        </div>
    </div>
    <script>
        function load_modal(load_check, data_encode) {
            CRUD_Category = document.getElementById("CRUD_Category");
            $(".modal-body #name_category").val('');
            $(".modal-body #detail_category").val('');

            if (load_check == 1) {
                CRUD_Category.style.display = "block";
                $(".modal-body #customSwitch").hide();

                $(".modal-header #title_modal").text("สร้างข้อมูลหมวดหมู่");
                $(".modal-footer #submit").text("สร้างข้อมูลหมวดหมู่");
                $(".modal-body #url_route").val("dashboard/category/create");
            } else if (load_check == 2) {
                CRUD_Category.style.display = "block";
                const rowData = JSON.parse(decodeURIComponent(data_encode));
                $(".modal-body #customSwitch").show();

                $(".modal-body #name_category").val(rowData.name_category);
                $(".modal-body #detail_category").val(rowData.details);
                if (rowData.status == 1) {
                    $(".modal-body #customSwitch3").prop('checked', true);
                    $(".modal-body #LabelcustomSwitch3").text("เปิดใช้งาน");
                } else {
                    $(".modal-body #customSwitch3").prop('checked', false);
                    $(".modal-body #LabelcustomSwitch3").text("ปิดใช้งาน");
                }

                $(".modal-header #title_modal").text("แก้ไขข้อมูลหมวดหมู่");
                $(".modal-footer #submit").text("แก้ไขข้อมูลหมวดหมู่");
                $(".modal-body #url_route").val("dashboard/category/edit/" + rowData.id_category);
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
            if ($.fn.DataTable.isDataTable('#table_category')) {
                $('#table_category').DataTable().destroy();
            }
            $('#table_category').DataTable({
                "processing": $("#category_Table .overlay").show(),
                "pageLength": 10,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?php echo site_url('dashboard/category/getdata'); ?>",
                    'type': 'GET',
                    'dataSrc': 'data',
                },
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "ordering": false,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false,
                "drawCallback": function (settings) {
                    $("#category_Table .overlay").hide();
                    var daData = settings.json.data;
                    if (daData.length == 0) {
                        $('#table_category tbody').html(`
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
                            return data.name_category;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            if (type === 'display' && data.details && data.details.length > 50) {
                                return '<span data-toggle="tooltip" data-placement="top" title="' + data.details + '">' +
                                    data.details.substr(0, 50) + '...</span>';
                            }
                            return `<span data-toggle="tooltip" data-placement="top" title="${data.details}">
                            ${data.details} </span>`;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            var status = data.status;
                            if (status == 0) {
                                return `<span class='badge bg-danger'>ปิดใช้งาน</span>`;
                            } else if (status == 1) {
                                return `<span class='badge bg-success'>เปิดใช้งาน</span>`;
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
                            return `<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default" onclick="load_modal(2,'${encodedRowData}')" <?= $type_hideen ?>><i class="fas fa-tools"></i> แก้ไขข้อมูล</button>`;
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
                    console.log(response);
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
                        if (response.validator) {
                            var mes = "";
                            
                            if (response.validator.detail_category == "The detail_category field must contain a unique value.") {
                                mes += 'รายละเอียดต้องไม่ซ้ํา.' + '<br><hr/>'
                            }
                            if (response.validator.name_category == "The name_category field must contain a unique value.") {
                                mes += 'ชื่อหมวดหมู่ต้องไม่ซ้ํา.' + '<br><hr/>';
                            }
                            Swal.fire({
                                title: mes,
                                icon: 'error',
                                confirmButtonText: "ตกลง",
                                showConfirmButton: true,
                                width: '55%'
                            });
                        } else {
                            Swal.fire({
                                title: response.message,
                                icon: 'error',
                                showConfirmButton: true,
                                confirmButtonText: "ตกลง",
                            });
                        }
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
                                showConfirmButton: true,
                                confirmButtonText: "ตกลง",
                            });
                        }
                    });
                }
            });
        }
    </script>