<title>ข้อมูลลูกค้า</title>
<style>
    #form_details_history {
        display: none;
    }

    #form_details_image {
        display: none;
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>ข้อมูลลูกค้า</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/dashboard/index'); ?>">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">ข้อมูลลูกค้า</li>
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
                            <div class="card-header">
                                <h2 class="card-title"></h2>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-block-tool btn-success btn-sm"
                                        data-toggle="modal" data-target="#modal-default"
                                        onclick="load_modal(1)">สร้างสมาชิก</button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="table_customer" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ชื่อ - นามสกุล</th>
                                                    <th>เบอร์ติดต่อ</th>
                                                    <th>อีเมล</th>
                                                    <th>จำนวนครั้งที่ยืม</th>
                                                    <th>สถานะบัญชี</th>
                                                    <th>สถานะการเช่า</th>
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
        <div id="CRUD_UserModal">
            <?= $this->include("modal/CRUD_UserModal"); ?>
        </div>
    </div>
    <script>
        function load_modal(load_check, data_encode) {
            CRUD_UserModal = document.getElementById("CRUD_UserModal");
            $(".modal-body #name").val('');
            $(".modal-body #last").val('');
            $(".modal-body #email").val('');
            $(".modal-body #phone").val('');
            $(".modal-body #password").val('');
            $('#showPassword').prop('checked', false);
            removeAlert();

            if (load_check == 1) {
                CRUD_UserModal.style.display = "block";
                $(".modal-header #title_modal").text("สร้างข้อมูลผู้ใช้");
                $(".modal-footer #submit").text("สร้างข้อมูลผู้ใช้");
                $(".modal-body #url_route").val("dashboard/customer/create/4");
                $("#password").prop("disabled", false);
                $('#changePasswordCheckbox').hide();
                $('#showPasswordCheckbox____').show();
                $('#customSwitch_status').hide();

            } else if (load_check == 2) {
                $('#customSwitch_status').show();
                CRUD_UserModal.style.display = "block";
                const rowData = JSON.parse(decodeURIComponent(data_encode));
                $("#password").prop("disabled", true);
                $('#changePasswordCheckbox').show();
                $('#showPasswordCheckbox____').hide();

                const customSwitch3 = $(".modal-body #customSwitch3");
                const labelCustomSwitch3 = $(".modal-body #LabelcustomSwitch3");

                labelCustomSwitch3.text(rowData.status_user == 1 ? "เปิดใช้งาน" : "แบล็คลิส");

                if (rowData.status_user == '1') {
                    customSwitch3.prop('checked', true);
                } else {
                    customSwitch3.prop('checked', false);
                }
                $(".modal-body #name").val(rowData.name);
                $(".modal-body #last").val(rowData.lastname);
                $(".modal-body #email").val(rowData.email_user);
                $(".modal-body #phone").val(rowData.phone);

                $(".modal-header #title_modal").text("แก้ไขข้อมูลผู้ใช้");
                $(".modal-footer #submit").text("แก้ไขข้อมูลผู้ใช้");
                $(".modal-body #url_route").val("dashboard/customer/edit/" + rowData.id_user);
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
            if ($.fn.DataTable.isDataTable('#table_customer')) {
                $('#table_customer').DataTable().destroy();
            }
            $('#table_customer').DataTable({
                "processing": $("#customer_Table .overlay").show(),
                "pageLength": 10,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?php echo site_url('dashboard/customer/getdata/4'); ?>",
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
                            return data.name;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.lastname;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.email_user;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.counthis;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            var status = data.status_user;
                            if (status == 1) {
                                return `<span class='badge bg-success'>ใช้งาน</span>`;
                            } else if (status == 0) {
                                return `<span class='badge bg-danger'>แบล็คลิส</span>`;
                            }
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            var status_rental = data.status_rental;
                            if (status_rental == 1) {
                                return `<span class='badge bg-primary'>ยังไม่มีการเช่า</span>`;
                            } else if (status_rental == 2) {
                                return `<span class='badge bg-info'>รอเข้ารับหนังสือ</span>`;
                            } else if (status_rental == 3) {
                                return `<span class='badge bg-warning'>กำลังเช่า</span>`;
                            } else if (status_rental == 4) {
                                return `<span class='badge bg-success'>คืนแล้ว</span>`;
                            }
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            const encodedRowData = encodeURIComponent(JSON.stringify(row));
                            var check_count = '';
                            if (data.counthis == 0) {
                                check_count = 'disabled';
                            }
                            return `<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default" onclick="load_modal(2,'${encodedRowData}')"><i class="fas fa-user-edit"></i> แก้ไขข้อมูล</button>
                            <a href="<?= site_url('dashboard/history/history/user/') ?>${data.id_user}" target="_blank" class="btn btn-info ${check_count}"><i class="fas fa-info-circle"></i> ประวัติการเช่า</a>`;
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
                            allowOutsideClick: true
                        });
                        setTimeout(() => {
                            if (response.reload) {
                                window.location.reload();
                            }
                        }, 2000);
                    } else {
                        if (response.validator) {
                            var mes = "";
                            if (response.validator.email === "The email field must contain a valid email address.") {
                                mes += 'ช่องอีเมลจะต้องมีที่อยู่อีเมลที่ถูกต้อง.' + '<br><hr/>'
                            }
                            if (response.validator.email === "The email field must contain a unique value.") {
                                mes += 'อีเมลนี้ถูกสมัครสมาชิกแล้ว' + '<br><hr/>'
                            }
                            if (response.validator.name) {
                                mes += 'ชื่อต้องมีอย่างน้อย 2 ตัว.' + '<br><hr/>';
                            }
                            if (response.validator.last) {
                                mes += 'นามสกุลต้องมีอย่างน้อย 2 ตัว.' + '<br><hr/>';
                            }
                            if (response.validator.phone === "The phone field must contain only numbers.") {
                                mes += 'เบอร์ติดต่อต้องมีเฉพาะตัวเลขเท่านั้น.' + '<br>';
                            }
                            if (response.validator.phone === "The phone field must be at least 10 characters in length.") {
                                mes += 'เบอร์ติดต่อต้องมี 10 หลัก.' + '<br>';
                            }
                            if (response.validator.phone === "The phone field cannot exceed 10 characters in length.") {
                                mes += 'เบอร์ติดต่อต้องมีไม่เกิน 10 หลัก.' + '<br>';
                            }
                            Swal.fire({
                                title: mes,
                                icon: 'error',
                                showConfirmButton: true,
                                width: '55%',
                                confirmButtonText: 'ตกลง',
                            });
                        } else {
                            Swal.fire({
                                title: response.message,
                                icon: 'error',
                                confirmButtonText: 'ตกลง',
                                showConfirmButton: true
                            });
                        }
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        title: "เกิดข้อผิดพลาด",
                        icon: 'error',
                        confirmButtonText: 'ตกลง',
                        showConfirmButton: true
                    });
                }
            });
        }
    </script>