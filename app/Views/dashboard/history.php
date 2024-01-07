<title>ประวัติการเช่า</title>
<link rel="stylesheet" href="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.css'); ?>">
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url('plugins/daterangepicker/daterangepicker.css'); ?>">
<!-- Tempusdominus Bootstrap 4 -->
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('plugins/select2/css/select2.min.css'); ?>">
<link rel="stylesheet"
    href="<?= base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
<style>
    #form_thebook {
        display: none;
    }

    #image_thebook {
        display: none;

    }
</style>
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
                        <h1>ประวัติการเช่า</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/dashboard/index'); ?>">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">ประวัติการเช่า</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card" id="history_Table">
                            <div class="card-header">
                                <h2 class="card-title"></h2>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-block-tool btn-success btn-sm"
                                        data-toggle="modal" data-target="#modal-default"
                                        onclick="load_modal(1)">สร้างข้อมูลเช่าหนังสือ</button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="card card-navy card-tabs">
                                            <div class="card-header p-0 pt-1">
                                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="custom-tabs-one-home-tab"
                                                            data-toggle="pill" href="#custom-tabs-one-home" role="tab"
                                                            aria-controls="custom-tabs-one-home"
                                                            aria-selected="true">รอเข้ารับ</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="custom-tabs-one-profile-tab"
                                                            data-toggle="pill" href="#custom-tabs-one-profile"
                                                            role="tab" aria-controls="custom-tabs-one-profile"
                                                            aria-selected="false"
                                                            onclick="getTableData_two()">กำลังเช่า</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="custom-tabs-one-messages-tab"
                                                            data-toggle="pill" href="#custom-tabs-one-messages"
                                                            role="tab" onclick="getTableData_three()"
                                                            aria-controls="custom-tabs-one-messages"
                                                            aria-selected="false">คืนแล้ว</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                                    <div class="tab-pane fade show active" id="custom-tabs-one-home"
                                                        role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table id="table_history_one" class="table table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ลำดับ</th>
                                                                            <th>ชื่อ - นามสกุล</th>
                                                                            <th>เบอร์ติดต่อ</th>
                                                                            <th>อีเมล</th>
                                                                            <th>ชื่อหนังสือ</th>
                                                                            <th>วันที่ยืม</th>
                                                                            <th>วันที่ต้องคืน</th>
                                                                            <th>วันที่คืน</th>
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
                                                    <div class="tab-pane fade" id="custom-tabs-one-profile"
                                                        role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table id="table_history_two" class="table table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ลำดับ</th>
                                                                            <th>ชื่อ - นามสกุล</th>
                                                                            <th>เบอร์ติดต่อ</th>
                                                                            <th>อีเมล</th>
                                                                            <th>ชื่อหนังสือ</th>
                                                                            <th>วันที่ยืม</th>
                                                                            <th>วันที่ต้องคืน</th>
                                                                            <th>วันที่คืน</th>
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
                                                    <div class="tab-pane fade" id="custom-tabs-one-messages"
                                                        role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table id="table_history_three"
                                                                    class="table table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ลำดับ</th>
                                                                            <th>ชื่อ - นามสกุล</th>
                                                                            <th>เบอร์ติดต่อ</th>
                                                                            <th>อีเมล</th>
                                                                            <th>ชื่อหนังสือ</th>
                                                                            <th>วันที่ยืม</th>
                                                                            <th>วันที่ต้องคืน</th>
                                                                            <th>วันที่คืน</th>
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
                                                </div>
                                            </div>
                                            <div class="overlay dark" id="overlay" name="overlay">
                                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                            </div>
                                        </div>
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
        <div id="Read_History">
            <?= $this->include("modal/Read_History"); ?>
        </div>
        <div id="Create_History">
            <?= $this->include("modal/Create_History"); ?>
        </div>
    </div>
    <?= $this->include("calculate"); ?>
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
        function load_modal(load_check, data_encode) {
            var data_book = <?php echo json_encode($data_book); ?>;
            var data_category = <?php echo json_encode($data_category); ?>;
            var data_user = <?php echo json_encode($data_user); ?>;
            var data_latefees = <?php echo json_encode($data_latefees); ?>;
            var data_promotion = <?php echo json_encode($data_promotion); ?>;

            Read_History = document.getElementById("Read_History");
            Create_History = document.getElementById("Create_History");

            if (load_check == 1) {
                $(".modal-body #name_book_create").empty();
                $(".modal-body #name_user_create").empty();
                $(".modal-body #rental_date_create").val('');
                $(".modal-body #return_date_create").val('');
                $(".modal-body #price_book").val('');

                Read_History.style.display = "none";
                Create_History.style.display = "block";
                $(".modal-footer #submit").prop("disabled", false);

                data_book.forEach(element_book_cr => {
                    if (element_book_cr.status_book == 1) {
                        var newOption = $('<option>').val(element_book_cr.id_book).text(element_book_cr.name_book + ' ราคาเช่า : ' + element_book_cr.price);
                        $(".modal-body #name_book_create").append(newOption);
                    }
                });

                data_user.forEach(element_user_cr => {
                    if (element_user_cr.status_rental == 1 && element_user_cr.type_user == 4) {
                        var newOption = $('<option>').val(element_user_cr.id_user).text(element_user_cr.name + ' ' + element_user_cr.lastname);
                        $(".modal-body #name_user_create").append(newOption);
                    }
                });

                $(".modal-header #title_modal").text("สร้างข้อมูลเช่าหนังสือ");
                $(".modal-footer #submit").text("สร้างข้อมูลเช่าหนังสือ");
                $(".modal-body #url_route").val("dashboard/history/create");
            } else if (load_check == 2) {

                $(".modal-header #title_modal").text("แก้ไขข้อมูลประวัติ");
                $(".modal-footer #submit").text("แก้ไขข้อมูลประวัติ");
                $("#formContainer").empty();
                $("#formImageContainer").empty();
                Read_History.style.display = "block";
                Create_History.style.display = "none";
                // $(".modal-body #form_thebook").hide();
                const rowData = JSON.parse(decodeURIComponent(data_encode));

                let count = 0;
                let idbook = rowData.id_book.split(',');
                idbook.forEach(function (id) {
                    count += 1;
                    let matbook = data_book.find(element_book => element_book.id_book === id.trim());
                    let matcategory = data_category.find(element_category => element_category.id_category === matbook.category_id);
                    let clonedForm = $("#form_thebook").clone();
                    let clonedImage = $("#image_thebook").clone();
                    clonedImage.attr("id", "image_thebook_" + id.trim());

                    if (matbook.pic_book == null) {
                        var imageSrc = '<?= base_url("dist/img/image-preview.png"); ?>';
                    } else {
                        var imageSrc = "data:image/png;base64," + matbook.pic_book;
                    }
                    clonedForm.attr("id", "form_thebook_" + id.trim());

                    clonedImage.find("#image-preview").attr("id", "image-preview_" + id.trim(), "src", imageSrc).attr("src", imageSrc);
                    clonedImage.find("#image-preview-extra").attr("id", "image-preview-extra_" + id.trim()).attr("href", imageSrc);

                    clonedForm.find("#labelbook").attr("id", "labelbook_" + id.trim()).text("หนังสือเล่มที่ " + count);
                    clonedForm.find("#name_book").attr("id", "name_book_" + id.trim()).val(matbook.name_book);
                    clonedForm.find("#name_book_author").attr("id", "name_book_author_" + id.trim()).val(matbook.book_author);
                    clonedForm.find("#categorySelect").attr("id", "categorySelect_" + id.trim()).val(matcategory.name_category);
                    $("#formImageContainer").append(clonedImage);
                    $("#formContainer").append(clonedForm);
                    clonedForm.show();
                });
                var text_promotion = '';

                if (rowData.id_promotion == null) {
                    text_promotion = 'ไม่มีโปรโมชั่น';
                } else {
                    let id_promotion = rowData.id_promotion.split(',');
                    data_promotion.forEach(element_promotion => {
                        id_promotion.forEach(function (id_pro) {
                            if (element_promotion.id_promotion == id_pro) {
                                text_promotion += element_promotion.details + '<br>';
                            }
                        });
                    });
                }
                $("#text_promotion").html(text_promotion);

                if (rowData.sum_price_promotion) {
                    $(".modal-body #pice_promotion").val(rowData.sum_price_promotion);
                } else {
                    $(".modal-body #pice_promotion").val('ไม่มีส่วนลด');
                }

                var matuser = data_user.find(element_user => element_user.id_user === rowData.id_user);
                $(".modal-body #name_user").val(matuser.name + ' ' + matuser.lastname);
                $(".modal-body #rental_date").val(rowData.rental_date);
                $(".modal-body #return_date").val(rowData.return_date);
                $(".modal-body #price_book").val(rowData.sum_price);
                var rental_date = moment(rowData.rental_date, 'YYYY-MM-DD');
                var minDate = rental_date.add(7, 'days');
                $('#return_date__').datetimepicker({
                    format: 'YYYY-MM-DD',
                    minDate: minDate,
                });
                var today = new Date(); // Get the current date
                today.setHours(0, 0, 0, 0)
                var returnDate = new Date(rowData.return_date);
                returnDate.setHours(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0
                if (rowData.submit_date == null) {
                    $(".modal-body #print").hide();

                    if (rowData.late_price === '0' || rowData.late_price == null) {
                        $(".modal-footer #submit").prop("disabled", false);
                        $(".modal-body #return_date").prop("disabled", false);
                        $(".modal-body #submit_date").val("ยังไม่มีการคืน");
                        $(".modal-body #pice_promotion").prop("disabled", false);
                        $(".modal-body #price_late").prop("disabled", false);
                        if (today > returnDate) {

                            var price_fees = data_latefees[0]['price_fees'];
                            calculate_price_late(idbook.length, price_fees, returnDate, function (result_price) {
                                $(".modal-body #price_late").val(result_price);
                            });
                        } else {
                            $(".modal-body #price_late").val("ไม่มีค่าปรับ");
                        }
                    } else {
                        $(".modal-body #price_late").val(rowData.late_price);
                    }

                } else {
                    $(".modal-body #print").show();
                    $(".modal-footer #submit").prop("disabled", true);
                    $(".modal-body #return_date").prop("disabled", true);
                    $(".modal-body #pice_promotion").prop("disabled", true);
                    $(".modal-body #price_late").prop("disabled", true);
                    $(".modal-body #submit_date").val(rowData.submit_date);
                    if (rowData.late_price == null) {
                        $(".modal-body #price_late").val("ไม่มีค่าปรับ");
                    } else {
                        $(".modal-body #price_late").val(rowData.late_price);
                    }
                }
                var priceBook = parseInt($(".modal-body #price_book").val()) || 0;
                var priceLate = parseInt($(".modal-body #price_late").val()) || 0;
                var promotionPrice = parseInt($(".modal-body #pice_promotion").val()) || 0;
                var sumPriceAll = priceBook + priceLate - promotionPrice;
                $(".modal-body #sum_price_all").val(sumPriceAll);

                $(".modal-body #url_route").val("dashboard/history/edit/edit_history/" + rowData.id_history);
                $(".modal-body #print").prop("href", "billview/" + rowData.id_history);

            }

        }
    </script>
    <script>
        $(document).ready(function () {
            getTableData_one();
        });
    </script>
    <script>
        function getTableData_one() {
            var data_user = <?php echo json_encode($data_user); ?>;
            var data_book = <?php echo json_encode($data_book); ?>;
            var data_latefees = <?php echo json_encode($data_latefees); ?>;

            if ($.fn.DataTable.isDataTable('#table_history_one')) {
                $('#table_history_one').DataTable().destroy();
            }
            $('#table_history_one').DataTable({
                "processing": $("#history_Table .overlay").show(),
                "pageLength": 10,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?php echo site_url('dashboard/history/getdata/1'); ?>",
                    'type': 'GET',
                    'dataSrc': 'data',
                },
                "responsive": true,
                "ordering": false,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false,
                "drawCallback": function (settings) {
                    $("#history_Table .overlay").hide();
                    var daData = settings.json.data;
                    if (daData.length == 0) {
                        $('#table_history_one tbody').html(`
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
                            const matchingUser = data_user.find(element => data.id_user === element.id_user);
                            if (matchingUser) {
                                return matchingUser.name + ' ' + matchingUser.lastname;
                            } else {
                                return 'ไม่มีชื่อ';
                            }
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            const matchingUser = data_user.find(element => data.id_user === element.id_user);
                            if (matchingUser) {
                                return matchingUser.phone;
                            } else {
                                return 'ไม่มีชื่อ';
                            }
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            const matchingUser = data_user.find(element => data.id_user === element.id_user);
                            if (matchingUser) {
                                return matchingUser.email_user;
                            } else {
                                return 'ไม่มีชื่อ';
                            }
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            var text = '';
                            data_book.forEach(element => {
                                var idUserArray = data.id_book.split(',');
                                idUserArray.forEach(function (id) {
                                    if (element.id_book == id.trim()) {
                                        text += element.name_book + ' , ' + '<br>'
                                    }
                                });
                            });
                            return text;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.rental_date;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.return_date;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            if (data.submit_date == null) {
                                return "ยังไม่คืน";
                            } else {
                                return data.submit_date;
                            }
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            var today = new Date(); // Get the current date
                            today.setHours(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0
                            if (data.status_his === '1') {
                                return "<span class='badge bg-info'>รอเข้ารับ</span>"
                            } else if (data.status_his === '2') {
                                if (data.submit_date === null) {
                                    var returnDate = new Date(data.return_date);
                                    returnDate.setHours(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0
                                    if (today > returnDate) {
                                        return "<span class='badge bg-danger'>เกินกำหนด</span>";
                                    } else {
                                        return "<span class='badge bg-warning'>กำลังยืม</span>";
                                    }
                                } else {
                                    return "<span class='badge bg-success'>คืนแล้ว</span>";
                                }
                            } else {
                                return "<span class='badge bg-danger'>เกินกำหนดวันรับ</span>";
                            }
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            const matchingUser = data_user.find(element => data.id_user === element.id_user);
                            const encodedRowData = encodeURIComponent(JSON.stringify(row));
                            var today = new Date();
                            today.setHours(0, 0, 0, 0)
                            var returnDate = new Date(data.return_date);
                            returnDate.setHours(0, 0, 0, 0);
                            if (data.status_his === '1') {
                                return `
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default" onclick="load_modal(2,'${encodedRowData}')">
                                            <i class="fas fa-info-circle"></i> ประวัติการเช่า
                                        </button>
                                        <button type="button" class="btn btn-success" name="submit_bill" id="submit_bill" onclick="confirm_Alert('ยืนยันการเข้าหนังสือรับใช่หรือไม่', 'dashboard/history/update_status_his/${data.id_history}')">
                                            <i class="far fa-calendar-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" name="cancelhis" id="cancelhis" onclick="confirm_Alert('ต้องการยกเลิกการเช่าใช่หรือไม่', 'dashboard/history/cancel/${data.id_history}')" <?= $type_hideen ?>>
                                            <i class="fas fa-store-slash"></i>
                                        </button>
                                    `;
                            } else if (data.status_his === '2') {
                                if (data.submit_date == null) {
                                    if (data.late_price != null) {
                                        var price_fess_totel = data.late_price;
                                    } else {
                                        if (today > returnDate) {
                                            var returnDate = new Date(data.return_date);
                                            var currentDate = new Date();
                                            // หาความแตกต่างในวัน
                                            var timeDifference = currentDate.getTime() - returnDate.getTime();
                                            var daysDifference = Math.ceil((timeDifference / (1000 * 60 * 60 * 24)) - 1);
                                            var price_fees = data_latefees[0]['price_fees'];
                                            var price_fess_totel = daysDifference * price_fees;
                                        } else {
                                            var price_fess_totel = 0;
                                        }
                                    }
                                    return `<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default" onclick="load_modal(2,'${encodedRowData}')"><i class="fas fa-info-circle"></i> ประวัติการเช่า</button>
                                <button type="button" class="btn btn-success" name="submit_bill" id="submit_bill" onclick="confirm_Alert('ยืนยันการคืนใช่หรือไม่', 'dashboard/history/submit/${data.id_history}/${price_fess_totel}/${data.id_user}')" ><i class="fas fa-check"></i></button>
                            <button type="button" class="btn btn-danger" name="cancelhis" id="cancelhis" onclick="confirm_Alert('ต้องการยกเลิกการเช่าใช่หรือไม่', 'dashboard/history/cancel/${data.id_history}')" <?= $type_hideen ?>><i class="fas fa-store-slash"></i></button>`;
                                } else {
                                    return `<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default" onclick="load_modal(2,'${encodedRowData}')"><i class="fas fa-info-circle"></i> ประวัติการเช่า</button>`;
                                }
                            } else {
                                return ``;
                            }
                        }
                    },
                ]
            });
            $('[data-toggle="tooltip"]').tooltip();
        }
    </script>
    <script>
        var check_table_two = 0;
        function getTableData_two() {
            if (check_table_two == 0) {
                check_table_two = 1;
                var data_user = <?php echo json_encode($data_user); ?>;
                var data_book = <?php echo json_encode($data_book); ?>;
                var data_latefees = <?php echo json_encode($data_latefees); ?>;

                if ($.fn.DataTable.isDataTable('#table_history_two')) {
                    $('#table_history_two').DataTable().destroy();
                }
                $('#table_history_two').DataTable({
                    "processing": $("#history_Table .overlay").show(),
                    "pageLength": 10,
                    "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                    'serverSide': true,
                    'ajax': {
                        'url': "<?php echo site_url('dashboard/history/getdata/2'); ?>",
                        'type': 'GET',
                        'dataSrc': 'data',
                    },
                    "responsive": true,
                    "ordering": false,
                    "lengthChange": false,
                    "autoWidth": false,
                    "searching": false,
                    "drawCallback": function (settings) {
                        $("#history_Table .overlay").hide();
                        var daData = settings.json.data;

                        if (daData.length == 0) {
                            $('#table_history_two tbody').html(`
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
                                const matchingUser = data_user.find(element => data.id_user === element.id_user);
                                if (matchingUser) {
                                    return matchingUser.name + ' ' + matchingUser.lastname;
                                } else {
                                    return 'ไม่มีชื่อ';
                                }
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function (data, type, row, meta) {
                                const matchingUser = data_user.find(element => data.id_user === element.id_user);
                                if (matchingUser) {
                                    return matchingUser.phone;
                                } else {
                                    return 'ไม่มีชื่อ';
                                }
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function (data, type, row, meta) {
                                const matchingUser = data_user.find(element => data.id_user === element.id_user);
                                if (matchingUser) {
                                    return matchingUser.email_user;
                                } else {
                                    return 'ไม่มีชื่อ';
                                }
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function (data, type, row, meta) {
                                var text = '';
                                data_book.forEach(element => {
                                    var idUserArray = data.id_book.split(',');
                                    idUserArray.forEach(function (id) {
                                        if (element.id_book == id.trim()) {
                                            text += element.name_book + ' , ' + '<br>'
                                        }
                                    });
                                });
                                return text;
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function (data, type, row, meta) {
                                return data.rental_date;
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function (data, type, row, meta) {
                                return data.return_date;
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function (data, type, row, meta) {
                                if (data.submit_date == null) {
                                    return "ยังไม่คืน";
                                } else {
                                    return data.submit_date;
                                }
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function (data, type, row, meta) {
                                var today = new Date(); // Get the current date
                                today.setHours(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0
                                if (data.status_his === '1') {
                                    return "<span class='badge bg-info'>รอเข้ารับ</span>"
                                } else if (data.status_his === '2') {
                                    if (data.submit_date === null) {
                                        var returnDate = new Date(data.return_date);
                                        returnDate.setHours(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0
                                        if (today > returnDate) {
                                            return "<span class='badge bg-danger'>เกินกำหนด</span>";
                                        } else {
                                            return "<span class='badge bg-warning'>กำลังยืม</span>";
                                        }
                                    } else {
                                        return "<span class='badge bg-success'>คืนแล้ว</span>";
                                    }
                                } else {
                                    return "<span class='badge bg-danger'>เกินกำหนดวันรับ</span>";
                                }
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function (data, type, row, meta) {
                                const matchingUser = data_user.find(element => data.id_user === element.id_user);
                                const encodedRowData = encodeURIComponent(JSON.stringify(row));
                                var today = new Date();
                                today.setHours(0, 0, 0, 0)
                                var returnDate = new Date(data.return_date);
                                returnDate.setHours(0, 0, 0, 0);
                                if (data.status_his === '1') {
                                    return `
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default" onclick="load_modal(2,'${encodedRowData}')">
                                            <i class="fas fa-info-circle"></i> ประวัติการเช่า
                                        </button>
                                        <button type="button" class="btn btn-success" name="submit_bill" id="submit_bill" onclick="confirm_Alert('ยืนยันการเข้าหนังสือรับใช่หรือไม่', 'dashboard/history/update_status_his/${data.id_history}')">
                                            <i class="far fa-calendar-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" name="cancelhis" id="cancelhis" onclick="confirm_Alert('ต้องการยกเลิกการเช่าใช่หรือไม่', 'dashboard/history/cancel/${data.id_history}')" <?= $type_hideen ?>>
                                            <i class="fas fa-store-slash"></i>
                                        </button>
                                    `;
                                } else if (data.status_his === '2') {
                                    if (data.submit_date == null) {
                                        if (data.late_price != null) {
                                            var price_fess_totel = data.late_price;
                                        } else {
                                            if (today > returnDate) {
                                                var returnDate = new Date(data.return_date);
                                                var currentDate = new Date();
                                                // หาความแตกต่างในวัน
                                                var timeDifference = currentDate.getTime() - returnDate.getTime();
                                                var daysDifference = Math.ceil((timeDifference / (1000 * 60 * 60 * 24)) - 1);
                                                var price_fees = data_latefees[0]['price_fees'];
                                                var price_fess_totel = daysDifference * price_fees;
                                            } else {
                                                var price_fess_totel = 0;
                                            }
                                        }
                                        return `<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default" onclick="load_modal(2,'${encodedRowData}')"><i class="fas fa-info-circle"></i> ประวัติการเช่า</button>
                                <button type="button" class="btn btn-success" name="submit_bill" id="submit_bill" onclick="confirm_Alert('ยืนยันการคืนใช่หรือไม่', 'dashboard/history/submit/${data.id_history}/${price_fess_totel}/${data.id_user}')" ><i class="fas fa-check"></i></button>
                            <button type="button" class="btn btn-danger" name="cancelhis" id="cancelhis" onclick="confirm_Alert('ต้องการยกเลิกการเช่าใช่หรือไม่', 'dashboard/history/cancel/${data.id_history}')" <?= $type_hideen ?>><i class="fas fa-store-slash"></i></button>`;
                                    } else {
                                        return `<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default" onclick="load_modal(2,'${encodedRowData}')"><i class="fas fa-info-circle"></i> ประวัติการเช่า</button>`;
                                    }
                                } else {
                                    return ``;
                                }
                            }
                        },
                    ]
                });
                $('[data-toggle="tooltip"]').tooltip();
            }
        }
    </script>
    <script>
        var check_table_three = 0;
        function getTableData_three() {
            if (check_table_three == 0) {
                check_table_three = 1;
                var data_user = <?php echo json_encode($data_user); ?>;
                var data_book = <?php echo json_encode($data_book); ?>;
                var data_latefees = <?php echo json_encode($data_latefees); ?>;

                if ($.fn.DataTable.isDataTable('#table_history_three')) {
                    $('#table_history_three').DataTable().destroy();
                }
                $('#table_history_three').DataTable({
                    "processing": $("#history_Table .overlay").show(),
                    "pageLength": 10,
                    "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                    'serverSide': true,
                    'ajax': {
                        'url': "<?php echo site_url('dashboard/history/getdata/3'); ?>",
                        'type': 'GET',
                        'dataSrc': 'data',
                    },
                    "responsive": true,
                    "ordering": false,
                    "lengthChange": false,
                    "autoWidth": false,
                    "searching": false,
                    "drawCallback": function (settings) {
                        $("#history_Table .overlay").hide();
                        var daData = settings.json.data;

                        if (daData.length == 0) {
                            $('#table_history_three tbody').html(`
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
                                const matchingUser = data_user.find(element => data.id_user === element.id_user);
                                if (matchingUser) {
                                    return matchingUser.name + ' ' + matchingUser.lastname;
                                } else {
                                    return 'ไม่มีชื่อ';
                                }
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function (data, type, row, meta) {
                                const matchingUser = data_user.find(element => data.id_user === element.id_user);
                                if (matchingUser) {
                                    return matchingUser.phone;
                                } else {
                                    return 'ไม่มีชื่อ';
                                }
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function (data, type, row, meta) {
                                const matchingUser = data_user.find(element => data.id_user === element.id_user);
                                if (matchingUser) {
                                    return matchingUser.email_user;
                                } else {
                                    return 'ไม่มีชื่อ';
                                }
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function (data, type, row, meta) {
                                var text = '';
                                data_book.forEach(element => {
                                    var idUserArray = data.id_book.split(',');
                                    idUserArray.forEach(function (id) {
                                        if (element.id_book == id.trim()) {
                                            text += element.name_book + ' , ' + '<br>'
                                        }
                                    });
                                });
                                return text;
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function (data, type, row, meta) {
                                return data.rental_date;
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function (data, type, row, meta) {
                                return data.return_date;
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function (data, type, row, meta) {
                                if (data.submit_date == null) {
                                    return "ยังไม่คืน";
                                } else {
                                    return data.submit_date;
                                }
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function (data, type, row, meta) {
                                var today = new Date(); // Get the current date
                                today.setHours(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0
                                if (data.status_his === '1') {
                                    return "<span class='badge bg-info'>รอเข้ารับ</span>"
                                } else if (data.status_his === '2') {
                                    if (data.submit_date === null) {
                                        var returnDate = new Date(data.return_date);
                                        returnDate.setHours(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0
                                        if (today > returnDate) {
                                            return "<span class='badge bg-danger'>เกินกำหนด</span>";
                                        } else {
                                            return "<span class='badge bg-warning'>กำลังยืม</span>";
                                        }
                                    } else {
                                        return "<span class='badge bg-success'>คืนแล้ว</span>";
                                    }
                                } else if (data.status_his === '3') {
                                    return "<span class='badge bg-success'>คืนแล้ว</span>";

                                } else {
                                    return "<span class='badge bg-danger'>เกินกำหนดวันรับ</span>";
                                }
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function (data, type, row, meta) {
                                const matchingUser = data_user.find(element => data.id_user === element.id_user);
                                const encodedRowData = encodeURIComponent(JSON.stringify(row));
                                var today = new Date();
                                today.setHours(0, 0, 0, 0)
                                var returnDate = new Date(data.return_date);
                                returnDate.setHours(0, 0, 0, 0);
                                if (data.status_his === '1') {
                                    return `
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default" onclick="load_modal(2,'${encodedRowData}')">
                                            <i class="fas fa-info-circle"></i> ประวัติการเช่า
                                        </button>
                                        <button type="button" class="btn btn-success" name="submit_bill" id="submit_bill" onclick="confirm_Alert('ยืนยันการเข้าหนังสือรับใช่หรือไม่', 'dashboard/history/update_status_his/${data.id_history}')">
                                            <i class="far fa-calendar-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" name="cancelhis" id="cancelhis" onclick="confirm_Alert('ต้องการยกเลิกการเช่าใช่หรือไม่', 'dashboard/history/cancel/${data.id_history}')" <?= $type_hideen ?>>
                                            <i class="fas fa-store-slash"></i>
                                        </button>
                                    `;
                                } else if (data.status_his === '2' || data.status_his === '3') {
                                    if (data.submit_date == null) {
                                        if (data.late_price != null) {
                                            var price_fess_totel = data.late_price;
                                        } else {
                                            if (today > returnDate) {
                                                var returnDate = new Date(data.return_date);
                                                var currentDate = new Date();
                                                // หาความแตกต่างในวัน
                                                var timeDifference = currentDate.getTime() - returnDate.getTime();
                                                var daysDifference = Math.ceil((timeDifference / (1000 * 60 * 60 * 24)) - 1);
                                                var price_fees = data_latefees[0]['price_fees'];
                                                var price_fess_totel = daysDifference * price_fees;
                                            } else {
                                                var price_fess_totel = 0;
                                            }
                                        }
                                        return `<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default" onclick="load_modal(2,'${encodedRowData}')"><i class="fas fa-info-circle"></i> ประวัติการเช่า</button>
                                <button type="button" class="btn btn-success" name="submit_bill" id="submit_bill" onclick="confirm_Alert('ยืนยันการคืนใช่หรือไม่', 'dashboard/history/submit/${data.id_history}/${price_fess_totel}/${data.id_user}')" ><i class="fas fa-check"></i></button>
                            <button type="button" class="btn btn-danger" name="cancelhis" id="cancelhis" onclick="confirm_Alert('ต้องการยกเลิกการเช่าใช่หรือไม่', 'dashboard/history/cancel/${data.id_history}')" <?= $type_hideen ?>><i class="fas fa-store-slash"></i></button>`;
                                    } else {
                                        return `<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default" onclick="load_modal(2,'${encodedRowData}')"><i class="fas fa-info-circle"></i> ประวัติการเช่า</button>`;
                                    }
                                } else {
                                    return ``;
                                }
                            }
                        },
                    ]
                });
                $('[data-toggle="tooltip"]').tooltip();
            }
        }
    </script>
    <script>
        function action_(url, form) {
            var formData = new FormData(document.getElementById(form));
            if (form == 'form_create_history') {
                formData.append('name_book_create__', $('#name_book_create').val());
                formData.append('sumid_promotion', $('#sumid_promotion').val());
            }
            $.ajax({
                url: '<?= base_url() ?>' + url,
                type: "POST",
                cache: false,
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function (response) {
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
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        title: "เกิดข้อผิดพลาด",
                        icon: 'error',
                        showConfirmButton: true
                    });
                }
            });
        }
    </script>
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
        function confirm_Alert(text, url) {
            Swal.fire({
                title: text,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                confirmButtonText: "submit",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>' + url,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }).done(function (response) {
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
                                showConfirmButton: true
                            });
                        }
                    });
                }
            });
        }
    </script>