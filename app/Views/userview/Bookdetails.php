<title>หนังสือ
    <?= $bookData[0]['name_book'] ?>
</title>
<style>
    .center {
        padding: 100px 0;
        padding-left: 30px;
        text-align: center;
    }
</style>
<div class="main" style="background-color: #bddce5;">
    <br>
    <div class="section px-3" style="background-color: #bddce5; ">
        <div class="p-4 border mb-3" style="background-color: white;">
            <div class="row">
                <div class="col-lg-5 col-md-12 text-center">
                    <?php
                    $imageSrc = base_url('dist/img/logo1.png');
                    if ($bookData[0]['pic_book'] !== null) {
                        $base64Data = $bookData[0]['pic_book'];
                        $decodedData = base64_decode($base64Data);
                        $imageSrc = 'data:image/png;base64,' . base64_encode($decodedData);
                    }
                    $status = ($bookData[0]['status_book'] == 2 || $bookData[0]['count_stock'] == 0) ? 'disabled' : '';
                    ?>
                    <img src="<?= $imageSrc ?>" class="img-rounded img-responsive" alt="Rounded Image"
                        style="height: 30rem;">
                </div>
                <div class="col-lg-7">
                    <p style="font-size: 2vw;">
                        <?= $bookData[0]['name_book'] ?>
                    </p>
                    <?php if ($bookData[0]['status_book'] == 1): ?>
                        <span class="badge badge-pill badge-success">พร้อมเช่า</span>
                    <?php else: ?>
                        <span class="badge badge-pill badge-danger">กำลังเช่าอยู่</span>
                    <?php endif; ?>
                    <br>
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
                    <h6 class="description">ราคาเช่า</h6>
                    <p class="description">
                        <?= $bookData[0]['price'] ?> บาท
                    </p>
                    <h6 class="description">ราคาหนังสือ</h6>
                    <p class="description">
                        <?= $bookData[0]['price_book'] ?> บาท
                    </p>
                    <p class="description">
                        <span class="badge badge-default">คงเหลือในสต๊อก
                            <?= $bookData[0]['count_stock'] ?> เล่ม
                        </span>
                    </p>
                    <br>
                    <?php if (session()->get('isLoggedIn')): ?>
                        <button class="btn btn-danger btn-round" onclick="alert_(<?= $bookData[0]['id_book'] ?>)"
                            id="button_book" <?= $status ?>>
                            <i class="fas fa-cart-arrow-down"></i> ใส่ตระกร้าเลย
                        </button>
                    <?php else: ?>
                        <button class="btn btn-danger btn-round" onclick="showAlert('กรุณาเข้าสู่ระบบก่อนเลือกสินค้า')"
                            <?= $status ?>><i class="fas fa-cart-arrow-down"></i>
                            ใส่ตระกร้าเลย</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="p-4 border mb-3" style="background-color: white;">
            <h3><strong>คะแนนของหนังสือ</strong></h3>
            <div class="row">
                <div class="col-2">
                    <strong>
                        <p style="font-size: 2vw;">
                            <?= $averageRating ?> เต็ม 5
                        </p>
                    </strong>
                    <?php
                    // Display full stars
                    for ($i = 0; $i < floor($averageRating); $i++): ?>
                        <i class="fas fa-star" style="color: #63E6BE;"></i>
                    <?php endfor;

                    // Display half star if applicable
                    if (strpos($averageRating, '.') !== false): ?>
                        <i class="fas fa-star-half" style="color: #63E6BE;"></i>
                    <?php endif; ?>

                    <?php for ($i = 0; $i < 5 - floor($averageRating); $i++): ?>
                        <i class="far fa-star"></i>
                    <?php endfor; ?>
                </div>

                <?php
                $count_1 = 0;
                $count_2 = 0;
                $count_3 = 0;
                $count_4 = 0;
                $count_5 = 0;
                $count_all = 0;
                if ($review_data) {
                    foreach ($review_data as $review) {
                        if ($review['rating_value'] == 1) {
                            $count_1++;
                        } else if ($review['rating_value'] == 2) {
                            $count_2++;
                        } else if ($review['rating_value'] == 3) {
                            $count_3++;
                        } else if ($review['rating_value'] == 4) {
                            $count_4++;
                        } else if ($review['rating_value'] == 5) {
                            $count_5++;
                        }
                        $count_all++;
                    }
                }
                ?>
                <div class="col-10">
                    <button type="button" class="btn btn-secondary active ml-2" id="tab1" data-toggle="pill" name="tab_"
                        href="#tabContent1" onclick="toggleActive(this.id)">ทั้งหมด (
                        <?= $count_all ?>)
                    </button>
                    <button type="button" class="btn btn-secondary ml-2" id="tab2" data-toggle="pill" name="tab_"
                        href="#tabContent2" onclick="toggleActive(this.id)">5 ดาว (
                        <?= $count_5 ?>)
                    </button>
                    <button type="button" class="btn btn-secondary ml-2" id="tab3" data-toggle="pill" name="tab_"
                        href="#tabContent3" onclick="toggleActive(this.id)">4 ดาว (
                        <?= $count_4 ?>)
                    </button>
                    <button type="button" class="btn btn-secondary ml-2" id="tab4" data-toggle="pill" name="tab_"
                        href="#tabContent4" onclick="toggleActive(this.id)">3 ดาว (
                        <?= $count_3 ?>)
                    </button>
                    <button type="button" class="btn btn-secondary ml-2" id="tab5" data-toggle="pill" name="tab_"
                        href="#tabContent5" onclick="toggleActive(this.id)">2 ดาว (
                        <?= $count_2 ?>)
                    </button>
                    <button type="button" class="btn btn-secondary ml-2" id="tab6" data-toggle="pill" name="tab_"
                        href="#tabContent6" onclick="toggleActive(this.id)">1 ดาว (
                        <?= $count_1 ?>)
                    </button>
                </div>
            </div>
            <hr>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tabContent1">
                    <?php if ($review_data): ?>
                        <?php foreach ($review_data as $review): ?>
                            <div class="row pl-5">
                                <div class="col-1">
                                    <img src="<?= base_url('dist/img/avatar7.png') ?>" alt="Circle Image"
                                        class="img-circle img-no-padding img-responsive" width="100%">
                                </div>
                                <div class="col-11">
                                    <p><strong>
                                            <?= $review['user_data']['name'] ?>
                                            <?= $review['user_data']['lastname'] ?>
                                        </strong></p>
                                    <?php for ($i = 0; $i < $review['rating_value']; $i++) { ?>
                                        <i class="fas fa-star" style="color: #FFD43B;"></i>
                                    <?php } ?>
                                    <?php for ($i = 0; $i < 5 - floor($review['rating_value']); $i++): ?>
                                        <i class="far fa-star"></i>
                                    <?php endfor; ?>
                                    <p class="description">
                                        <?= $review['date_time'] ?>
                                    </p>
                                    <p>
                                        <?= $review['comment'] ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>ยังไม่มีความคิดเห็น</p>
                    <?php endif; ?>
                </div>
                <div class="tab-pane fade" id="tabContent2">
                    <?php if ($review_data): ?>
                        <?php $check_rating_5 = 0; ?>
                        <?php foreach ($review_data as $review): ?>
                            <?php if ($review['rating_value'] == 5): ?>
                                <?php $check_rating_5++; ?>
                                <div class="row pl-5">
                                    <div class="col-1">
                                        <img src="<?= base_url('dist/img/avatar7.png') ?>" alt="Circle Image"
                                            class="img-circle img-no-padding img-responsive" width="100%">
                                    </div>
                                    <div class="col-11">
                                        <p><strong>
                                                <?= $review['user_data']['name'] ?>
                                                <?= $review['user_data']['lastname'] ?>
                                            </strong></p>
                                        <?php for ($i = 0; $i < $review['rating_value']; $i++) { ?>
                                            <i class="fas fa-star" style="color: #FFD43B;"></i>
                                        <?php } ?>
                                        <?php for ($i = 0; $i < 5 - floor($review['rating_value']); $i++): ?>
                                            <i class="far fa-star"></i>
                                        <?php endfor; ?>
                                        <p class="description">
                                            <?= $review['date_time'] ?>
                                        </p>
                                        <p>
                                            <?= $review['comment'] ?>
                                        </p>
                                    </div>
                                </div>
                                <hr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if ($check_rating_5 == 0): ?>
                            <p>ยังไม่มีความคิดเห็น</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>ยังไม่มีความคิดเห็น</p>
                    <?php endif; ?>
                </div>
                <div class="tab-pane fade" id="tabContent3">
                    <?php if ($review_data): ?>
                        <?php $check_rating_4 = 0; ?>
                        <?php foreach ($review_data as $review): ?>
                            <?php if ($review['rating_value'] == 4): ?>
                                <?php $check_rating_4++; ?>
                                <div class="row pl-5">
                                    <div class="col-1">
                                        <img src="<?= base_url('dist/img/avatar7.png') ?>" alt="Circle Image"
                                            class="img-circle img-no-padding img-responsive" width="100%">
                                    </div>
                                    <div class="col-11">
                                        <p><strong>
                                                <?= $review['user_data']['name'] ?>
                                                <?= $review['user_data']['lastname'] ?>
                                            </strong></p>
                                        <?php for ($i = 0; $i < $review['rating_value']; $i++) { ?>
                                            <i class="fas fa-star" style="color: #FFD43B;"></i>
                                        <?php } ?>
                                        <?php for ($i = 0; $i < 5 - floor($review['rating_value']); $i++): ?>
                                            <i class="far fa-star"></i>
                                        <?php endfor; ?>
                                        <p class="description">
                                            <?= $review['date_time'] ?>
                                        </p>
                                        <p>
                                            <?= $review['comment'] ?>
                                        </p>
                                    </div>
                                </div>
                                <hr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if ($check_rating_4 == 0): ?>
                            <p>ยังไม่มีความคิดเห็น</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>ยังไม่มีความคิดเห็น</p>
                    <?php endif; ?>
                </div>
                <div class="tab-pane fade" id="tabContent4">
                    <?php if ($review_data): ?>
                        <?php $check_rating_3 = 0; ?>
                        <?php foreach ($review_data as $review): ?>
                            <?php if ($review['rating_value'] == 3): ?>
                                <?php $check_rating_3++; ?>
                                <div class="row pl-5">
                                    <div class="col-1">
                                        <img src="<?= base_url('dist/img/avatar7.png') ?>" alt="Circle Image"
                                            class="img-circle img-no-padding img-responsive" width="100%">
                                    </div>
                                    <div class="col-11">
                                        <p><strong>
                                                <?= $review['user_data']['name'] ?>
                                                <?= $review['user_data']['lastname'] ?>
                                            </strong></p>
                                        <?php for ($i = 0; $i < $review['rating_value']; $i++) { ?>
                                            <i class="fas fa-star" style="color: #FFD43B;"></i>
                                        <?php } ?>
                                        <?php for ($i = 0; $i < 5 - floor($review['rating_value']); $i++): ?>
                                            <i class="far fa-star"></i>
                                        <?php endfor; ?>
                                        <p class="description">
                                            <?= $review['date_time'] ?>
                                        </p>
                                        <p>
                                            <?= $review['comment'] ?>
                                        </p>
                                    </div>
                                </div>
                                <hr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if ($check_rating_3 == 0): ?>
                            <p>ยังไม่มีความคิดเห็น</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>ยังไม่มีความคิดเห็น</p>
                    <?php endif; ?>
                </div>
                <div class="tab-pane fade" id="tabContent5">
                    <?php if ($review_data): ?>
                        <?php $check_rating_2 = 0; ?>
                        <?php foreach ($review_data as $review): ?>
                            <?php if ($review['rating_value'] == 2): ?>
                                <?php $check_rating_2++; ?>
                                <div class="row pl-5">
                                    <div class="col-1">
                                        <img src="<?= base_url('dist/img/avatar7.png') ?>" alt="Circle Image"
                                            class="img-circle img-no-padding img-responsive" width="100%">
                                    </div>
                                    <div class="col-11">
                                        <p><strong>
                                                <?= $review['user_data']['name'] ?>
                                                <?= $review['user_data']['lastname'] ?>
                                            </strong></p>
                                        <?php for ($i = 0; $i < $review['rating_value']; $i++) { ?>
                                            <i class="fas fa-star" style="color: #FFD43B;"></i>
                                        <?php } ?>
                                        <?php for ($i = 0; $i < 5 - floor($review['rating_value']); $i++): ?>
                                            <i class="far fa-star"></i>
                                        <?php endfor; ?>
                                        <p class="description">
                                            <?= $review['date_time'] ?>
                                        </p>
                                        <p>
                                            <?= $review['comment'] ?>
                                        </p>
                                    </div>
                                </div>
                                <hr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if ($check_rating_2 == 0): ?>
                            <p>ยังไม่มีความคิดเห็น</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>ยังไม่มีความคิดเห็น</p>
                    <?php endif; ?>
                </div>
                <div class="tab-pane fade" id="tabContent6">
                    <?php if ($review_data): ?>
                        <?php $check_rating_1 = 0; ?>
                        <?php foreach ($review_data as $review): ?>
                            <?php if ($review['rating_value'] == 1): ?>
                                <?php $check_rating_1++; ?>
                                <div class="row pl-5">
                                    <div class="col-1">
                                        <img src="<?= base_url('dist/img/avatar7.png') ?>" alt="Circle Image"
                                            class="img-circle img-no-padding img-responsive" width="100%">
                                    </div>
                                    <div class="col-11">
                                        <p><strong>
                                                <?= $review['user_data']['name'] ?>
                                                <?= $review['user_data']['lastname'] ?>
                                            </strong></p>
                                        <?php for ($i = 0; $i < $review['rating_value']; $i++) { ?>
                                            <i class="fas fa-star" style="color: #FFD43B;"></i>
                                        <?php } ?>
                                        <?php for ($i = 0; $i < 5 - floor($review['rating_value']); $i++): ?>
                                            <i class="far fa-star"></i>
                                        <?php endfor; ?>
                                        <p class="description">
                                            <?= $review['date_time'] ?>
                                        </p>
                                        <p>
                                            <?= $review['comment'] ?>
                                        </p>
                                    </div>
                                </div>
                                <hr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if ($check_rating_1 == 0): ?>
                            <p>ยังไม่มีความคิดเห็น</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>ยังไม่มีความคิดเห็น</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function alert_(id_book) {
        var userData = <?php echo json_encode($userData); ?>;
        if (userData[0]['status_rental'] == 2) {
            Swal.fire({
                title: "คุณมีรายการเข้ารับหนังสืออยู่ โปรดคืนหนังสือก่อนเช่าใหม่อีกครั้ง",
                icon: 'warning',
                confirmButtonText: "ตกลง",
                showConfirmButton: true
            });

        } else if (userData[0]['status_rental'] == 3) {
            Swal.fire({
                title: "คุณกำลังเช่าหนังสืออยู่ โปรดคืนหนังสือก่อนเช่าใหม่อีกครั้ง",
                icon: 'warning',
                confirmButtonText: "ตกลง",
                showConfirmButton: true
            });
        } else {
            $.ajax({
                url: '<?= base_url('book/booklist/addcart/') ?>' + id_book,
                type: "POST",
                cache: false,
                processData: false,
                contentType: false,
                dataType: "JSON",
                beforeSend: function () {
                    // แสดงกำลังโหลด
                    Swal.fire({
                        title: "กำลังโหลด...",
                        onBeforeOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function (response) {
                    // ซ่อนกำลังโหลดหลังจากที่เสร็จสิ้น
                    Swal.close();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseleave = Swal.resumeTimer;
                            toast.addEventListener('click', () => {
                                // Navigate to the desired URL
                                window.location.href = "<?= site_url('/cart') ?>";
                            });
                        }
                    });
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                    if (response.success) {
                        Toast.fire({
                            icon: "success",
                            title: response.message
                        });
                        var bookDiv = document.getElementById('book_' + id_book);
                        bookDiv.style.display = 'none';
                    } else {
                        Toast.fire({
                            icon: "error",
                            title: response.message
                        });
                    }
                },
                error: function (xhr, status, error) {
                    // ซ่อนกำลังโหลดหลังจากที่เกิดข้อผิดพลาด
                    Swal.close();

                    Swal.fire({
                        title: "เกิดข้อผิดพลาด",
                        icon: 'error',
                        confirmButtonText: "ตกลง",
                        showConfirmButton: true
                    });
                }
            });

        }
    }
</script>
<script>
    function showAlert(text) {
        Swal.fire({
            icon: 'warning',
            title: 'แจ้งเตือน',
            text: text,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
    }
</script>
<script>
    function toggleActive(id) {
        var buttons = document.querySelectorAll('button[name="tab_"]');
        buttons.forEach(function (button) {
            if (button.id === id) {
                button.classList.add('active');
            } else {
                button.classList.remove('active');
            }
        });

        // ลบคลาส "active" ทั้งหมดออกจากเนื้อหา
        var contentElements = document.querySelectorAll('.tab-pane');
        contentElements.forEach(function (content) {
            content.classList.remove('active', 'show');
        });

        // เพิ่มคลาส "active" และ "show" ให้กับเนื้อหาที่ตรงกับปุ่มที่ถูกคลิก
        var targetContent = document.getElementById('tabContent' + id.substr(3)); // ตัด 'tab' ออกเพื่อให้เหลือเฉพาะตัวเลข
        if (targetContent) {
            targetContent.classList.add('active', 'show');
        }
    }
</script>