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
?>
<div class="main">
    <br>
    <div class="section text-center ">
        <div class="container">
            <div class="card page-carousel">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="<?= base_url('dist/img/promotion1.jpg') ?>"
                                alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="<?= base_url('dist/img/promotion2.jpg') ?>"
                                alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="<?= base_url('dist/img/promotion3.jpg') ?>"
                                alt="Third slide">
                        </div>
                    </div>
                    <a class="left carousel-control carousel-control-prev" href="#carouselExampleIndicators"
                        role="button" data-slide="prev">
                        <span class="fa fa-angle-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control carousel-control-next" href="#carouselExampleIndicators"
                        role="button" data-slide="next">
                        <span class="fa fa-angle-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-2" style="background-color: #bddce5;">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="form_category" style="color: white;">หมวดหมู่</label>
                        <select class="form-control" id="form_category">
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group mt-4" id="form_search">
                            <a href="#" onclick="sortItems('newest')">
                                <button class="btn btn-success btn-round" onclick="sortItems()">
                                    ค้นหา
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section bg-info text-center">
        <div class="container">
            <div class="row">
                <?php $count = 0; ?>
                <?php
                function generateBookCard($book)
                {
                    // Assuming $book['pic_book'] contains the base64-encoded image data
                    $imageSrc = base_url('dist/img/image-preview.png');

                    if ($book['pic_book'] !== null) {
                        $base64Data = $book['pic_book'];
                        $decodedData = base64_decode($base64Data);
                        $imageSrc = 'data:image/png;base64,' . base64_encode($decodedData);
                    }

                    $details_book = $book['details'];
                    $encoding = mb_detect_encoding($details_book, 'UTF-8,ISO-8859-1');
                    $details_book = mb_convert_encoding($details_book, 'UTF-8', $encoding);
                    $shortenedDetails = strlen($details_book) > 450 ? htmlspecialchars(mb_substr($details_book, 0, 450) . '...', ENT_QUOTES, 'UTF-8') : htmlspecialchars($details_book, ENT_QUOTES, 'UTF-8');

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
                            </div>
                            <div class="card-footer">
                                <a href="<?= site_url('/book/details/') . $book['id_book'] ?>"
                                    class="btn btn-info btn-round">เพิ่มเติม</a>
                                <button class="btn btn-danger btn-round" onclick="alert_(<?= $book['id_book'] ?>)"><i
                                        class="fas fa-cart-arrow-down"></i>
                                    ใส่ตระกร้าเลย</button>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                if(!empty($bookData)):
                foreach ($bookData as $key => $value):
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
        window.location.href = `?sort=${id_category}`;
    }
</script>
<script>
    function alert_(id_book) {
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
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
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
</script>