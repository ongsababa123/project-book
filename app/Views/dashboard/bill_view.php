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
                                        <?php if (!empty($data_history[0]['data_promotion'])): ?>
                                            <?php if (!empty($data_history[0]['id_promotion'])): ?>
                                                <?php foreach ($data_history[0]['data_promotion'] as $index_pro => $element_pro): ?>
                                                    <?php
                                                    if ($element_pro['type_sale'] == '1') {
                                                        $text_pro = ' บาท';
                                                    } elseif ($element_pro['type_sale'] == '2') {
                                                        $text_pro = ' %';
                                                    }
                                                    ?>
                                                    <?php if ($element_pro['type_promotion'] == '1'): ?>
                                                        <?php if ($element_pro['id_book_cat'] == $matching_book['id_book']): ?>
                                                            <tr>
                                                                <td class="text-left border-0" width="5%">
                                                                </td>
                                                                <td class="text-left border-0">
                                                                </td>
                                                                <td class="text-left border-0">
                                                                    **ส่วนลดหนังสือ
                                                                </td>
                                                                <td class="text-right border-0">
                                                                    <?= $element_pro['number_cal'] . $text_pro ?>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php elseif ($element_pro['type_promotion'] == '2'): ?>
                                                        <?php if ($element_pro['id_book_cat'] == $matching_book['category_id']): ?>
                                                            <tr>
                                                                <td class="text-left border-0" width="5%">
                                                                </td>
                                                                <td class="text-left border-0">
                                                                </td>
                                                                <td class="text-left border-0">
                                                                    **ส่วนลดหมวดหมู่
                                                                </td>
                                                                <td class="text-right border-0">
                                                                    <?= $element_pro['number_cal'] . $text_pro ?>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="border border-dark">
                    <?php if (!empty($data_history[0]['data_promotion'])): ?>
                        <?php $check = 0 ?>
                        <?php if (!empty($data_history[0]['id_promotion'])): ?>
                            <?php foreach ($data_history[0]['data_promotion'] as $index_pro => $element_pro): ?>
                                <?php if ($element_pro['type_promotion'] != '1' && $element_pro['type_promotion'] != '2'): ?>
                                    <?php $check = 1 ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ($check == 1): ?>
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-left">
                                    โปรโมชั่นอื่นๆ
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td class="text-left border-0" width="5%">
                                                ลำดับ
                                            </td>
                                            <td class="text-left border-0" colspan="3">
                                                รายละเอียดโปรโมชั่น
                                            </td>
                                        </tr>
                                        <?php if (!empty($data_history[0]['data_promotion'])): ?>
                                            <?php foreach ($data_history[0]['data_promotion'] as $index_pro => $element_pro): ?>
                                                <?php if ($element_pro['type_promotion'] != '1' && $element_pro['type_promotion'] != '2'): ?>
                                                    <tr>
                                                        <td class="text-left border-0" width="5%">
                                                            <?= $index_pro + 1 ?>
                                                        </td>
                                                        <td class="text-left border-0" colspan="3">
                                                            <?= $element_pro['details'] ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr class="border border-dark">
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-12">
                            <h5 class="text-left">
                                รวม
                                <?= $book_total ?> รายการ
                            </h5>
                        </div>
                    </div>
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
                                    <h5 class="text-right border-bottom border-dark">
                                        <?= $data_history[0]['sum_deposit_price'] ?>.00
                                    </h5>
                                </div>
                            </div>
                            <?php $all_rental_price_sum = ($data_history[0]['sum_deposit_price']) + ($data_history[0]['sum_rental_price'] - $data_history[0]['sum_price_promotion'] ?? 0) ?>
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="text-right">
                                        ยอดรวม
                                    </h5>
                                </div>
                                <div class="col-6">
                                    <h5 class="text-right border-bottom border-dark">
                                        <?= $all_rental_price_sum ?>
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
                                        ค่าอื่นๆ
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
                            <?php $late_price_all_sum = ($data_history[0]['sum_book_des_price']) + ($data_history[0]['sum_day_late_price'] + $data_history[0]['sum_late_price'] ?? 0) ?>
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="text-right">
                                        ยอดรวมสุทธิ
                                    </h5>
                                </div>
                                <div class="col-6">
                                    <h5 class="text-right border-bottom border-dark">
                                        <?= $late_price_all_sum + $all_rental_price_sum ?>
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
                            <div class="col-12">
                                <div style="position: relative; text-align: center;">
                                    <img src="https://promptpay.io/0972654762/<?= ($late_price_all_sum + $all_rental_price_sum) ?>.00.png"
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
        <?php if (session()->get('type') == '1' || session()->get('type') == '2' || session()->get('type') == '3'): ?>
            window.addEventListener("load", window.print());
        <?php else: ?>
            document.addEventListener("contextmenu", function (e) {
                e.preventDefault();
            });

            document.addEventListener("keydown", function (e) {
                if (e.ctrlKey && (e.keyCode === 80 || e.keyCode === 85)) {
                    e.preventDefault();
                    alert("การพิมพ์หรือใช้คีย์ลัด Ctrl+P / Ctrl+U ถูกห้าม");
                }
            });
        <?php endif; ?>
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