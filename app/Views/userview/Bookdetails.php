<title>Details Book</title>
<style>
    .center {
        padding: 100px 0;
        padding-left: 30px;
        text-align: center;
    }
</style>
<div class="main" style="background-color: #bddce5;">
    <br>
    <div class="section mb-6 px-3" style="background-color: #bddce5; padding-bottom: 14rem;">
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
                    $status = ($bookData[0]['status_book'] == 2) ? 'disabled' : '';
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
                    <br>
                    <?php if (session()->get('isLoggedIn')): ?>
                        <button class="btn btn-danger btn-round" onclick="alert_(<?= $bookData[0]['id_book'] ?>)"
                            id="button_book" <?= $status ?>>
                            <i class="fas fa-cart-arrow-down"></i> ใส่ตระกร้าเลย
                        </button>
                    <?php else: ?>
                        <button class="btn btn-danger btn-round" onclick="showAlert('กรุณาล็อคอินก่อนเลือกสินค้า')"
                            <?= $status ?>><i class="fas fa-cart-arrow-down"></i>
                            ใส่ตระกร้าเลย</button>
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