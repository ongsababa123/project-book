<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>รายงานยอดเช่า</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            text-align: center;
        }



        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #86d9ab;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        tbody td.text-center,
        tbody th.text-center {
            text-align: center;
        }

        tfoot {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <img src="<?= base_url('dist/img/logo11.jpg') ?>" style="text-align: center;">
        <h1 style="font-weight: bold;">ร้านหนังสือบางเล่ม</h1>
    </header>

    <h2 style="text-align: center;">รายงานยอดเช่า</h2>
    <?php
    date_default_timezone_set('Asia/Bangkok'); // ตั้งค่าโซนเวลาเป็น Asia/Bangkok (ภาษาไทย)
    
    $today = new DateTime();
    $formatter = new IntlDateFormatter('th_TH', IntlDateFormatter::FULL, IntlDateFormatter::NONE);

    $todayString = $today->format('Y-m-d');
    $todayFormatted = $formatter->format($today);
    $months = array(
        1 => 'มกราคม',
        2 => 'กุมภาพันธ์',
        3 => 'มีนาคม',
        4 => 'เมษายน',
        5 => 'พฤษภาคม',
        6 => 'มิถุนายน',
        7 => 'กรกฎาคม',
        8 => 'สิงหาคม',
        9 => 'กันยายน',
        10 => 'ตุลาคม',
        11 => 'พฤศจิกายน',
        12 => 'ธันวาคม'
    );

    if ($type == 1) {
        $formattedDate = new DateTime($date);
        $formattedDateFormatted = $formatter->format($formattedDate);
        $text = "รายงานยอดเช่าประจำวัน " . $formattedDateFormatted;
    } else if ($type == 2) {
        $date = explode('-', $date);
        $text = "รายงานยอดเช่ารายวันของเดือน " . $months[(int) $date[1]] . " " . $date[0];
    } else if ($type == 3) {
        $text = "รายงานยอดเช่ารายเดือนของปี " . $date;
    }
    ?>
    <h3 style="text-align: right;">
        <?= $text ?>
    </h3>
    <h3 style="text-align: right;">ข้อมูล ณ วันที่
        <?= $todayString ?> (
        <?= $todayFormatted ?>)
    </h3>
    <h3>รายการหนังสือ</h3>
    <table>
        <thead>
            <tr>
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
                <?php if ($value['count_history'] != 0): ?>
                    <tr>
                        <td>
                            <?= $count++; ?>
                        </td>
                        <td>
                            <?= $value['name_book']; ?>
                        </td>
                        <td>
                            <?= $value['price']; ?> บาท
                        </td>
                        <td>
                            <?= $value['count_history']; ?> ครั้ง
                        </td>
                        <td>
                            <?= $value['count_price_sum']; ?> บาท
                        </td>
                    </tr>
                <?php endif; ?>
                <?php
                $total += $value['count_history'];
                $sum += $value['count_price_sum'];
                ?>
            <?php endforeach; ?>
            <tr style="background-color: #86d9ab;">
                <td colspan="3" class="text-center">รวม</td>
                <td class="text-center">
                    <?= $total; ?> ครั้ง
                </td>
                <td class="text-center">
                    <?= $sum; ?> บาท
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>