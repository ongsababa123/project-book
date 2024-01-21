<title>การตั้งค่าระบบ</title>
<?php 
if(session()->get('type') == '2'){
    $hidden = '';
}else{
    $hidden = 'hidden';
}
?>
<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>การตั้งค่าระบบ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/dashboard/index'); ?>">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">การตั้งค่าระบบ</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="card" id="late-price_Table">
                            <div class="card-header bg-maroon">
                                <h2 class="card-title">ราคาค่าปรับ</h2>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-dark" onclick="enable_edit(1,1)" <?= $hidden ?>>
                                        แก้ไขข้อมูลค่าปรับ
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <form class="mb-3" id="form_price_late" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>อัตราค่าปรับ</label>
                                                <input type="text" class="form-control" placeholder="ราคาค่าปรับ" id="late_price" name="late_price" value="<?= $late_fees[0]['price_fees']; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center" id="btn_price_late">
                                    <button type="submit" class="btn btn-success" name="submit" value="Submit" id="submit">บันทึก</button>
                                    <button type="button" class="btn btn-danger" onclick="enable_edit(1,2)">ยกเลิก</button>
                                </div>
                            </form>
                            <div class="overlay dark">
                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card" id="late-price_Table">
                            <div class="card-header bg-lightblue">
                                <h2 class="card-title">ระยะเวลาเช่าหนังสือ</h2>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-dark" onclick="enable_edit(2,1)" <?= $hidden ?>>
                                        แก้ไขระยะเวลาเช่าหนังสือ
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <form class="mb-3" id="form_day" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>จำนวนวันที่สามารถเช่าได้ หน่วย/ต่อวัน</label>
                                                <input type="text" class="form-control" placeholder="ระยะเวลาเช่าหนังสือ" id="day_rent" name="day_rent" value="<?= $dayrent[0]['day_rent']; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center" id="btn_day">
                                    <button type="submit" class="btn btn-success" name="submit" value="Submit" id="submit">บันทึก</button>
                                    <button type="button" class="btn btn-danger" onclick="enable_edit(2,2)">ยกเลิก</button>
                                </div>
                            </form>
                            <div class="overlay dark">
                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card" id="late-price_Table">
                            <div class="card-header bg-info">
                                <h2 class="card-title">รายละเอียด</h2>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-default" onclick="load_modal(1)" <?= $hidden ?>>
                                        เพิ่มรายละเอียด
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="table_late-price" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>จำนวนค่าปรับ (/วัน)</th>
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
        <div id="CRUD_Details">
            <?= $this->include("modal/CRUD_Details"); ?>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            getTableData();
            $("#btn_price_late").hide();
            $("#btn_day").hide();
            $("#late_price").prop("disabled", true);
            $("#day_rent").prop("disabled", true);
        });
        
        $("#form_price_late").on('submit', function(e) {
            e.preventDefault();
            const urlRouteInput = 'dashboard/setting/lateprice/edit/1';
            action_(urlRouteInput, 'form_price_late');
        });

        $("#form_day").on('submit', function(e) {
            e.preventDefault();
            const urlRouteInput = 'dashboard/setting/dayrent/edit/1';
            action_(urlRouteInput, 'form_day');
        });
    </script>
    <script>
        function load_modal(load_check, data_encode) {
            CRUD_Details = document.getElementById("CRUD_Details");
            if (load_check == 1) {
                CRUD_Details.style.display = "block";
                $(".modal-body #detail").empty();
                $(".modal-header #title_modal").text("เพิ่มรายละเอียด");
                $(".modal-footer #submit").text("เพิ่มรายละเอียด");
                $(".modal-body #url_route").val("dashboard/setting/details/create");
            } else if (load_check == 2) {
                CRUD_Details.style.display = "block";
                const rowData = JSON.parse(decodeURIComponent(data_encode));

                $(".modal-body #detail").val(rowData.text_details);
                $(".modal-header #title_modal").text("แก้ไขรายละเอียด");
                $(".modal-footer #submit").text("แก้ไขรายละเอียด");
                $(".modal-body #url_route").val("dashboard/setting/details/edit/" + rowData.id_details);
            }
        }
    </script>
    <script>
        function enable_edit(type, action) {
            // Update action to '1' if it is 'edit'
            action = (action === 'edit') ? '1' : action;

            var targetElement;
            var targetInputElement;

            if (type == 1) {
                targetElement = $("#btn_price_late");
                targetInputElement = $("#late_price");
            } else if (type == 2) {
                targetElement = $("#btn_day");
                targetInputElement = $("#day_rent");
            }

            // Use the ternary operator to determine the action for targetElement
            targetElement[action == '1' ? 'show' : 'hide']();

            // Use the ternary operator to determine the action for targetInputElement
            if (action == '1') {
                targetInputElement.prop('disabled', false);
            } else {
                targetInputElement.prop('disabled', true);
            }
        }
    </script>
    <script>
        function getTableData() {
            if ($.fn.DataTable.isDataTable('#table_late-price')) {
                $('#table_late-price').DataTable().destroy();
            }
            $('#table_late-price').DataTable({
                "processing": $("#admin_Table .overlay").show(),
                "pageLength": 10,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?php echo site_url('dashboard/setting/getdata'); ?>",
                    'type': 'GET',
                    'dataSrc': 'data',
                },
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "ordering": false,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false,
                "drawCallback": function(settings) {
                    $("#late-price_Table .overlay").hide();
                    var daData = settings.json.data;
                    if (daData.length == 0) {
                        $('#table_late-price tbody').html(`
                        <tr>
                            <td colspan="8" class="text-center">
                                ยังไม่มีข้อมูล
                            </td>
                        </tr>`);
                    }
                },
                'columns': [{
                        'data': null,
                        'class': 'text-center',
                        'render': function(data, type, row, meta) {
                            return meta.settings.oAjaxData.start += 1;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function(data, type, row, meta) {
                            return data.text_details;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function(data, type, row, meta) {
                            const encodedRowData = encodeURIComponent(JSON.stringify(row));
                            <?php if (session()->get('type') == '2') : ?>
                                return `<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default" onclick="load_modal(2,'${encodedRowData}')"> แก้ไขข้อมูล</button>
                            <button type="button" class="btn btn-danger" onclick="confirm_Alert('คุณต้องการลบรายการนี้ใช่หรือไม่ ?','dashboard/setting/details/delete/${data.id_details}')"> ลบ</button>`;
                            <?php else : ?>
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
                beforeSend: function() {
                    // Show loading indicator here
                    var loadingIndicator = Swal.fire({
                        title: 'กําลังดําเนินการ...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
                },
                success: function(response) {
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
                            title: "เกิดข้อผิดพลาด",
                            icon: 'error',
                            confirmButtonText: "ตกลง",
                            showConfirmButton: true
                        });
                    }
                },
                error: function(xhr, status, error) {
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
                        beforeSend: function() {
                            // Show loading indicator here
                            var loadingIndicator = Swal.fire({
                                title: 'กําลังดําเนินการ...',
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                                showConfirmButton: false,
                            });
                        },
                    }).done(function(response) {
                        // console.log(response);
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