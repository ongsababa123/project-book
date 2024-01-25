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
    <link rel="icon" href="<?= base_url('dist/img/icon/favicon.ico') ?>" type="image/gif">

</head>
<style>
    * {
        font-family: 'Kanit', sans-serif;
    }
</style>
<?php
$pice_total = 0;
$book_total = 0;
?>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <div class="container">
            <div class="row">
                <div class="col-3">
                </div>
                <div class="col-6">
                    <img src="<?= base_url('dist/img/logo11.png') ?>" alt="logo" width="100%">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="text-center font-weight-bold">ร้านหนังสือบางเล่ม</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h5 class="text-center">เลขที่ 2 ถนนนางลิ้นจี่ แขวงทุ่งมหาเมฆ เขตสาทร กรุงเทพฯ 10120</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <h5 class="text-center font-weight-bold">เลขผู้เสียภาษี </h5>
                            <h5 class="text-center ml-1">1234568790</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <h5 class="text-center font-weight-bold">เบอร์โทร </h5>
                            <h5 class="text-center ml-1">0987654278</h5>
                        </div>
                    </div>
                    <hr class="border border-dark">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="font-weight-bold">ใบกำกับภาษีอย่างย่อ/</h5>
                            <h5 class="font-weight-bold">ใบเสร็จรับเงิน</h5>
                        </div>
                        <div class="col-6">
                            <h5 class="font-weight-bold text-right">วันที่</h5>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <h5 class="">
                                BL-
                                <?= $data_history[0]['id_history'] ?>
                            </h5>
                        </div>
                        <div class="col-6">
                            <h5 class="text-right">
                                <?= date('d/m/Y') ?>
                            </h5>
                        </div>
                    </div>
                    <hr class="border border-dark">
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td class="text-left border-0" width="5%">
                                            ลำดับ
                                        </td>
                                        <td class="text-left border-0">
                                            รหัสหนังสือ
                                        </td>
                                        <td class="text-left border-0">
                                            ชื่อหนังสือ
                                        </td>
                                        <td class="text-right border-0">
                                            ราคาเช่า
                                        </td>
                                    </tr>
                                    <?php $data_history_values = explode(',', $data_history[0]['id_book']); ?>
                                    <?php foreach ($data_history_values as $index => $element): ?>
                                        <?php $filtered_books = array_filter($data_book, function ($value_book) use ($element) {
                                            return $value_book['id_book'] === $element;
                                        });
                                        $matching_book = reset($filtered_books);
                                        $pice_total = $pice_total + $matching_book['price'];
                                        $book_total = $book_total + 1;
                                        ?>
                                        <tr>
                                            <td class="text-left border-0" width="5%">
                                                <?= $index + 1 ?>
                                            </td>
                                            <td class="text-left border-0">
                                                <?= $data_history[0]['stock'][$index]['id_number_'] ?>
                                            </td>
                                            <td class="text-left border-0">
                                                <?= $matching_book['name_book'] ?>
                                            </td>
                                            <td class="text-right border-0">
                                                <?= $matching_book['price'] ?> บาท
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="border border-dark">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="text-left">
                                รวม
                                <?= $book_total ?> รายการ
                            </h5>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row text-center">
                        <div class="col-4">
                        </div>
                        <!-- /.col -->
                        <div class="col-8">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="text-right">
                                        ราคาเช่ารวม
                                    </h5>
                                </div>
                                <div class="col-6">
                                    <h5 class="text-right">
                                        <?= $data_history[0]['sum_rental_price'] ?>.00
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="text-right">
                                        ส่วนลดรวม
                                    </h5>
                                </div>
                                <div class="col-6">
                                    <h5 class="text-right">
                                        <?php if ($data_history[0]['id_promotion'] === null): ?>
                                            <?php if ($data_history[0]['sum_price_promotion'] === null || $data_history[0]['sum_price_promotion'] === '0'): ?>
                                                ไม่มีส่วนลด
                                            <?php else: ?>
                                                <?= $data_history[0]['sum_price_promotion'] ?>.00
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?= $data_history[0]['sum_price_promotion'] ?>.00
                                        <?php endif; ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="text-right">
                                        ค่ามัดจำรวม
                                    </h5>
                                </div>
                                <div class="col-6">
                                    <h5 class="text-right">
                                        <?= $data_history[0]['sum_deposit_price'] ?>.00
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="text-right">
                                        มูลค่าทั้งหมด
                                    </h5>
                                </div>
                                <div class="col-6">
                                    <h5 class="text-right border-bottom border-dark">
                                        <?= ($data_history[0]['sum_deposit_price']) + ($data_history[0]['sum_rental_price'] - $data_history[0]['sum_price_promotion'] ?? 0) ?>.00
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="text-right">
                                        ยอดรวมสุทธิ
                                    </h5>
                                </div>
                                <div class="col-6">
                                    <h5 class="text-right border-bottom border-dark">
                                        <?= ($data_history[0]['sum_deposit_price']) + ($data_history[0]['sum_rental_price'] - $data_history[0]['sum_price_promotion'] ?? 0) ?>.00
                                    </h5>
                                    <h5 class="text-right border-bottom border-dark"></h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="text-right">
                                        ค่าปรับหนังสือ
                                    </h5>
                                </div>
                                <div class="col-6">
                                    <h5 class="text-right">
                                        <?php if ($data_history[0]['sum_book_des_price'] === null): ?>
                                            0.00
                                        <?php else: ?>
                                            <?= $data_history[0]['sum_book_des_price'] ?>.00
                                        <?php endif; ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="text-right">
                                        ค่าปรับเกินกำหนด
                                    </h5>
                                </div>
                                <div class="col-6">
                                    <h5 class="text-right">
                                        <?php if ($data_history[0]['sum_day_late_price'] === null): ?>
                                            0.00
                                        <?php else: ?>
                                            <?= $data_history[0]['sum_day_late_price'] ?>.00
                                        <?php endif; ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="text-right">
                                        ค่าปรับเกินกำหนด
                                    </h5>
                                </div>
                                <div class="col-6">
                                    <h5 class="text-right border-bottom border-dark">
                                        <?php if ($data_history[0]['sum_late_price'] === null): ?>
                                            0.00
                                        <?php else: ?>
                                            <?= $data_history[0]['sum_late_price'] ?>.00
                                        <?php endif; ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="text-right">
                                        รวมคาปรับทั้งสิ้น
                                    </h5>
                                </div>
                                <div class="col-6">
                                    <h5 class="text-right border-bottom border-dark">
                                        <?= ($data_history[0]['sum_book_des_price']) + ($data_history[0]['sum_day_late_price'] + $data_history[0]['sum_late_price'] ?? 0) ?>.00
                                    </h5>
                                    <h5 class="text-right border-bottom border-dark"></h5>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <br>
                    <!-- accepted payments column -->
                    <div class="col-12 text-center">
                        <div class="row text-center">
                            <div class="col-12">
                                <img src="<?= base_url('dist/img/promptpay.png') ?>" width="40%" alt="Visa">
                            </div>
                            <?php 
                            $price_sum_rental = ($data_history[0]['sum_deposit_price']) + ($data_history[0]['sum_rental_price'] - $data_history[0]['sum_price_promotion'] ?? 0);
                            $price_sum_late = ($data_history[0]['sum_book_des_price']) + ($data_history[0]['sum_day_late_price'] + $data_history[0]['sum_late_price'] ?? 0);
                            $total_price = $price_sum_rental + $price_sum_late;
                            ?>
                            <div class="col-12">
                                <div style="position: relative; text-align: center;">
                                    <img src="https://promptpay.io/0972654762/<?= ($total_price) ?>.00.png"
                                        alt="QR Code" style="max-width: 100%; max-height: 100%; display: inline-block;">
                                    <div
                                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                        <img src="<?= base_url('dist/img/logo1.png') ?>" alt="logo" width="50%">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                            โปรดตรวจสอบยอดชำระเงินทุกครั้งก่อนชำระเงิน
                        </p>
                    </div>
                </div>
                <div class="col-3">
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
        </div>
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
    console.log(data_history);
</script>

</html>