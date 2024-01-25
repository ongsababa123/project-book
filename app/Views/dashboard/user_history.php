<title>ประวัติการเช่า</title>
<link rel="stylesheet" href="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.css'); ?>">


<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>ประวัติการเช่าของ
                            <?= $data_user[0]['name'] . ' ' . $data_user[0]['lastname'] ?>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/dashboard/index'); ?>">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">
                                <?= $data_user[0]['name'] . ' ' . $data_user[0]['lastname'] ?>
                            </li>
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
                        <div class="card" id="history_user">
                            <div class="card-header">
                                <h2 class="card-title"></h2>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php foreach ($data_history as $key => $value): ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <?php if ($value['status_his'] == '1'): ?>
                                                    <div class="card-header bg-lightblue">
                                                    <?php elseif ($value['status_his'] == '2'): ?>
                                                        <?php
                                                        date_default_timezone_set('Asia/Bangkok'); // ตั้งค่าโซนเวลา
                                                        $today = strtotime(date("Y-m-d")); // รับวันที่ปัจจุบันและแปลงเป็น timestamp
                                                        $today = strtotime("midnight", $today); // ตั้งค่าเวลาเป็นเที่ยงคืน
                                                        $returnDate = strtotime($value['return_date']); // รับวันที่คืนและแปลงเป็น timestamp
                                                        $returnDate = strtotime("midnight", $returnDate); // ตั้งค่าเวลาเป็นเที่ยงคืน
                                                        ?>
                                                        <?php if ($value['submit_date'] == null): ?>
                                                            <?php if ($today > $returnDate): ?>
                                                                <div class="card-header bg-danger">
                                                                    <span class='badge bg-info'>เกินกำหนด</span>
                                                                <?php else: ?>
                                                                    <div class="card-header bg-warning">
                                                                        <span class='badge bg-info'>กำลังเช่า</span>
                                                                    <?php endif ?>
                                                                <?php endif ?>
                                                            <?php elseif ($value['status_his'] == '3'): ?>
                                                                <div class="card-header bg-success">
                                                                    <span class='badge bg-info'>คืนแล้ว</span>
                                                                <?php endif; ?>
                                                                <h3 class="card-title">รายการเช่าที่
                                                                    <?= $key + 1 ?>
                                                                </h3>
                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool"
                                                                        data-card-widget="collapse">
                                                                        <i class="fas fa-minus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <?php $data_history_values = explode(',', $value['id_book']); ?>
                                                                <?php foreach ($data_history_values as $index => $element): ?>
                                                                    <?php
                                                                    $filtered_books = array_filter($data_book, function ($value_book) use ($element) {
                                                                        return $value_book['id_book'] === $element;
                                                                    });
                                                                    $matching_book = reset($filtered_books);

                                                                    $filtered_category = array_filter($data_category, function ($value_category) use ($matching_book) {
                                                                        return $value_category['id_category'] === $matching_book['category_id'];
                                                                    });
                                                                    $matching_category = reset($filtered_category);
                                                                    ?>
                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <div class="form-group">
                                                                                <label>ชื่อหนังสือ</label>
                                                                                <p>
                                                                                    <?= $matching_book['name_book'] ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <label>รหัสหนังสือ</label>
                                                                            <p>
                                                                                <?= $value['stock'][$index]['id_number_'] ?>
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <div class="form-group">
                                                                                <label>ชื่อผู้แต่ง</label>
                                                                                <p>
                                                                                    <?= $matching_book['book_author'] ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <div class="form-group">
                                                                                <label>หมวดหมู่</label>
                                                                                <p>
                                                                                    <?= $matching_category['name_category'] ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <div class="form-group">
                                                                                <label>ราคาเช่า</label>
                                                                                <p>
                                                                                    <?= $matching_book['price'] ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <div class="form-group">
                                                                                <label>ราคาหนังสือ</label>
                                                                                <p>
                                                                                    <?= $matching_book['price_book'] ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                <?php endforeach; ?>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <label for="">ข้อมูลการเช่า</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        <div class="form-group">
                                                                            <label>ราคาเช่ารวม</label>
                                                                            <p>
                                                                                <?= $value['sum_rental_price'] ?? '-' ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <div class="form-group">
                                                                            <label>ค่ามัดจำ</label>
                                                                            <p>
                                                                                <?= $value['sum_deposit_price'] ?? '-' ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group">
                                                                            <label>ส่วนลดโปรโมชั่น</label>
                                                                            <p>
                                                                                <?= $value['sum_price_promotion'] ?? '-' ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <?php $price_all = ($value['sum_rental_price'] + $value['sum_deposit_price']) - $value['sum_price_promotion']; ?>
                                                                    <div class="col-sm-1">
                                                                        <div class="form-group">
                                                                            <label>รวมสุทธิ</label>
                                                                            <p>
                                                                                <?= $price_all ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-1"></div>
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group">
                                                                            <label>วันที่เช่า</label>
                                                                            <p>
                                                                                <?= $value['rental_date'] ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group">
                                                                            <label>วันที่ต้องคืน</label>
                                                                            <p>
                                                                                <?= $value['return_date'] ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group">
                                                                            <label>วันที่มาคืน</label>
                                                                            <p>
                                                                                <?= $value['submit_date'] ?? '-' ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        <div class="form-group">
                                                                            <label>ค่าปรับหนังสือ</label>
                                                                            <p>
                                                                                <?= $value['sum_book_des_price'] ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-1"></div>
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group">
                                                                            <label>ค่าปรับเกินกำหนด</label>
                                                                            <p>
                                                                                <?= $value['sum_day_late_price'] ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group">
                                                                            <label>ค่าปรับอื่นๆ</label>
                                                                            <p>
                                                                                <?= $value['sum_late_price'] ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <?php $sum_late = ($value['sum_day_late_price'] + $value['sum_late_price']) + $value['sum_book_des_price']; ?>
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group">
                                                                            <label>รวมค่าปรับ</label>
                                                                            <p>
                                                                                <?= $sum_late ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <?php if ($value['status_his'] == 2 || $value['status_his'] == 3): ?>
                                                                        <div class="col-sm-1">
                                                                            <div class="form-group">
                                                                                <a class="btn btn-app bg-danger mt-3"
                                                                                    href="<?= base_url('dashboard/history/billview/' . $value['id_history']) ?>"
                                                                                    target="_blank">
                                                                                    <i class="fas fa-print"></i>
                                                                                    พิมพ์ใบเสร็จ</a>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
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
    <?= $this->include("calculate"); ?>
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
        var data_history = <?php echo json_encode($data_history); ?>;
        console.log(data_history);
        var data_user = <?php echo json_encode($data_user); ?>;
        var data_book = <?php echo json_encode($data_book); ?>;
        var data_category = <?php echo json_encode($data_category); ?>;
    </script>
    <script>
        $(document).ready(function () {
            $("#history_user .overlay").hide();
        });
    </script>
    <script>
        function showAlert() {
            Swal.fire({
                icon: 'warning',
                title: 'แจ้งเตือน',
                text: 'กรุณาคืนหนังสือก่อนพิมพ์ใบเสร็จ',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง'
            });
        }
    </script>