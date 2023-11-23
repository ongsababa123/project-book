<title>Details Book</title>
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
    <div class="section mb-6 px-3" style="background-color: #bddce5;">
        <div class="p-4 border mb-3" style="background-color: white;">
            <div class="row">
                <div class="col-lg-5 col-md-12 text-center">
                    <?php
                    $imageSrc = base_url('dist/img/image-preview.png');
                    if ($bookData[0]['pic_book'] !== null) {
                        $base64Data = $bookData[0]['pic_book'];
                        $decodedData = base64_decode($base64Data);
                        $imageSrc = 'data:image/png;base64,' . base64_encode($decodedData);
                    }
                    ?>
                    <img src="<?= $imageSrc ?>" class="img-rounded img-responsive"
                        alt="Rounded Image" style="height: 30rem;">
                </div>
                <div class="col-lg-7">
                    <p style="font-size: 2vw;">
                        <?= $bookData[0]['name_book'] ?>
                    </p>
                    <br>
                    <h6 class="description">ชื่อผู้แต่ง</h6>
                    <p class="description">
                        <?= $bookData[0]['book_author'] ?>
                    </p>
                    <br>
                    <h6 class="description">ประเภท</h6>
                    <p class="description">
                        <?= $categoryData[0]['name_category'] ?>
                    </p>
                    <br>
                    <h6 class="description">รายละเอียด</h6>
                    <p class="description">
                        <?= $bookData[0]['details'] ?>
                    </p>
                    <br>
                    <h6 class="description">ราคา</h6>
                    <p class="description">
                        <?= $bookData[0]['price'] ?> บาท
                    </p>
                    <button class="btn btn-danger btn-round mt-5"><i class="fas fa-cart-arrow-down"></i>
                        ใส่ตระกร้าเลย</button>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-5" style="background-color: #bddce5;">
        <div class="container ">
        </div>
    </div>
</div>