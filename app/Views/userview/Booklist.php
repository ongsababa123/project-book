<title>Book List</title>
<style>
    .page-item.active .page-link {
        background-color: #2eb6dd;
        color: white;
        border-color: #2eb6dd;
    }

    .pagination>li>a:hover,
    .pagination>li>a:focus,
    .pagination>li>a:active,
    .pagination>li.active>a,
    .pagination>li.active>span,
    .pagination>li.active>a:hover,
    .pagination>li.active>span:hover,
    .pagination>li.active>a:focus,
    .pagination>li.active>span:focus {
        background-color: #2eb6dd;
        border-color: #2eb6dd;
        color: #FFFFFF;
    }

    .pagination>li>a,
    .pagination>li>span,
    .pagination>li:first-child>a,
    .pagination>li:first-child>span,
    .pagination>li:last-child>a,
    .pagination>li:last-child>span {
        background-color: transparent;
        border: 2px solid #4da3bb;
        border-radius: 20px;
        color: #2eb6dd;
        height: 36px;
        margin: 0 2px;
        min-width: 36px;
        padding: 8px 12px;
        font-weight: 600;
    }
</style>
<?php
$sortOrder = '0'; // Set a default value

if (isset($_GET['sort'])) {
    $sortOrder = $_GET['sort'];
}

$searchTerm = isset($_GET['searchBook']) ? $_GET['searchBook'] : '';

// Assuming $bookData is an array of books and $categories is an array of categories
$filteredBooks = array_filter($bookData, function ($book) use ($searchTerm) {
    return stripos($book['name_book'], $searchTerm) !== false || empty($searchTerm);
});

?>

<div class="main">
    <br>
    <div class="section text-center ">
        <div class="container">
            <div class="card page-carousel">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php foreach ($promotionData as $index => $promotion): ?>
                            <li data-target="#carouselExampleIndicators" data-slide-to="<?= $index ?>"
                                class="<?= $index === 0 ? 'active' : '' ?>"></li>
                        <?php endforeach; ?>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <?php foreach ($promotionData as $index => $promotion): ?>
                            <?php
                            $imagepromotionSrc = base_url('dist/img/image-preview.png');

                            // Check if the promotion has an image
                            if ($promotion['image_promotion'] !== null) {
                                $base64Data = $promotion['image_promotion'];
                                $decodedData = base64_decode($base64Data);
                                $imagepromotionSrc = 'data:image/png;base64,' . base64_encode($decodedData);
                            }
                            ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <img class="d-block img-fluid" src="<?= $imagepromotionSrc ?>"
                                    alt="Slide <?= $index + 1 ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="py-2" style="background-color: #bddce5;">
        <div class="container">
            <form action="<?= base_url('book/booklist') ?>" method="get" name="bookForm">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="form_category" style="color: white;">หมวดหมู่</label>
                            <select class="form-control" id="form_category" name="form_category">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="searchBook" style="color: white;">ค้นหาชื่อหนังสือ</label>
                            <input type="text" class="form-control" id="searchBook" name="searchBook"
                                placeholder="ค้นหาหนังสือ" value="<?= $searchTerm ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="input-group mt-4" id="form_search">
                                <button type="button" class="btn btn-success btn-round" onclick="sortItems()">
                                    ค้นหา
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="section bg-info text-center">
        <div class="container">
            <div class="row">
                <?php $count = 0; ?>
                <?php

                function generateBookCard($book)
                {
                    // Set default image source
                    $imageSrc = base_url('dist/img/image-preview.png');

                    // Check if the book has an image
                    if ($book['pic_book'] !== null) {
                        $base64Data = $book['pic_book'];
                        $decodedData = base64_decode($base64Data);
                        $imageSrc = 'data:image/png;base64,' . base64_encode($decodedData);
                    }

                    // Set status and details_book
                    $status = ($book['status_book'] == 2) ? 'disabled' : '';
                    $details_book = $book['details'];
                    $encoding = mb_detect_encoding($details_book, 'UTF-8,ISO-8859-1');
                    $details_book = mb_convert_encoding($details_book, 'UTF-8', $encoding);

                    // Shorten details_book
                    $shortenedDetails = strlen($details_book) > 50 ?
                        htmlspecialchars(mb_substr($details_book, 0, 50) . '...', ENT_QUOTES, 'UTF-8') :
                        htmlspecialchars($details_book, ENT_QUOTES, 'UTF-8');

                    // Render the HTML card
                    ?>
                    <div class="col-md-4" id="book_<?= $book['id_book'] ?>">
                        <div class="card mb-4">
                            <img class="card-img-top" src="<?= $imageSrc ?>" alt="Card image cap" style="height: 25rem;">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?= $book['name_book'] ?>
                                </h5>
                                <p class="card-text">
                                    <?= $shortenedDetails ?>
                                </p>
                                <?php if ($book['status_book'] == 1): ?>
                                    <span class="badge badge-pill badge-success">พร้อมเช่า</span>
                                <?php else: ?>
                                    <span class="badge badge-pill badge-danger">กำลังเช่าอยู่</span>
                                <?php endif; ?>
                            </div>
                            <div class="card-footer">
                                <?php if (session()->get('isLoggedIn')): ?>
                                    <a href="<?= site_url('/book/details/') . $book['id_book'] ?>"
                                        class="btn btn-info btn-round">เพิ่มเติม</a>
                                    <button class="btn btn-danger btn-round" onclick="alert_(<?= $book['id_book'] ?>)"
                                        <?= $status ?>>
                                        <i class="fas fa-cart-arrow-down"></i> ใส่ตระกร้าเลย
                                    </button>
                                <?php else: ?>
                                    <a href="<?= site_url('/book/details/') . $book['id_book'] ?>"
                                        class="btn btn-info btn-round">เพิ่มเติม</a>
                                    <button class="btn btn-danger btn-round" onclick="showAlert('กรุณาล็อคอินก่อนเลือกสินค้า')"
                                        <?= $status ?>>
                                        <i class="fas fa-cart-arrow-down"></i> ใส่ตระกร้าเลย
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }


                if (!empty($filteredBooks)):
                    foreach ($filteredBooks as $key => $value):
                        if ($sortOrder === '0' || $value['category_id'] === $sortOrder):
                            generateBookCard($value);
                            $count++;
                        endif;
                    endforeach;
                else:
                    ?>
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">
                                    ไม่พบข้อมูล
                                </h5>
                            </div>
                        </div>
                    </div>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var categoryData = <?php echo json_encode($categoryData); ?>;
        var newOption = $('<option>').val(0).text("ทั้งหมด");
        $("#form_category").append(newOption);
        var sort_category = "<?php echo $sortOrder; ?>";

        categoryData.forEach(element_cat => {
            if (element_cat.status == 1) {
                if (sort_category == element_cat.id_category) {
                    newOption = $('<option>').val(element_cat.id_category).text(element_cat.name_category);
                    $("#form_category").append(newOption.prop('selected', true));
                } else {
                    newOption = $('<option>').val(element_cat.id_category).text(element_cat.name_category);
                    $("#form_category").append(newOption);
                }
            }
        });
    });
</script>
<script>
    function sortItems() {
        var id_category = document.getElementById("form_category").value;
        var searchTerm = document.getElementById("searchBook").value;

        // Adjust the URL based on your requirements
        window.location.href = `?sort=${id_category}&searchBook=${searchTerm}`;
    }
</script>
<script>
    function alert_(id_book) {
        var userData = <?php echo json_encode($userData); ?>;
        if (userData[0]['status_user'] == 3) {
            Swal.fire({
                title: "คุณมีรายการเกินกำหนด โปรดคืนหนังสือก่อน",
                icon: 'warning',
                showConfirmButton: true
            });
        
        }else if(userData[0]['status_user'] == 2){
            Swal.fire({
                title: "คุณกำลังเช่าหนังสืออยู่ โปรดคืนหนังสือก่อนเช่าใหม่อีกครั้ง",
                icon: 'warning',
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
                success: function (response) {
                    var bookDiv = document.getElementById('book_' + id_book);
                    bookDiv.style.display = 'none';
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

                    Toast.fire({
                        icon: "success",
                        title: response.message
                    });

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