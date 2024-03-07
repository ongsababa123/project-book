<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>รายงานประวัติยอดเช่า</title>
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

    <h2 style="text-align: center;">รายงานประวัติยอดเช่า</h2>
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
        $text = "รายงานเดือน " . $months[(int) $date[1]] . " " . $date[0];
    } else if ($type == 3) {
        $text = "รายงานยอดเช่าปี " . $date;
    }
    ?>
    <h3 style="text-align: right;">
        <?= $text ?>
    </h3>
    <h3 style="text-align: right;">ข้อมูล ณ วันที่
        <?= $todayString ?> (
        <?= $todayFormatted ?>)
    </h3>
    <h3>รายการประวัติ</h3>
    <table>
        <thead>
            <tr>
                <th>ลำดับบิลที่</th>
                <th>หนังสือที่ยืม</th>
                <th>ค่าเช่ารวมทั้งสิ้น</th>
                <th>ค่ามัดจำรวมทั้งสิ้น</th>
                <th>ส่วนลดโปรโมชั่นรวมทั้งสิ้น</th>
                <th>ค่าปรับรวมทั้งสิ้น</th>
                <th>รวมทั้งสิ้น</th>
            </tr>
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
    <table>
        <thead>
            <tr>
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
</body>

</html>