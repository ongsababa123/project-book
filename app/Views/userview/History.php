<title>History</title>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
<style>
    .center {
        padding: 100px 0;
        padding-left: 30px;
        text-align: center;
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
            <?php if (!empty($HistoryData)): ?>
                <?php foreach ($HistoryData as $key => $value): ?>
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
                                            <?= $valuebookData['details'] ?>
                                        </p>
                                        <h6 class="description">ราคา
                                            <?= $valuebookData['price'] ?> บาท
                                        </h6>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <div class="row mt-2">
                            <div class="col-lg-12">
                                <h6>รายละเอียดโปรโมชั่นที่ได้</h6>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-12">
                                <?php if (!empty($value['id_promotion'])): ?>
                                    <?php $id_promotion = explode(',', $value['id_promotion']); ?>
                                    <?php foreach ($PromotionData as $promotion): ?>
                                        <?php if (in_array($promotion['id_promotion'], $id_promotion)): ?>
                                            <p class="description">
                                                <?= $promotion['details'] ?>
                                            </p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <h6>ไม่มีโปรโมชั่น</h6>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-2 mt-2">
                                <?php
                                $id_books = explode(',', $value['id_book']);
                                $count_books = count($id_books);
                                ?>
                                <h6>จำนวน :
                                    <?= $count_books ?>
                                </h6>
                            </div>
                            <div class="col-lg-3 mt-2">
                                <h6>ส่วนลดโปรโมชั่น :
                                    <?= $value['sum_price_promotion'] ?> บาท
                                </h6>
                            </div>
                            <div class="col-lg-2 mt-2">
                                <h6>ค่าปรับ :
                                    <?= $value['late_price'] ?? 0 ?> บาท
                                </h6>
                            </div>
                            <div class="col-lg-3 mt-2">
                                <h6>ราคารวม :
                                    <?= $value['sum_price'] ?? 0 ?>
                                </h6>
                            </div>
                            <div class="col-lg-2">
                                <a href="<?= site_url('dashboard/history/billview/' . $value['id_history']) ?>" target="_blank"
                                    class="btn btn-danger btn-round">
                                    <i class="fas fa-print"></i> พิมพ์ใบเสร็จ
                                </a>
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