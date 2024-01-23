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
                        <h2>รายงานยอดเช่า</h2>
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
                <h6>รายการหนังสือ</h6>
                <br>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>ลำดับ</th>
                            <th>ชื่อหนังสือ</th>
                            <th>ราคาเช่า</th>
                            <th>จำนวนที่ขาย</th>
                            <th>ยอดเช่า (รวม)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $total = 0;
                        $sum = 0;
                        ?>
                        <?php foreach ($book as $key => $value): ?>
                            <tr>
                                <td class="text-center">
                                    <?= $count++; ?>
                                </td>
                                <td>
                                    <?= $value['name_book']; ?>
                                </td>
                                <td class="text-center">
                                    <?= $value['price']; ?> บาท
                                </td>
                                <td class="text-center">
                                    <?= $value['count_history']; ?> ครั้ง
                                </td>
                                <td class="text-center">
                                    <?= $value['count_price_sum']; ?> บาท
                                </td>
                            </tr>
                            <?php
                            $total = $total + $value['count_history'];
                            $sum = $sum + $value['count_price_sum'];
                            ?>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="3" class="text-center">
                                รวม
                            </td>
                            <td class="text-center">
                                <?= $total; ?> ครั้ง
                            </td>
                            <td class="text-center">
                                <?= $sum; ?> บาท
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
    </script>
    <script>
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
            $("#text_date").text("รายงานยอดเช่ารายวันของเดือน " + formattedDate);
        } else if (type == 3) {
            var formattedDate = new Date(date).toLocaleDateString('th-TH', {
                year: 'numeric',
            });
            $("#text_date").text("รายงานยอดเช่ารายเดือนประจำปี " + formattedDate);
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <script>
        var type_load = <?php echo json_encode($type_load); ?>;
        if (type_load == 1) {
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
        } else if (type_load == 2) {
            window.addEventListener("load", window.print());
        }

    </script>
</body>

</html>