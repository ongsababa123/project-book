<title>User History</title>
<link rel="stylesheet" href="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.css'); ?>">


<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>ประวัติการเช่าของ
                            <?= $data_user[0]['name'] . ' ' . $data_user[0]['lastname'] ?>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">ประวัติการเช่า</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card" id="history_user">
                            <div class="card-header">
                                <h2 class="card-title"></h2>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="mb-3" id="user_history" action="javascript:void(0)" method="post"
                                            enctype="multipart/form-data">
                                            <?php foreach ($data_history as $key => $value): ?>
                                                <div class="border mt-3" id="form_details_history">
                                                    <div class="col-sm-12 justify-content-between"
                                                        style="background-color: #f0f0f0;">
                                                        <label class="ml-3 mt-2">รายการที
                                                            <?= $key + 1 ?>
                                                        </label>
                                                        <?php
                                                        date_default_timezone_set('Asia/Bangkok'); // ตั้งค่าโซนเวลา
                                                        $today = strtotime(date("Y-m-d")); // รับวันที่ปัจจุบันและแปลงเป็น timestamp
                                                        $today = strtotime("midnight", $today); // ตั้งค่าเวลาเป็นเที่ยงคืน
                                                    
                                                        if ($value['submit_date'] === null) {
                                                            $returnDate = strtotime($value['return_date']); // รับวันที่คืนและแปลงเป็น timestamp
                                                            $returnDate = strtotime("midnight", $returnDate); // ตั้งค่าเวลาเป็นเที่ยงคืน
                                                    
                                                            if ($today > $returnDate) {
                                                                echo "<span class='badge bg-danger'>เกินกำหนด</span>";
                                                            } else {
                                                                echo "<span class='badge bg-warning'>กำลังยืม</span>";
                                                            }
                                                        } else {
                                                            echo "<span class='badge bg-success'>คืนแล้ว</span>";
                                                        }
                                                        ?>
                                                    </div>
                                                    <div>
                                                        <div>
                                                            <?php $data_history_values = explode(',', $value['id_book']);
                                                            $pice_total = 0;
                                                            ?>
                                                            <?php foreach ($data_history_values as $index => $element): ?>
                                                                <?php
                                                                $filtered_books = array_filter($data_book, function ($value_book) use ($element) {
                                                                    return $value_book['id_book'] === $element;
                                                                });
                                                                $matching_book = reset($filtered_books);
                                                                $pice_total = $pice_total + $matching_book['price'];

                                                                $filtered_category = array_filter($data_category, function ($value_category) use ($matching_book) {
                                                                    return $value_category['id_category'] === $matching_book['category_id'];
                                                                });
                                                                $matching_category = reset($filtered_category);
                                                                ?>
                                                                <div class="row mb-2 mt-2" id="form_details_image">
                                                                    <div class="col-sm-2 ml-3 text-center border">
                                                                        <a href="data:image/png;base64,<?= $matching_book['pic_book'] ?>"
                                                                            data-toggle="lightbox" id="image-preview-extra_1">
                                                                            <img class="img-fluid mb-2"
                                                                                src="data:image/png;base64,<?= $matching_book['pic_book'] ?>"
                                                                                alt="Book Cover 1" id="image-preview_1" />
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label>ชื่อหนังสือ</label>
                                                                                    <p type="text" id="price_book"
                                                                                        name="price_book">
                                                                                        <?= $matching_book['name_book'] ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label>หมวดหมู่</label>
                                                                                    <p type="text" id="price_late"
                                                                                        name="price_late">
                                                                                        <?= $matching_category['name_category'] ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label>ชื่อผู้แต่ง</label>
                                                                            <p>
                                                                                <?= $matching_book['book_author'] ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group">
                                                                            <label>ราคาหนังสือ</label>
                                                                            <p>
                                                                                <?= $matching_book['price'] ?> บาท
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                        <div class="col-sm-12" style="background-color:#f0f0f0;">
                                                            <div class="row ml-3">
                                                                <div class="col-sm-2 mt-3">
                                                                    <div class="form-group">
                                                                        <label>ยอดรวม</label>
                                                                        <p>
                                                                            <?= $pice_total ?> บาท
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2 mt-3">
                                                                    <div class="form-group">
                                                                        <label>ค่าปรับ</label>
                                                                        <?php
                                                                        $today = new DateTime(); // Get the current date
                                                                        $today->setTime(0, 0, 0, 0);
                                                                        $returnDate = new DateTime($value['return_date']);
                                                                        $returnDate->setTime(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0
                                                                        if ($value['submit_date'] === null) {
                                                                            if ($today > $returnDate) {
                                                                                $returnDate = new DateTime($value['return_date']);
                                                                                $currentDate = new DateTime();

                                                                                // Calculate the difference in days
                                                                                $timeDifference = $currentDate->getTimestamp() - $returnDate->getTimestamp();
                                                                                $daysDifference = ceil(($timeDifference / (60 * 60 * 24)) - 1);
                                                                                $priceFees = $data_latefees[0]['price_fees'];
                                                                                echo "<p>".$daysDifference * $priceFees."</p>";
                                                                            } else {
                                                                                echo " <p>ไม่มีค่าปรับ</p>";
                                                                            }
                                                                        } else {
                                                                            echo "<p>" . $value['late_price'] . "</p>";
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2 mt-3">
                                                                    <div class="form-group">
                                                                        <label>ส่วนลด</label>
                                                                        <?php if ($value['sum_price_promotion'] === null): ?>
                                                                            <p>ไม่มีมีส่วนลด</p>
                                                                        <?php else: ?>
                                                                            <p>
                                                                                <?= $value['sum_price_promotion'] ?> บาท
                                                                            </p>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 mt-3">
                                                                    <div class="form-group">
                                                                        <label>ยอดรวม(ทั้งหมด)</label>
                                                                        <p>
                                                                            <?= $value['sum_price'] ?> บาท
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                        <?php
                                                                        date_default_timezone_set('Asia/Bangkok'); // Set the time zone
                                                                        $today = strtotime(date("Y-m-d")); // Get the current date and convert it to a timestamp
                                                                        $today = strtotime("midnight", $today); // Set the time to midnight
                                                                    
                                                                        if ($value['submit_date'] === null) {
                                                                            $returnDate = strtotime($value['return_date']); // Get the return date and convert it to a timestamp
                                                                            $returnDate = strtotime("midnight", $returnDate); // Set the time to midnight
                                                                    
                                                                            if ($today > $returnDate) {
                                                                                echo '<a class="btn btn-app bg-danger mt-3" onclick="showAlert()">';
                                                                                echo '<i class="fas fa-print"></i> พิมพ์ใบเสร็จ</a>';
                                                                            } else {
                                                                                echo '<a class="btn btn-app bg-danger mt-3" onclick="showAlert()">';
                                                                                echo '<i class="fas fa-print"></i> พิมพ์ใบเสร็จ</a>';
                                                                            }
                                                                        } else {
                                                                            echo '<a class="btn btn-app bg-danger mt-3" href="' . site_url('dashboard/history/billview/' . $value['id_history']) . '" target="_blank">';
                                                                            echo '<i class="fas fa-print"></i> พิมพ์ใบเสร็จ</a>';
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $pice_total = 0; ?>
                                            <?php endforeach; ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="overlay dark">
                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="<?= base_url('plugins/filterizr/jquery.filterizr.min.js') ?>"></script>
    <script src="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.min.js') ?>"></script>
    <script>
        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function (event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.btn[data-filter]').on('click', function () {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>
    <script>
        var data_history = <?php echo json_encode($data_history); ?>;
        var data_user = <?php echo json_encode($data_user); ?>;
        var data_book = <?php echo json_encode($data_book); ?>;
        var data_category = <?php echo json_encode($data_category); ?>;

    </script>
    <script>
        $(document).ready(function () {
            $("#history_user .overlay").hide();
        });
    </script>
    <script>
        function action_(url, form) {
            var formData = new FormData(document.getElementById(form));
            $.ajax({
                url: '<?= base_url() ?>' + url,
                type: "POST",
                cache: false,
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                        Swal.fire({
                            title: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                        setTimeout(() => {
                            if (response.reload) {
                                window.location.reload();
                            }
                        }, 2000);
                    } else {
                        if (response.validator) {
                            var mes = "";
                            if (response.validator.email) {
                                mes += 'ช่องอีเมลจะต้องมีที่อยู่อีเมลที่ถูกต้องหรือมีอีเมล์ซ้ำในระบบ.' + '<br><hr/>'
                            }
                            if (response.validator.name) {
                                mes += 'ชื่อต้องมีอย่างน้อย 2 ตัว.' + '<br><hr/>';
                            }
                            if (response.validator.last) {
                                mes += 'นามสกุลต้องมีอย่างน้อย 2 ตัว.' + '<br><hr/>';
                            }
                            if (response.validator.phone) {
                                mes += 'เบอร์ติดต่อต้องมี 10 หลัก.' + '<br>';
                            }
                            Swal.fire({
                                title: mes,
                                icon: 'error',
                                showConfirmButton: true,
                                width: '55%'
                            });
                        } else {
                            Swal.fire({
                                title: response.message,
                                icon: 'error',
                                showConfirmButton: true
                            });
                        }
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        title: "เกิดข้อผิดพลาด",
                        icon: 'error',
                        showConfirmButton: true
                    });
                }
            });
        }
    </script>
    <script>
        function confirm_Alert(text, url) {
            Swal.fire({
                title: text,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                confirmButtonText: "submit",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>' + url,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }).done(function (response) {
                        // console.log(response);
                        if (response.success) {
                            Swal.fire({
                                title: response.message,
                                icon: 'success',
                                showConfirmButton: false
                            });
                            setTimeout(() => {
                                if (response.reload) {
                                    window.location.reload();
                                }
                            }, 2000);
                        } else {
                            Swal.fire({
                                title: response.message,
                                icon: 'error',
                                showConfirmButton: true
                            });
                        }
                    });
                }
            });
        }
    </script>
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