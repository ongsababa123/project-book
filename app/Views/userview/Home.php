<title>Home</title>

<!-- End Navbar -->
<div class="page-header" data-parallax="true"
    style="background-image: url('<?= base_url('dist/img/background.png') ?>');">
    <div class="filter"></div>
    <div class="container">
        <div class="motto text-center">
            <h1>ร้านบางเล่ม</h1>
            <h3>บริการเช่าหนังสือออนไลน์ สะดวก รวดเร็ว ใช้งานง่าย</h3>
            <br />
            <a href="<?= site_url('/book/booklist') ?>" class="btn btn-outline-neutral btn-round"><i class="fas fa-cart-plus"></i> จองหนังสือเลย!</a>
        </div>
    </div>
</div>
<div class="main">
    <div class="section text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                    <h2 class="title">บริการเช่าหนังสือออนไลน์</h2>
                    <h5 class="description">
                        บริการเช่าหนังสือออนไลน์นี้เน้นความสะดวกสบายและความยืดหยุ่นในการเลือกและรับหนังสือที่ร้าน
                        ผู้ใช้สามารถทำการเช่าหนังสือทุกที่ทุกเวลาผ่านระบบออนไลน์
                        และมีความยืดหยุ่นในการรับที่ร้าน
                        ระบบทำให้ผู้ใช้สามารถเลือกและพิมพ์รายการเช่าเพื่อรับที่ร้าน
                        โดยมีการสร้างรหัสยืนยันเพื่อให้การรับหนังสือที่ร้านเป็นไปอย่างราบรื่น
                        ระบบยังมีบริการลูกค้าที่ให้ความช่วยเหลือตลอดเวลา
                        ทำให้ผู้ใช้สามารถเพิ่มความคุ้มค่าในการใช้บริการนี้.
                    </h5>
                    <br>
                    <a href="<?= site_url('/contact') ?>" class="btn btn-warning btn-round">ติดต่อเรา</a>
                </div>
            </div>
            <br />
            <br />
            <div class="row">
                <div class="col-md-3">
                    <div class="info">
                        <div class="icon icon-warning">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">การเข้าถึงหนังสือที่สะดวก</h4>
                            <br>
                            <p class="description">
                                ผู้ให้บริการจะมีระบบออนไลน์ที่ช่วยให้ผู้ใช้สามารถเข้าถึงหนังสือได้ทุกที่ทุกเวลา
                                ไม่จำเป็นต้องเดินทางไปยังห้องสมุดหรือร้านหนังสือสาขาต่างๆ</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info">
                        <div class="icon icon-warning">
                            <i class="fas fa-th-list"></i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">หลากหลายในสารสนเทศ</h4>
                            <br>
                            <p>บริการนี้มีคลังข้อมูลหนังสือที่หลากหลายและครอบคลุมทุกระดับของความรู้ เช่น
                                หนังสือทางวิทยาศาสตร์, วรรณกรรม, ประวัติศาสตร์, การศึกษา, และหลายๆ หมวดหมู่อื่นๆ</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info">
                        <div class="icon icon-warning">
                            <i class="fas fa-poll"></i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">ระบบการเช่าที่ยืดหยุ่น</h4>
                            <br>
                            <p>ผู้ใช้สามารถเลือกเช่าหนังสือตามความต้องการของตน เช่น เช่าเป็นเวลาที่กำหนด,
                                จำนวนหนังสือที่สามารถเลือกเช่าในครั้งเดียว, หรือรูปแบบการชำระเงิน</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info">
                        <div class="icon icon-warning">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">บริการลูกค้า</h4>
                            <br>
                            <p>บริการนี้มักมีการสนับสนุนลูกค้าที่ดี
                                ผู้ใช้สามารถติดต่อเจ้าหน้าที่เพื่อขอความช่วยเหลือหรือข้อมูลเพิ่มเติม
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section section-dark text-center">
        <div class="container">
            <h2 class="title"><i class="fas fa-star" style="color: #d3cd22;"></i> หนังสือเด่นประจำสัปดาห์ <i
                    class="fas fa-star" style="color: #d3cd22;"></i></h2>
            <div class="row">
                <?php foreach ($bookData as $key => $value): ?>
                    <div class="col-md-4">
                        <div class="card card-profile card-plain">
                            <div class="">
                                <?php
                                // Assuming $book['pic_book'] contains the base64-encoded image data
                                if ($value['pic_book'] === null) {
                                    $imageSrc = base_url('dist/img/image-preview.png');
                                } else {
                                    $base64Data = $value['pic_book'];
                                    $decodedData = base64_decode($base64Data);
                                    $imageSrc = 'data:image/png;base64,' . base64_encode($decodedData);
                                }
                                ?>
                                <img src="<?= $imageSrc ?>" class="img-fluid mb-2" alt="white sample" />
                            </div>
                            <div class="card-body">
                                <a>
                                    <div class="author">
                                        <h4 class="card-title">
                                            <?= $value['name_book'] ?>
                                        </h4>
                                        <h6 class="card-category">
                                            <?= $value['book_author'] ?>
                                        </h6>
                                    </div>
                                </a>
                                <p class="card-description text-center">
                                    <?php
                                    $details_book = $value['details'];
                                    $encoding = mb_detect_encoding($details_book, 'UTF-8,ISO-8859-1');
                                    $details_book = mb_convert_encoding($details_book, 'UTF-8', $encoding);
                                    echo strlen($details_book) > 350 ? htmlspecialchars(mb_substr($details_book, 0, 350) . '...', ENT_QUOTES, 'UTF-8') : htmlspecialchars($details_book, ENT_QUOTES, 'UTF-8');
                                    ?>
                                </p>
                            </div>
                            <div class="card-footer text-center">
                                <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i
                                        class="fa fa-twitter"></i></a>
                                <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i
                                        class="fa fa-google-plus"></i></a>
                                <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i
                                        class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>