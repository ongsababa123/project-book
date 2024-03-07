<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>รายงานประวัติยอดเช่า</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="<?= base_url('dist/css/fontsgoogle.css'); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css'); ?>">
    <link rel="icon" href="<?= base_url('dist/img/icon/favicon.ico') ?>" type="image/gif">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        * {
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>


<body>
    <div class="wrapper">
        <!-- Main content -->
        <div class="row">
            <div class="col-12 text-center">
                <img src="<?= base_url('dist/img/logo11.png') ?>" alt="logo" width="50%">
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
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2>รายงานประวัติยอดเช่า</h2>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12 text-right pr-5">
                        <h5 id="text_date" name="text_date"></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-right pr-5">
                        <h5 id="text_today" name="text_today"></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h6>รายการประวัติ</h6>
                <br>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center" style="background-color: #86d9ab;">
                            <th>ลำดับบิลที่</th>
                            <th>หนังสือที่ยืม</th>
                            <th>ค่าเช่ารวมทั้งสิ้น</th>
                            <th>ค่ามัดจำรวมทั้งสิ้น</th>
                            <th>ส่วนลดโปรโมชั่นรวมทั้งสิ้น</th>
                            <th>ค่าปรับรวมทั้งสิ้น</th>
                            <th>รวมทั้งสิ้น</th>
                        </tr style="background-color: #86d9ab;">
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $sum_book = 0;
                        $all_sum_rental_price = 0;
                        $all_sum_deposit_price = 0;
                        $all_price_promotion = 0;
                        $all_late_price = 0;
                        $all_count_price_sum = 0;
                        ?>
                        <?php foreach ($history as $key => $value): ?>
                            <tr>
                                <td>
                                    <?= $count; ?>
                                </td>
                                <td>
                                    <?php $id_books = explode(',', $value['id_book']) ?>
                                    <?php $sum_book += count($id_books); ?>
                                    <?php foreach ($id_books as $key_book => $value_book): ?>
                                        <?php foreach ($book as $key_data_book => $value_data_book): ?>
                                            <?php if ($value_data_book['id_book'] == $value_book): ?>
                                                <?= $value_data_book['name_book']; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>

                                </td>
                                <td class="text-center">
                                    <?php $all_sum_rental_price += $value['sum_rental_price']; ?>
                                    <?= $value['sum_rental_price']; ?> บาท
                                </td>
                                <td class="text-center">
                                    <?php $all_sum_deposit_price += $value['sum_deposit_price']; ?>
                                    <?= $value['sum_deposit_price']; ?> บาท
                                </td>
                                <td class="text-center">
                                    <?php $all_price_promotion += $value['sum_price_promotion']; ?>
                                    <?= $value['sum_price_promotion']; ?> บาท
                                </td>
                                <td class="text-center">
                                    <?php $all_late_price += $value['late_price']; ?>
                                    <?= $value['late_price']; ?> บาท
                                </td>
                                <td class="text-center">
                                    <?php $all_count_price_sum += $value['count_price_sum']; ?>
                                    <?= $value['count_price_sum']; ?> บาท
                                </td>
                            </tr>
                            <?php $count++;
                        endforeach; ?>
                    </tbody>
                </table>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center" style="background-color: #86d9ab;">
                            <th>ประวัติทั้งหมด</th>
                            <th>จำนวนหนังสือที่เช่าทั้งหมด</th>
                            <th>ค่าเช่ารวมทั้งหมด</th>
                            <th>ค่ามัดจำรวมทั้งหมด</th>
                            <th>ส่วนลดโปรโมชั่นรวมทั้งหมด</th>
                            <th>ค่าปรับรวมทั้งหมด</th>
                            <th>รวมทั้งหมด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">
                                <?= $count - 1 ?>
                            </td>
                            <td class="text-center">
                                <?= $sum_book . ' เล่ม' ?>
                            </td>
                            <td class="text-center">
                                <?= $all_sum_rental_price . ' บาท' ?>
                            </td>
                            <td class="text-center">
                                <?= $all_sum_deposit_price . ' บาท' ?>
                            </td>
                            <td class="text-center">
                                <?= $all_price_promotion . ' บาท' ?>
                            </td>
                            <td class="text-center">
                                <?= $all_late_price . ' บาท' ?>
                            </td>
                            <td class="text-center">
                                <?= $all_count_price_sum . ' บาท' ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->

    <script>
        var book = <?php echo json_encode($book); ?>;
        var date = <?php echo json_encode($date); ?>;
        var type = <?php echo json_encode($type); ?>;
        var today = new Date();
        var formattedtoday = new Date(today).toLocaleDateString('th-TH', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        $("#text_today").text("ข้อมูลประจำวันที่ " + formattedtoday);

        if (type == 1) {
            var formattedDate = new Date(date).toLocaleDateString('th-TH', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            $("#text_date").text("รายงานยอดเช่าประจำวัน " + formattedDate);
        } else if (type == 2) {
            var formattedDate = new Date(date).toLocaleDateString('th-TH', {
                year: 'numeric',
                month: 'long',
            });
            $("#text_date").text("รายงานเดือน " + formattedDate);
        } else if (type == 3) {
            var formattedDate = new Date(date).toLocaleDateString('th-TH', {
                year: 'numeric',
            });
            $("#text_date").text("รายงานยอดเช่าปี " + formattedDate);
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <script>
        var type_load = <?php echo json_encode($type_load); ?>;
        if (type_load == 3) {
            var element = document.querySelector('.wrapper'); // ใช้ .wrapper เพราะเป็นคลาสที่ครอบ HTML ทั้งหมด
            // กำหนด margin และ scale
            var options = {
                filename: 'รายงานยอดขาย.pdf',
                margin: 4,
                scale: 1
            };

            // ใช้ html2pdf พร้อมกับ options
            html2pdf(element, options).then(() => {
                // เมื่อการดาวน์โหลด PDF เสร็จสิ้น
                window.close(); // ปิดหน้าต่างหลังจากดาวน์โหลดเสร็จ
            });
        } else if (type_load == 4) {
            window.addEventListener("load", window.print());
        }

    </script>
</body>

</html>