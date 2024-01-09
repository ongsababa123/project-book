<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ใบเสร็จ</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="<?= base_url('dist/css/fontsgoogle.css'); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css'); ?>">
    <link rel="icon" href="<?=base_url('dist/img/icon/favicon.ico')?>" type="image/gif">

</head>
<style>
    * {
        font-family: 'Kanit', sans-serif;
    }
</style>
<?php
$pice_total = 0;
?>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <img src="<?= base_url('dist/img/logo11.png') ?>" alt="logo" width="30%">
                        <small class="float-right">วันที่พิมพ์:
                            <?= date('Y/m/d') ?>
                        </small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    ข้อมูลผู้เช่า
                    <address>
                        <strong>
                            <?= $data_user[0]['name'] . ' ' . $data_user[0]['lastname'] ?>
                        </strong><br>
                        Phone:
                        <?= $data_user[0]['phone'] ?><br>
                        Email:
                        <?= $data_user[0]['email_user'] ?>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Order ID:</b>
                    <?= $data_history[0]['id_history'] ?><br>
                    <b>วันที่ยืม </b>
                    <?= $data_history[0]['rental_date'] ?><br>
                    <b>วันที่ต้องคืน </b>
                    <?= $data_history[0]['return_date'] ?><br>
                    <b>วันที่คืน </b>
                    <?= $data_history[0]['submit_date'] ?>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ชื่อหนังสือ</th>
                                <th>ชื่อผู้แต่ง</th>
                                <th>รหัสหนังสือ #</th>
                                <th>ราคา</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $data_history_values = explode(',', $data_history[0]['id_book']); ?>
                            <?php foreach ($data_history_values as $index => $element): ?>
                                <?php $filtered_books = array_filter($data_book, function ($value_book) use ($element) {
                                    return $value_book['id_book'] === $element;
                                });
                                $matching_book = reset($filtered_books);
                                $pice_total = $pice_total + $matching_book['price']
                                    ?>
                                <tr>
                                    <td>
                                        <?= $index + 1 ?>
                                    </td>
                                    <td>
                                        <?= $matching_book['name_book'] ?>
                                    </td>
                                    <td>
                                        <?= $matching_book['book_author'] ?>
                                    </td>
                                    <td>
                                        <?= $matching_book['id_book'] ?>
                                    </td>
                                    <td>
                                        <?= $matching_book['price'] ?> บาท
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row text-center">
                <!-- accepted payments column -->
                <div class="col-6">
                    <p class="lead ">สแกนจ่ายเลย!! (พร้อมเพย์)</p>
                    <div class="row text-center">
                        <div class="col-12">
                            <img src="<?= base_url('dist/img/promptpay.png') ?>" width="40%" alt="Visa">
                        </div>
                        <div class="col-12">
                            <div style="position: relative; text-align: center;">
                                <img src="https://promptpay.io/0972654762/<?= $data_history[0]['sum_price'] + $data_history[0]['late_price'] ?>.png"
                                    alt="QR Code" style="max-width: 100%; max-height: 100%; display: inline-block;">
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                    <img src="<?= base_url('dist/img/logo1.png') ?>" alt="logo" width="50%">

                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        โปรดตรวจสอบยอดชำระเงินทุกครั้งก่อนชำระเงิน
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <p class="lead">รายละเอียดชำระเงิน</p>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">ราคารวม:</th>
                                <td>
                                    <?= $data_history[0]['sum_price'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>ค่าปรับ:</th>
                                <td>
                                    <?php if ($data_history[0]['late_price'] === null): ?>
                                        ไม่มีค่าปรับ
                                    <?php else: ?>
                                        <?= $data_history[0]['late_price'] ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>ส่วนลดโปรโมชั่น</th>
                                <td>
                                    <?php if ($data_history[0]['id_promotion'] === null): ?>
                                        <?php if ($data_history[0]['sum_price_promotion'] === null || $data_history[0]['sum_price_promotion'] === '0'): ?>
                                            ไม่มีส่วนลด
                                        <?php else: ?>
                                            <?= $data_history[0]['sum_price_promotion'] ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?= $data_history[0]['sum_price_promotion'] ?>
                                    <?php endif; ?>

                                </td>
                            </tr>
                            <tr>
                                <th>ยอดรวม:</th>
                                <td>
                                    <?= ($data_history[0]['sum_price'] + $data_history[0]['late_price']) - $data_history[0]['sum_price_promotion'] ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>
<script>
    var data_history = <?php echo json_encode($data_history); ?>;
    var data_user = <?php echo json_encode($data_user); ?>;
    var data_book = <?php echo json_encode($data_book); ?>;
    var data_category = <?php echo json_encode($data_category); ?>;
</script>

</html>