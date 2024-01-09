<title>History</title>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
<style>
    .center {
        padding: 100px 0;
        padding-left: 30px;
        text-align: center;
    }

    .nav .nav-item .nav-link:hover,
    .nav .nav-item .nav-link:focus {
        background-color: #d7a744;
        color: white;
    }

    .nav-pills .nav-item .nav-link.active {
        background-color: #fbc658;
        color: white;
    }

    .nav-pills .nav-item .nav-link {
        background-color: #86d9ab;
        border: #86d9ab;
    }
</style>

<div class="main" style="background-color: #bddce5;">
    <br>
    <div class="page-header page-header-xs" data-parallax="true"
        style="background-image: url('<?= base_url('dist/img/background.png') ?>');">
        <div class="filter"></div>
        <div class="container">
            <div class="motto text-center">
                <h1>ประวัติการเช่า</h1>
                <br />
                <a href="<?= site_url('/book/booklist') ?>" class="btn btn-outline-neutral btn-round"><i
                        class="fas fa-cart-plus"></i>
                    จองหนังสือเพิ่ม</a>
            </div>
        </div>
    </div>

    <div class="section mb-6" style="background-color: #bddce5;">
        <div class="container ">
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                    <a class="nav-link active" id="tab1" data-toggle="pill" href="#tabContent1">รอรับหนังสือ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab2" data-toggle="pill" href="#tabContent2">กำลังเช่า</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab3" data-toggle="pill" href="#tabContent3">คืนแล้ว</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tabContent1">
                    <!-- Tab 1 content -->
                    <?php if (!empty($HistoryData_1)): ?>
                        <?php foreach ($HistoryData_1 as $key => $value): ?>
                            <?php
                            $today = new DateTime(); // Get the current date
                            $today->setTime(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0
                            if ($value['status_his'] === '1') {
                                echo '<div class="bg-info pb-3 text-center">
                                <div class="row mt-2">
                                    <div class="col-lg-12 mt-4">
                                        <h6 class="text-white">รอเข้ารับหนังสือ</h6>
                                    </div>
                                </div>
                            </div>';
                            } else if ($value['status_his'] === '2') {
                                if ($value['submit_date'] === null) {
                                    $returnDate = new DateTime($value['return_date']);
                                    $returnDate->setTime(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0
                    
                                    if ($today > $returnDate) {
                                        echo '<div class="bg-danger pb-3 text-center">
                                <div class="row mt-2">
                                    <div class="col-lg-12 mt-4">
                                        <h6 class="text-white">เกินกำหนด</h6>
                                    </div>
                                </div>
                            </div>';
                                    } else {
                                        echo '<div class="bg-warning pb-3 text-center">
                                    <div class="row mt-2">
                                        <div class="col-lg-12 mt-4">
                                            <h6 class="text-white">กำลังยืม</h6>
                                        </div>
                                    </div>
                                </div>';
                                    }
                                } else {
                                    echo '<div class="bg-success pb-3 text-center">
                                    <div class="row mt-2">
                                        <div class="col-lg-12 mt-4">
                                            <h6 class="text-white">คืนแล้ว</h6>
                                        </div>
                                    </div>
                                </div>';
                                }
                            } else {
                                echo '<div class="bg-danger pb-3 text-center">
                        <div class="row mt-2">
                            <div class="col-lg-12 mt-4">
                                <h6 class="text-white">เกินกำหนดวันรับ</h6>
                            </div>
                        </div>
                    </div>';
                            }
                            ?>
                            <div class="p-4 border mb-3" style="background-color: white;">
                                <?php $id_books = explode(',', $value['id_book']); ?>
                                <?php foreach ($bookData as $keybookData => $valuebookData): ?>
                                    <?php if (in_array($valuebookData['id_book'], $id_books)): ?>
                                        <div class="row mt-2">
                                            <div class="col-lg-5 col-md-12 text-center">
                                                <?php
                                                $imageSrc = base_url('dist/img/image-preview.png');
                                                if ($valuebookData['pic_book'] !== null) {
                                                    $base64Data = $valuebookData['pic_book'];
                                                    $decodedData = base64_decode($base64Data);
                                                    $imageSrc = 'data:image/png;base64,' . base64_encode($decodedData);
                                                }
                                                $details_book = $valuebookData['details'];
                                                $encoding = mb_detect_encoding($details_book, 'UTF-8,ISO-8859-1');
                                                $details_book = mb_convert_encoding($details_book, 'UTF-8', $encoding);

                                                $shortenedDetails = strlen($details_book) > 50 ?
                                                    htmlspecialchars(mb_substr($details_book, 0, 50) . '...', ENT_QUOTES, 'UTF-8') :
                                                    htmlspecialchars($details_book, ENT_QUOTES, 'UTF-8');
                                                ?>
                                                <img src="<?= $imageSrc ?>" class="img-rounded img-responsive" alt="Rounded Image"
                                                    style="height: 300px;">
                                            </div>
                                            <div class="col-lg-6">
                                                <h2 class="title">
                                                    <?= $valuebookData['name_book'] ?>
                                                </h2>
                                                <h6 class="description">ชื่อผู้แต่ง
                                                    <?= $valuebookData['book_author'] ?>
                                                </h6>
                                                <h6 class="description">ประเภท
                                                    <?= $valuebookData['categoryData']['name_category'] ?>
                                                </h6>
                                                <p class="description">
                                                    <?= $shortenedDetails ?>
                                                </p>
                                                <h6 class="description">ราคาเช่า
                                                    <?= $valuebookData['price'] ?> บาท
                                                </h6>
                                                <h6 class="description">ราคาหนังสือ
                                                    <?= $valuebookData['price_book'] ?> บาท
                                                </h6>
                                                <a href="<?= site_url('/book/details/') . $valuebookData['id_book'] ?>"
                                                    class="btn btn-default ">เพิ่มเติม</a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-10 mt-2"></div>
                                    <div class="col-lg-2 mt-2">
                                        <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#details"
                                            onclick="loadmodal(<?= $value['id_history'] ?>, 1)" id="button_modal"
                                            name="button_modal">รายละเอียด</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="section mb-6" style="background-color: #bddce5; padding-bottom: 10rem;">
                            <div class="container ">
                                <h1 class="text-center">ไม่มีประวัติการเช่า</h1>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="tab-pane fade" id="tabContent2">
                    <!-- Tab 2 content -->
                    <?php if (!empty($HistoryData_2)): ?>
                        <?php foreach ($HistoryData_2 as $key => $value): ?>
                            <?php
                            $today = new DateTime(); // Get the current date
                            $today->setTime(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0
                            if ($value['status_his'] === '1') {
                                echo '<div class="bg-info pb-3 text-center">
                                <div class="row mt-2">
                                    <div class="col-lg-12 mt-4">
                                        <h6 class="text-white">รอเข้ารับหนังสือ</h6>
                                    </div>
                                </div>
                            </div>';
                            } else if ($value['status_his'] === '2') {
                                if ($value['submit_date'] === null) {
                                    $returnDate = new DateTime($value['return_date']);
                                    $returnDate->setTime(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0
                    
                                    if ($today > $returnDate) {
                                        echo '<div class="bg-danger pb-3 text-center">
                                <div class="row mt-2">
                                    <div class="col-lg-12 mt-4">
                                        <h6 class="text-white">เกินกำหนด</h6>
                                    </div>
                                </div>
                            </div>';
                                    } else {
                                        echo '<div class="bg-warning pb-3 text-center">
                                    <div class="row mt-2">
                                        <div class="col-lg-12 mt-4">
                                            <h6 class="text-white">กำลังยืม</h6>
                                        </div>
                                    </div>
                                </div>';
                                    }
                                } else {
                                    echo '<div class="bg-success pb-3 text-center">
                                    <div class="row mt-2">
                                        <div class="col-lg-12 mt-4">
                                            <h6 class="text-white">คืนแล้ว</h6>
                                        </div>
                                    </div>
                                </div>';
                                }
                            } else {
                                echo '<div class="bg-danger pb-3 text-center">
                        <div class="row mt-2">
                            <div class="col-lg-12 mt-4">
                                <h6 class="text-white">เกินกำหนดวันรับ</h6>
                            </div>
                        </div>
                    </div>';
                            }
                            ?>
                            <div class="p-4 border mb-3" style="background-color: white;">
                                <?php $id_books = explode(',', $value['id_book']); ?>
                                <?php foreach ($bookData as $keybookData => $valuebookData): ?>
                                    <?php if (in_array($valuebookData['id_book'], $id_books)): ?>
                                        <div class="row mt-2">
                                            <div class="col-lg-5 col-md-12 text-center">
                                                <?php
                                                $imageSrc = base_url('dist/img/image-preview.png');
                                                if ($valuebookData['pic_book'] !== null) {
                                                    $base64Data = $valuebookData['pic_book'];
                                                    $decodedData = base64_decode($base64Data);
                                                    $imageSrc = 'data:image/png;base64,' . base64_encode($decodedData);
                                                }
                                                $details_book = $valuebookData['details'];
                                                $encoding = mb_detect_encoding($details_book, 'UTF-8,ISO-8859-1');
                                                $details_book = mb_convert_encoding($details_book, 'UTF-8', $encoding);

                                                $shortenedDetails = strlen($details_book) > 50 ?
                                                    htmlspecialchars(mb_substr($details_book, 0, 50) . '...', ENT_QUOTES, 'UTF-8') :
                                                    htmlspecialchars($details_book, ENT_QUOTES, 'UTF-8');
                                                ?>
                                                <img src="<?= $imageSrc ?>" class="img-rounded img-responsive" alt="Rounded Image"
                                                    style="height: 300px;">
                                            </div>
                                            <div class="col-lg-6">
                                                <h2 class="title">
                                                    <?= $valuebookData['name_book'] ?>
                                                </h2>
                                                <h6 class="description">ชื่อผู้แต่ง
                                                    <?= $valuebookData['book_author'] ?>
                                                </h6>
                                                <h6 class="description">ประเภท
                                                    <?= $valuebookData['categoryData']['name_category'] ?>
                                                </h6>
                                                <p class="description">
                                                    <?= $shortenedDetails ?>
                                                </p>
                                                <h6 class="description">ราคาเช่า
                                                    <?= $valuebookData['price'] ?> บาท
                                                </h6>
                                                <h6 class="description">ราคาหนังสือ
                                                    <?= $valuebookData['price_book'] ?> บาท
                                                </h6>
                                                <a href="<?= site_url('/book/details/') . $valuebookData['id_book'] ?>"
                                                    class="btn btn-default ">เพิ่มเติม</a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-10 mt-2"></div>
                                    <div class="col-lg-2 mt-2">
                                        <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#details"
                                            onclick="loadmodal(<?= $value['id_history'] ?>, 2)" id="button_modal"
                                            name="button_modal">รายละเอียด</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="section mb-6" style="background-color: #bddce5; padding-bottom: 10rem;">
                            <div class="container ">
                                <h1 class="text-center">ไม่มีประวัติการเช่า</h1>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="tab-pane fade" id="tabContent3">
                    <!-- Tab 3 content -->
                    <?php if (!empty($HistoryData_3)): ?>
                        <?php foreach ($HistoryData_3 as $key => $value): ?>
                            <?php
                            $today = new DateTime(); // Get the current date
                            $today->setTime(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0
                            if ($value['status_his'] === '1') {
                                echo '<div class="bg-info pb-3 text-center">
                                <div class="row mt-2">
                                    <div class="col-lg-12 mt-4">
                                        <h6 class="text-white">รอเข้ารับหนังสือ</h6>
                                    </div>
                                </div>
                            </div>';
                            } else if ($value['status_his'] === '2') {
                                if ($value['submit_date'] === null) {
                                    $returnDate = new DateTime($value['return_date']);
                                    $returnDate->setTime(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0
                    
                                    if ($today > $returnDate) {
                                        echo '<div class="bg-danger pb-3 text-center">
                                <div class="row mt-2">
                                    <div class="col-lg-12 mt-4">
                                        <h6 class="text-white">เกินกำหนด</h6>
                                    </div>
                                </div>
                            </div>';
                                    } else {
                                        echo '<div class="bg-warning pb-3 text-center">
                                    <div class="row mt-2">
                                        <div class="col-lg-12 mt-4">
                                            <h6 class="text-white">กำลังยืม</h6>
                                        </div>
                                    </div>
                                </div>';
                                    }
                                } else {
                                    echo '<div class="bg-success pb-3 text-center">
                                    <div class="row mt-2">
                                        <div class="col-lg-12 mt-4">
                                            <h6 class="text-white">คืนแล้ว</h6>
                                        </div>
                                    </div>
                                </div>';
                                }
                            } else if ($value['status_his'] === '3') {
                                echo '<div class="bg-success pb-3 text-center">
                                <div class="row mt-2">
                                    <div class="col-lg-12 mt-4">
                                        <h6 class="text-white">คืนแล้ว</h6>
                                    </div>
                                </div>
                            </div>';
                            } else {
                                echo '<div class="bg-danger pb-3 text-center">
                        <div class="row mt-2">
                            <div class="col-lg-12 mt-4">
                                <h6 class="text-white">เกินกำหนดวันรับ</h6>
                            </div>
                        </div>
                    </div>';
                            }
                            ?>
                            <div class="p-4 border mb-3" style="background-color: white;">
                                <?php $id_books = explode(',', $value['id_book']); ?>
                                <?php foreach ($bookData as $keybookData => $valuebookData): ?>
                                    <?php if (in_array($valuebookData['id_book'], $id_books)): ?>
                                        <div class="row mt-2">
                                            <div class="col-lg-5 col-md-12 text-center">
                                                <?php
                                                $imageSrc = base_url('dist/img/image-preview.png');
                                                if ($valuebookData['pic_book'] !== null) {
                                                    $base64Data = $valuebookData['pic_book'];
                                                    $decodedData = base64_decode($base64Data);
                                                    $imageSrc = 'data:image/png;base64,' . base64_encode($decodedData);
                                                }
                                                $details_book = $valuebookData['details'];
                                                $encoding = mb_detect_encoding($details_book, 'UTF-8,ISO-8859-1');
                                                $details_book = mb_convert_encoding($details_book, 'UTF-8', $encoding);

                                                $shortenedDetails = strlen($details_book) > 50 ?
                                                    htmlspecialchars(mb_substr($details_book, 0, 50) . '...', ENT_QUOTES, 'UTF-8') :
                                                    htmlspecialchars($details_book, ENT_QUOTES, 'UTF-8');
                                                ?>
                                                <img src="<?= $imageSrc ?>" class="img-rounded img-responsive" alt="Rounded Image"
                                                    style="height: 300px;">
                                            </div>
                                            <div class="col-lg-6">
                                                <h2 class="title">
                                                    <?= $valuebookData['name_book'] ?>
                                                </h2>
                                                <h6 class="description">ชื่อผู้แต่ง
                                                    <?= $valuebookData['book_author'] ?>
                                                </h6>
                                                <h6 class="description">ประเภท
                                                    <?= $valuebookData['categoryData']['name_category'] ?>
                                                </h6>
                                                <p class="description">
                                                    <?= $shortenedDetails ?>
                                                </p>
                                                <h6 class="description">ราคาเช่า
                                                    <?= $valuebookData['price'] ?> บาท
                                                </h6>
                                                <h6 class="description">ราคาหนังสือ
                                                    <?= $valuebookData['price_book'] ?> บาท
                                                </h6>
                                                <a href="<?= site_url('/book/details/') . $valuebookData['id_book'] ?>"
                                                    class="btn btn-default ">เพิ่มเติม</a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-10 mt-2"></div>
                                    <div class="col-lg-2 mt-2">
                                        <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#details"
                                            onclick="loadmodal(<?= $value['id_history'] ?>, 3)" id="button_modal"
                                            name="button_modal">รายละเอียด</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="section mb-6" style="background-color: #bddce5; padding-bottom: 10rem;">
                            <div class="container ">
                                <h1 class="text-center">ไม่มีประวัติการเช่า</h1>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade " id="details" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header no-border-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h1 class="text-muted">รายละเอียด</h1>
                <div class="social-line text-center">
                    <img src="<?= base_url('dist/img/logo11.png') ?>" width="50%">
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <table class="table" id="book_Table">
                    </table>
                    <table class="table" id="promotionTable">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include("calculate"); ?>

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
<script>
    function loadmodal(id_history, type) {
        var HistoryData = null;
        if (type == 1) {
            var HistoryData = <?php echo json_encode($HistoryData_1); ?>;
        } else if (type == 2) {
            var HistoryData = <?php echo json_encode($HistoryData_2); ?>;
        } else {
            var HistoryData = <?php echo json_encode($HistoryData_3); ?>;
        }
        const bookData = <?php echo json_encode($bookData); ?>;
        const PromotionData = <?php echo json_encode($PromotionData); ?>;
        const data_latefees = <?php echo json_encode($data_latefees); ?>;
        $("#book_Table").empty();
        $("#promotionTable").empty();
        var count = 0;

        HistoryData.find(element => {
            if (element.id_history == id_history) {
                const splittedIdBook = element.id_book.split(',');
                const price_deposit = splittedIdBook.length * 100;
                var price_late = null;
                var today = new Date(); // Get the current date
                today.setHours(0, 0, 0, 0)
                var returnDate = new Date(element.return_date);
                returnDate.setHours(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0
                if (element.submit_date == null) {

                    if (element.late_price === '0' || element.late_price == null) {
                        if (today > returnDate) {

                            var price_fees = data_latefees[0]['price_fees'];
                            calculate_price_late(splittedIdBook.length, price_fees, returnDate, function (result_price) {
                                price_late = result_price;
                            });
                        } else {
                            price_late = "ไม่มีค่าปรับ";
                        }
                    } else {
                        price_late = element.late_price;
                    }
                } else {
                    if (element.late_price == null) {
                        price_late = "ไม่มีค่าปรับ";
                    } else {
                        price_late = element.late_price;
                    }
                }

                splittedIdBook.forEach(element_id_book => {
                    const foundBook = bookData.find(element_book => element_book.id_book == element_id_book);
                    if (foundBook) {
                        count += 1;
                        const row1 = `
                            <tr>
                                <th>ลำดับ :</th>
                                <td>${count}</td>
                                <th>ชื่อหนังสือ :</th>
                                <td>${foundBook.name_book}</td>
                                <th>ราคาเช่า :</th>
                                <td>${foundBook.price} บาท</td>
                            </tr>
                        `;
                        $("#book_Table").append(row1);
                    }

                });
                const row1_1 = `
                        <tr>
                            <th></th>
                            <td></td>
                            <th></th>
                            <td></td>
                            <th>ราคารวม :</th>
                            <td>${element.sum_price}</td>
                        </tr>`;
                $("#book_Table").append(row1_1);
                if (element.id_promotion != null) {
                    const splittedIdPromotion = element.id_promotion.split(',');
                    splittedIdPromotion.forEach(element_id_promotion => {
                        const foundPromotion = PromotionData.find(element_promotion => element_promotion.id_promotion == element_id_promotion);
                        if (foundPromotion) {
                            const row2 = `
                                <tr>
                                    <th>โปรโมชั่น :</th>
                                    <td colspan="5">${foundPromotion.details}</td>
                                </tr>
                            `;
                            $("#promotionTable").append(row2);
                        }
                    })
                } else {
                    const row2 = `
                        <tr>
                            <th>โปรโมชั่น :</th>
                            <td>ไม่มีโปรโมชั่น</td>
                            <td></td>
                            <th></th>
                            <td></td>
                        </tr>
                    `;
                    $("#promotionTable").append(row2);
                }
                const row2_2 = `
                        <tr>
                            <th></th>
                            <td></td>
                            <td></td>
                            <th>ส่วนลด :</th>
                            <td>${element.sum_price_promotion} บาท</td>
                        </tr>
                    `;
                $("#promotionTable").append(row2_2);

                const row3 = `
                <tr>
                    <th>วันที่เข้ารับหนังสือ</th>
                    <td>${element.rental_date}</td>
                    <td></td>
                    <th>ค่ามัดจํา :</th>
                    <td>${price_deposit} บาท</td>
                </tr>
                <tr>
                    <th>วันที่จะต้องคืนหนังสือ</th>
                    <td>${element.return_date}</td>
                    <td></td>
                    <th>ราคารวม(ค่ามัดจําและหักโปรโมชั่น) :</th>
                    <td>${(parseInt(element.sum_price) - parseInt(element.sum_price_promotion)) + parseInt(price_deposit)} บาท</td>
                </tr>
                <tr>
                    <th>วันที่มาคืนหนังสือ</th>
                    <td>${element.submit_date === null ? "ยังไม่มาคืน" : element.submit_date}</td>
                    <td></td>
                    <th>ค่าปรับ :</th>
                    <td>${price_late}</td>
                </tr>`;
                $("#promotionTable").append(row3);
            }
        });
    }

</script>