<title>ประวัติการเช่า</title>
<link rel="stylesheet" href="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.css'); ?>">
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url('plugins/daterangepicker/daterangepicker.css'); ?>">
<!-- Tempusdominus Bootstrap 4 -->
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('plugins/select2/css/select2.min.css'); ?>">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?= base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
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
                                                            onclick="getTableData_('dashboard/history/getdata/2', 'table_history_two', '0')">กำลังเช่า</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="custom-tabs-one-messages-tab"
                                                            data-toggle="pill" href="#custom-tabs-one-messages"
                                                            role="tab"
                                                            onclick="getTableData_('dashboard/history/getdata/3', 'table_history_three', '0')"
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
        function load_modal(load_check, data_encode, type) {
            var data_book = <?php echo json_encode($data_book); ?>;
            var data_category = <?php echo json_encode($data_category); ?>;
            var data_user = <?php echo json_encode($data_user); ?>;
            var data_latefees = <?php echo json_encode($data_latefees); ?>;
            var data_promotion = <?php echo json_encode($data_promotion); ?>;
            var data_dayrent = <?php echo json_encode($data_dayrent); ?>;

            Read_History = document.getElementById("Read_History");
            Create_History = document.getElementById("Create_History");
            $(".modal-body #book_des_price").val('');
            $(".modal-body #day_late_price").val('');
            $(".modal-body #sum_late_price").val('');
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
                        var newOption = $('<option>').val(element_book_cr.id_book).text(element_book_cr.name_book + ' ราคาเช่า : ' + element_book_cr.price + ' บาท' + ' | ราคาหนังสือ : ' + element_book_cr.price_book + ' บาท |' + ' [สต๊อก : ' + element_book_cr.count_stock + ']');
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
                $(".modal-footer #submit").text("อัพเดทข้อมูล");
                $("#formContainer").empty();
                $("#formImageContainer").empty();
                Read_History.style.display = "block";
                Create_History.style.display = "none";
                const rowData = JSON.parse(decodeURIComponent(data_encode));
                //ส่วนของหนังสือ
                let count = 0;
                let count_id = 0;
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
                    clonedForm.find("#price_rental_book").attr("id", "price_rental_book_" + id.trim()).val(matbook.price);
                    clonedForm.find("#price_book").attr("id", "price_book_" + id.trim()).val(matbook.price_book);
                    clonedForm.find("#code_book_stock").attr("id", "code_book_stock_" + id.trim()).val(rowData.stock[count_id].id_number_);
                    const status = rowData.stock[count_id].status_stock;
                    data_id_ = rowData.stock[count_id].id_stock + "_" + id.trim();
                    clonedForm.find("#answer_1").attr("id", "2_" + data_id_).attr("name", "r" + rowData.stock[count_id].id_stock).prop('checked', status == 2 || status == 1 || status == 0);
                    clonedForm.find("#answer_2").attr("id", "3_" + data_id_).attr("name", "r" + rowData.stock[count_id].id_stock).prop('checked', status == 3);
                    clonedForm.find("#answer_3").attr("id", "4_" + data_id_).attr("name", "r" + rowData.stock[count_id].id_stock).prop('checked', status == 4);
                    clonedForm.find("#answer_4").attr("id", "5_" + data_id_).attr("name", "r" + rowData.stock[count_id].id_stock).prop('checked', status == 5);
                    clonedForm.find("#label_answer_1").attr("id", "label_answer_1_" + id.trim()).attr("for", "2_" + data_id_).val();
                    clonedForm.find("#label_answer_2").attr("id", "label_answer_2_" + id.trim()).attr("for", "3_" + data_id_).val();
                    clonedForm.find("#label_answer_3").attr("id", "label_answer_3_" + id.trim()).attr("for", "4_" + data_id_).val();
                    clonedForm.find("#label_answer_4").attr("id", "label_answer_4_" + id.trim()).attr("for", "5_" + data_id_).val();
                    clonedForm.find("#text_book_description").attr("id", "text_book_description_" + data_id_).attr("name", "text_book_description_" + data_id_).val(rowData.stock[count_id].description ?? "");
                    clonedForm.find("#price_book_destroy").attr("id", "price_book_destroy_" + data_id_).attr("name", "price_book_destroy_" + data_id_);

                    if (status == 4) {
                        clonedForm.find("#text_book_description_" + data_id_).show();
                    } else {
                        clonedForm.find("#text_book_description_" + data_id_).hide();
                    }
                    $("#formImageContainer").append(clonedImage);
                    $("#formContainer").append(clonedForm);
                    clonedForm.show();
                    cal_book_destory(matbook.price_book, status, function (result_price_book_des) {
                        $(".modal-body #price_book_destroy_" + data_id_).val(result_price_book_des);
                    });
                    count_id += 1;

                    if (rowData.status_his == 2) {
                        $(".modal-footer #print").show();
                        $(".modal-footer #submit_bill").show();
                        $(".modal-footer #submit_inbook").hide();
                        $("#text_book_description_" + data_id_).prop("disabled", false);
                        $(".modal-body .score-radio, #return_date, #sum_late_price, #sum_price_promotion").prop("disabled", false);
                    } else if (rowData.status_his == 3) {
                        $(".modal-footer #print").show();
                        $(".modal-footer #submit_bill").hide();
                        $(".modal-footer #submit_inbook").hide();
                        $(".modal-body .score-radio, #return_date, #sum_late_price, #sum_price_promotion").prop("disabled", true);
                        $("#text_book_description_" + data_id_).prop("disabled", true);
                    } else {
                        $(".modal-footer #print").hide();
                        $(".modal-footer #submit_bill").hide();
                        $(".modal-footer #submit_inbook").show();
                        $(".modal-body .score-radio, #return_date, #sum_late_price, #sum_price_promotion").prop("disabled", false);
                        $("#text_book_description_" + data_id_).prop("disabled", false);
                    }
                });
                //end ส่วนหนังสือ
                //ส่วน ชื่่อผู้ยืม
                var matuser = data_user.find(element_user => element_user.id_user === rowData.id_user);
                $(".modal-body #name_user").val(matuser.name + ' ' + matuser.lastname);
                // end ชื่อผู้ยืม

                $(".modal-body #rental_date").val(rowData.rental_date); //วันที่ยืม
                //วันที่ต้องคืน
                $(".modal-body #return_date").val(rowData.return_date);
                var rental_date = moment(rowData.rental_date, 'YYYY-MM-DD');
                var minDate = rental_date.add(1, 'days');
                $('#return_date__').datetimepicker({
                    format: 'YYYY-MM-DD',
                    minDate: minDate,
                    maxDate: moment(rental_date - 1).add(data_dayrent[0].day_rent, 'days').format('YYYY-MM-DD'),
                });
                // end วันที่ต้องคืน
                //วันที่มาคืน
                $(".modal-body #label_return_date").text("");
                if (rowData.submit_date == null) {
                    calculate_distance_day(rowData.return_date, function (result_distance_day) {
                        if (result_distance_day > 0) {
                            $(".modal-body #label_return_date").text("จำนวนวันที่เกินมา : " + result_distance_day + " วัน");
                            calculate_price_late__(data_latefees[0]['price_fees'], result_distance_day, function (result_price) {
                                $(".modal-body #day_late_price").val(result_price); //ค่าปรับเกินกำหนด
                            })
                        }
                    });
                }else{
                    $(".modal-body #submit_date").val(rowData.submit_date); //ค่าปรับเกินกำหนด

                    $(".modal-body #day_late_price").val(rowData.sum_day_late_price); //ค่าปรับเกินกำหนด
                    $(".modal-body #book_des_price").val(rowData.sum_book_des_price); //ค่าปรับหนังสือ
                }
                // end วันที่มาคืน
                //ค่าปรับอื่นๆ
                if (rowData.sum_late_price == null) {
                    $(".modal-body #sum_late_price").val("");
                } else {
                    $(".modal-body #sum_late_price").val(rowData.late_price);
                }
                // end ค่าปรับอื่นๆ
                //ส่วนลดโปรโมชั่น
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
                $("#text_promotion").html(text_promotion); //text รายละเอียดโปรโมชั่น
                if (rowData.sum_price_promotion) {
                    $(".modal-body #sum_price_promotion").val(rowData.sum_price_promotion);
                } else {
                    $(".modal-body #sum_price_promotion").val('ไม่มีส่วนลด');
                }
                // end ส่วนลดโปรโมชั่น
                $(".modal-body #sum_rental_price").val(rowData.sum_rental_price);  // ราคาเช่าหนังสือ
                $(".modal-body #sum_deposit_price").val(rowData.sum_deposit_price);// ราคาค่ามัดจำ
                //ราคาค่าปรับ
                if (rowData.sum_late_price == null) {
                    $(".modal-body #sum_late_price").val();
                } else {
                    $(".modal-body #sum_late_price").val(rowData.sum_late_price);
                }
                // end ราคาค่าปรับ
                var sum_rental_price = parseInt($(".modal-body #sum_rental_price").val()) || 0;
                var sum_deposit_price = parseInt($(".modal-body #sum_deposit_price").val()) || 0;
                var sum_price_promotion = parseInt($(".modal-body #sum_price_promotion").val()) || 0;
                var sum_late_price = parseInt($(".modal-body #sum_late_price").val()) || 0;
                var day_late_price = parseInt($(".modal-body #day_late_price").val()) || 0;
                var total_price = ((sum_rental_price + sum_deposit_price) - sum_price_promotion);
                var total_price_all = (total_price + sum_late_price) + day_late_price;
                $(".modal-body #total_price").val(total_price);
                $(".modal-body #total_price_all").val(total_price_all);


                $(".modal-body #url_route").val("dashboard/history/edit/edit_history/" + rowData.id_history);
                $(".modal-body #id_history").val(rowData.id_history);
                $(".modal-body #id_user").val(rowData.id_user);
                $(".modal-body #print").prop("href", "billview/" + rowData.id_history);
                updateTotalPrice();
            }
        }
    </script>
    <script>
        $(document).ready(function () {
            getTableData_('dashboard/history/getdata/1', 'table_history_one', '0');
        });
    </script>
    <script>
        var check_table_ = 0;
        function getTableData_(url, table_name, reloadtable) {
            if (check_table_ == 0 || check_table_ == 1 || check_table_ == 2 || reloadtable == 1) {
                check_table_++;
                var data_user = <?php echo json_encode($data_user); ?>;
                var data_book = <?php echo json_encode($data_book); ?>;
                var data_latefees = <?php echo json_encode($data_latefees); ?>;

                if ($.fn.DataTable.isDataTable('#' + table_name)) {
                    $('#' + table_name).DataTable().destroy();
                }
                $("#history_Table .overlay").show()
                $('#' + table_name).DataTable({
                    "processing": true,
                    "pageLength": 10,
                    "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                    'serverSide': true,
                    'ajax': {
                        'url': "<?php echo base_url(''); ?> " + url,
                        'type': 'GET',
                        'dataSrc': 'data',
                    },
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "ordering": false,
                    "lengthChange": false,
                    "autoWidth": false,
                    "searching": true,
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
                                var check_date;
                                if (data.status_his == '1') {
                                    calculate_distance_day(data.rental_date, function (result_distance_day) {
                                        if (result_distance_day > 0) {
                                            check_date = true
                                        } else {
                                            check_date = false
                                        }
                                    });
                                    if (check_date == true) {
                                        return "<span class='badge bg-danger'>เกินกำหนดวันรับ</span>";
                                    } else {
                                        return "<span class='badge bg-info'>รอเข้ารับ</span>"
                                    }
                                    return "<span class='badge bg-info'>รอเข้ารับ</span>"
                                } else if (data.status_his == '2') {
                                    calculate_distance_day(data.return_date, function (result_distance_day) {
                                        if (result_distance_day > 0) {
                                            check_date = true
                                        } else {
                                            check_date = false
                                        }
                                    });
                                    if (check_date == true) {
                                        return "<span class='badge bg-danger'>เกินกำหนด</span>"
                                    } else {
                                        return "<span class='badge bg-warning'>กำลังยืม</span>"
                                    }
                                } else if (data.status_his == '3') {
                                    return "<span class='badge bg-success'>คืนแล้ว</span>"
                                }
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function (data, type, row, meta) {
                                const matchingUser = data_user.find(element => data.id_user === element.id_user);
                                const encodedRowData = encodeURIComponent(JSON.stringify(row));
                                if (data.status_his === '1') {
                                    return `
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default" onclick="load_modal(2,'${encodedRowData}')">
                                            <i class="fas fa-info-circle"></i> ประวัติการเช่า
                                        </button>
                                        <button type="button" class="btn btn-danger" name="cancelhis" id="cancelhis" onclick="confirm_Alert('ต้องการยกเลิกการเช่าใช่หรือไม่', 'dashboard/history/cancel/${data.id_history}')" <?= $type_hideen ?>>
                                            <i class="fas fa-store-slash"></i>
                                        </button>
                                    `;
                                } else if (data.status_his === '2' || data.status_his === '3') {
                                    if (data.submit_date == null) {
                                        return `<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default" onclick="load_modal(2,'${encodedRowData}')"><i class="fas fa-info-circle"></i> ประวัติการเช่า</button>
                                                <button type="button" class="btn btn-danger" name="cancelhis" id="cancelhis" onclick="confirm_Alert('ต้องการยกเลิกการเช่าใช่หรือไม่', 'dashboard/history/cancel/${data.id_history}')" <?= $type_hideen ?>><i class="fas fa-store-slash"></i></button>`;
                                    } else {
                                        return `<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default" onclick="load_modal(2,'${encodedRowData}')"><i class="fas fa-info-circle"></i> ประวัติการเช่า</button>`;
                                    }
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
                        if (response.button) {
                            Swal.fire({
                                title: response.message,
                                icon: 'success',
                                confirmButtonText: "ตกลง",
                                showConfirmButton: true,
                                allowOutsideClick: true
                            });
                            if (response.status_his == '1') {
                                getTableData_('dashboard/history/getdata/1', 'table_history_one', '1')
                            } else if (response.status_his == '2') {
                                getTableData_('dashboard/history/getdata/2', 'table_history_two', '1')
                            }
                        } else {
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
                    } else {
                        Swal.fire({
                            title: response.message,
                            icon: 'error',
                            confirmButtonText: "ตกลง",
                            showConfirmButton: true
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