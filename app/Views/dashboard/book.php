<title>ข้อมูลหนังสือ</title>
<link rel="stylesheet" href="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.css'); ?>">
<?php
$searchTerm = isset($_GET['searchBook']) ? $_GET['searchBook'] : '';

$filteredBooks = array_filter($bookData, function ($book) use ($searchTerm) {
    return stripos($book['name_book'], $searchTerm) !== false || empty($searchTerm);
});
?>

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>ข้อมูลหนังสือ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('/dashboard/index'); ?>">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">ข้อมูลหนังสือ</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <form action="<?= base_url('dashboard/book/index/') ?>" method="get">
                                        <div class="row">
                                            <div class="col-10 text-center">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="searchBook"
                                                        name="searchBook" placeholder="ค้นหาหนังสือ" value="<?= $searchTerm ?>">
                                                </div>
                                            </div>
                                            <div class="col-2 text-center">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </h4>
                                <div class="card-tools">
                                    <?php if (session()->get('type') == '2'): ?>
                                        <button type="button" class="btn btn-block-tool btn-success btn-sm"
                                            data-toggle="modal" data-target="#modal-default"
                                            onclick="load_modal(1)">สร้างหนังสือ</button>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <div class="row">
                                    <?php if (!$filteredBooks): ?>
                                        <div class="col-12 text-center">
                                            <h1 class="text-center">ไม่พบข้อมูล</h1>
                                        </div>
                                    <?php else: ?>
                                        <?php foreach ($filteredBooks as $index => $book): ?>
                                            <div class="col-sm-2 text-center border m-3">
                                                <?php
                                                // Assuming $book['pic_book'] contains the base64-encoded image data
                                                if ($book['pic_book'] === null) {
                                                    $imageSrc = base_url('dist/img/image-preview.png');
                                                } else {
                                                    $base64Data = $book['pic_book'];
                                                    $decodedData = base64_decode($base64Data);
                                                    $imageSrc = 'data:image/png;base64,' . base64_encode($decodedData);
                                                }
                                                ?>
                                                <a href="<?= $imageSrc ?>" data-toggle="lightbox"
                                                    data-title="<?= $book['name_book'] ?>" data-gallery="gallery">
                                                    <img src="<?= $imageSrc ?>" class="img-fluid mb-2" alt="white sample" />
                                                    <?php if ($book['status_book'] == 0) {
                                                        echo "<span class='badge bg-danger'>ยังไม่พร้อมใช้งาน</span>";
                                                    } elseif ($book['status_book'] == 1) {
                                                        echo "<span class='badge bg-success'>พร้อมใช้งาน</span>";
                                                    } elseif ($book['status_book'] == 2) {
                                                        echo "<span class='badge bg-info'>กำลังเช่า</span>";
                                                    } ?>
                                                    <br>
                                                    <a>ชื่อหนังสือ :
                                                        <?= $book['name_book'] ?>
                                                    </a><br>
                                                    <a>ชื่อผู้แต่ง :
                                                        <?= $book['book_author'] ?>
                                                    </a><br>
                                                    <a>ราคาเช่า :
                                                        <?= $book['price'] ?>
                                                    </a><br>
                                                    <a>ราคาหนังสือ :
                                                        <?= $book['price_book'] ?>
                                                    </a><br>
                                                    <button type="button" class="btn btn-block-tool btn-info btn-sm mb-2"
                                                        data-toggle="modal" data-target="#modal-default"
                                                        onclick="load_modal(2, <?= $index ?>)">รายละเอียด</button>
                                                    <?php if (session()->get('type') == '2'): ?>
                                                        <button type="button" class="btn btn-block-tool btn-danger btn-sm mb-2"
                                                            onclick="confirm_Alert('ต้องการลบข้อมูลใช่หรือไม่ ?' , 'dashboard/book/delete/<?= $book['id_book'] ?>')">ลบข้อมูล</button>
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <div class="modal fade" id="modal-default">
        <div id="CRUD_Book">
            <?= $this->include("modal/CRUD_Book"); ?>
        </div>
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
        function load_modal(load_check, data_encode) {
            CRUD_Book = document.getElementById("CRUD_Book");
            var categoryData = <?php echo json_encode($categoryData); ?>;
            $(".modal-body #categorySelect").empty();
            $(".modal-body #name_book").val('');
            $(".modal-body #name_book_author").val('');
            $(".modal-body #detail_category").val('');
            $(".modal-body #price_book").val('');
            $(".modal-body #price_book_book").val('');
            $(".modal-body #uploadImage").val('');
            $(".modal-body #image-preview").attr("src", '<?= base_url("dist/img/image-preview.png"); ?>');
            $(".modal-body #image-preview-extra").attr("href", '<?= base_url("dist/img/image-preview.png"); ?>');
            if (load_check == 1) {
                CRUD_Book.style.display = "block";
                $(".modal-body #customSwitch").hide();
                categoryData.forEach(element_cat => {
                    if (element_cat.status == 1) {
                        var newOption = $('<option>').val(element_cat.id_category).text(element_cat.name_category);
                        $(".modal-body #categorySelect").append(newOption);
                    }
                });
                $(".modal-header #title_modal").text("สร้างข้อมูลหนังสือ");
                $(".modal-footer #submit").text("สร้างข้อมูลหนังสือ");
                $(".modal-body #url_route").val("dashboard/book/create");
            } else if (load_check == 2) {
                CRUD_Book.style.display = "block";
                var rowData = <?php echo json_encode($bookData) ?>[data_encode];
                categoryData.forEach(element_cat => {
                    var newOption = $('<option></option>').val(element_cat.id_category).text(element_cat.name_category);
                    if (element_cat.id_category == rowData.category_id) {
                        $(".modal-body #categorySelect").append(newOption.prop('selected', true));
                    } else {
                        if (element_cat.status == 1) {
                            $(".modal-body #categorySelect").append(newOption);
                        }
                    }
                });
                $(".modal-body #customSwitch").show();
                if (rowData.status_book == 1) {
                    $(".modal-body #customSwitch3").prop('checked', true);
                    $(".modal-body #LabelcustomSwitch3").text("เปิดใช้งาน");
                } else {
                    $(".modal-body #customSwitch3").prop('checked', false);
                    $(".modal-body #LabelcustomSwitch3").text("ปิดใช้งาน");
                }
                $(".modal-body #name_book").val(rowData.name_book);
                $(".modal-body #name_book_author").val(rowData.book_author);
                $(".modal-body #detail_category").val(rowData.details);
                $(".modal-body #price_book").val(rowData.price);
                $(".modal-body #price_book_book").val(rowData.price_book);
                if (rowData.pic_book == null) {
                    var imageSrc = '<?= base_url("dist/img/image-preview.png"); ?>';
                } else {
                    var imageSrc = "data:image/png;base64," + rowData.pic_book;
                }
                $(".modal-body #image-preview").attr("src", imageSrc);
                $(".modal-body #image-preview-extra").attr("href", imageSrc);
                $(".modal-header #title_modal").text("แก้ไขข้อมูลหนังสือ");
                $(".modal-footer #submit").text("แก้ไขข้อมูลหนังสือ");
                $(".modal-body #url_route").val("dashboard/book/edit/" + rowData.id_book);
            }
        }
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
                        Swal.fire({
                            title: response.image_error,
                            icon: 'error',
                            showConfirmButton: true,
                            width: '55%'
                        });
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