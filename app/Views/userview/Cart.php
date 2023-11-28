<title>Cart</title>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
<style>
    .center {
        padding: 100px 0;
        padding-left: 30px;
        padding-top: 10rem;
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
                <h1>ตระกร้าของฉัน</h1>
                <br />
                <a href="<?= site_url('/book/booklist') ?>" class="btn btn-outline-neutral btn-round"><i
                        class="fas fa-cart-plus"></i>
                    จองหนังสือเพิ่ม</a>
            </div>
        </div>
    </div>
    <div class="section mb-6" style="background-color: #bddce5;">
        <div class="container ">
            <?php if (!empty($cartData)): ?>
                <?php foreach ($cartData as $cartItem): ?>
                    <div class="p-4 border mb-3" style="background-color: white;">
                        <div class="row">
                            <div class="center">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="<?= $cartItem['id_cart'] ?>">
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php foreach ($cartItem['bookData'] as $book): ?>
                                <?php
                                $imageSrc = base_url('dist/img/image-preview.png');

                                if ($book['pic_book'] !== null) {
                                    $base64Data = $book['pic_book'];
                                    $decodedData = base64_decode($base64Data);
                                    $imageSrc = 'data:image/png;base64,' . base64_encode($decodedData);
                                }
                                ?>
                            <?php endforeach; ?>
                            <div class="col-lg-5 col-md-12 text-center">
                                <img src="<?= $imageSrc ?>" class="img-rounded img-responsive" alt="Rounded Image"
                                    style="height: 25rem;">
                            </div>
                            <div class="col-lg-6">
                                <p style="font-size: 2vw;">
                                    <?= $book['name_book'] ?>
                                </p>
                                <h6 class="description">ผู้เขียน</h6>
                                <p class="description">
                                    <?= $book['book_author'] ?>
                                </p>
                                <h6 class="description">ประเภท</h6>
                                <p class="description">
                                    <?php foreach ($cartItem['categoryData'] as $category): ?>
                                        <?php
                                        echo $category['name_category'];
                                        ?>
                                    <?php endforeach; ?>
                                </p>
                                <h6 class="description">รายละเอียด</h6>
                                <p class="description">
                                    <?= $book['details'] ?>
                                </p>
                                <h6 ราคา class="description">ราคา</h6>
                                <?= $book['price'] ?>
                                <h6 ราคา class="description">วันที่กดเข้าตระกร้า</h6>
                                <?= $cartItem['cart_date'] ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="p-4 border mb-3" style="background-color: white;">
                    <div class="row">
                        <div class="col-lg-4 mt-2">
                            <h6>จำนวน : </h6>
                            <p id="quantity"></p>
                        </div>
                        <div class="col-lg-4 mt-2">
                            <h6>ราคารวม : </h6>
                            <p id="price"></p>
                        </div>
                        <div class="col-lg-2">
                            <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#Payment"
                                onclick="loadmodal()" id="button_modal" name="button_modal">ดำเนินการจอง</button>
                        </div>
                        <div class="col-lg-2">
                            <button class="btn btn-danger btn-round" onclick="confirm_Alert()" id="button_cancel" name="button_cancel">ยกเลิก</button>
                        </div>
                    </div>
                </div>
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
<div class="modal fade " id="Payment" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header no-border-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h1 class="text-muted">ยืนยันการจอง</h1>
                <div class="social-line text-center">
                    <img src="<?= base_url('dist/img/logo11.png') ?>" width="50%">
                </div>
            </div>
            <div class="modal-body">
                <form class="mb-3" id="form_create_history_cart" action="javascript:void(0)" method="post"
                    enctype="multipart/form-data">
                    <div class="form-group">
                        <table class="table" id="cartTable">
                        </table>
                        <table class="table" id="promotionTable">
                            <tr>
                                <th>โปรโมชั่น :</th>
                                <td id="details_promotion"></td>
                                <td></td>
                                <th>ส่วนลด :</th>
                                <td id="sum_price_promotion"></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td></td>
                                <td></td>
                                <th>ราคารวม :</th>
                                <td id="sum_price"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="label-control">เลิอกวันที่รับหนังสือ</label>
                                <input type="text" class="form-control datetimepicker" required id="rental_date_create"
                                    name="rental_date_create" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="label-control">เลิอกวันที่คืน</label>
                                <input type="text" class="form-control datetimepicker" required id="return_date_create"
                                    name="return_date_create" />
                            </div>
                        </div>
                    </div>
                    <input type="text" class="form-control" id="name_user_create" name="name_user_create" value="<?= session()->get('id')?>" hidden>
                    <input type="text" class="form-control" id="price_book_create" name="price_book_create" hidden>
                    <input type="text" class="form-control" id="id_book_create" name="id_book_create">
                    <input type="text" class="form-control" id="sumid_promotion" name="sumid_promotion" hidden>
                    <input type="text" class="form-control" id="sum_price_promotion" name="sum_price_promotion" hidden>
                    <input type="text" class="form-control" id="cart_id" name="cart_id" hidden>
                    <input type="text" id="url_route" name="url_route" hidden>
                    <button class="btn btn-block btn-round"> จอง</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->include("Check_pro"); ?>
<script>

    $("#form_create_history_cart").on('submit', function (e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_create_history_cart');
    });
</script>
<script>
    $('.datetimepicker').datetimepicker({
        format: 'L', // Display only the date
        icons: {
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        }
    });
</script>
<script>
    var categoryData = <?php echo json_encode($cartData); ?>;
    var cart_check = [];
    var id_book_check = '';
    var price_sum = 0;
    if (cart_check.length === 0) {
        $("#button_cancel").prop("disabled", true);
        $("#button_modal").prop("disabled", true);
    } else {
        $("#button_cancel").prop("disabled", false);
        $("#button_modal").prop("disabled", false);
    }
    $(document).ready(function () {
        $('.form-check-input').on('change', function () {

            var value = $(this).val();
            var if_check = false;

            cart_check.forEach((element, index) => {
                if (element == value) {
                    if_check = true;
                    cart_check.splice(index, 1);
                    categoryData.forEach(element_cat => {
                        if (element_cat.id_cart == element) {
                            price_sum = price_sum - parseInt(element_cat.bookData[0].price);
                            id_book_check = id_book_check.replace(element_cat.bookData[0].id_book + ',', '');
                        }
                    });
                }
            });
            if (!if_check) {
                cart_check.push(value);
                categoryData.forEach(element_cat => {
                    if (element_cat.id_cart == value) {
                        price_sum = price_sum + parseInt(element_cat.bookData[0].price);
                        id_book_check += element_cat.bookData[0].id_book + ',';
                    }
                });
            }

            $("#price").text(price_sum);
            $("#quantity").text(cart_check.length);
            if (cart_check.length === 0) {
                $("#button_cancel").prop("disabled", true);
                $("#button_modal").prop("disabled", true);
            } else {
                $("#button_cancel").prop("disabled", false);
                $("#button_modal").prop("disabled", false);
            }
        });
    });

</script>
<script>
    function loadmodal() {
        var count = 0;
        $("#cartTable").empty();
        var selectedid_book = cart_check;
        var price__ = price_sum;
        var id_user = 1;
        cart_check.forEach(element => {
            count++;
            categoryData.forEach(element_cat => {
                if (element_cat.id_cart == element) {
                    var row1 = `
                        <tr>
                            <th>ลำดับ : ${count}</th>
                            <th>ชื่อหนังสือ : </th>
                            <td>${element_cat.bookData[0].name_book}</td>
                            <th>ราคา :</th>
                            <td>${element_cat.bookData[0].price} บาท</td>
                        </tr>
                        `;
                    $("#cartTable").append(row1);
                }
            });
        });
        var row2 = `
                        <tr>
                            <th></th>
                            <th></th>
                            <td></td>
                            <th>ราคารวม :</th>
                            <td>${price_sum} บาท</td>
                        </tr>
                        `;
        $("#cartTable").append(row2);
        check_promotion(id_user, selectedid_book, price__, function (result) {
            if (result.text == null) {
                $("#details_promotion").html("ไม่มีส่วนลดโปรโมชั่น");
            } else {
                $("#details_promotion").html(result.text);
            }
            $("#sum_price_promotion").html(result.price_promotion + ' ' + 'บาท');
            $("#sum_price").html(result.price_result + ' ' + 'บาท');
            $(".modal-body #price_book_create").val(result.price_result);
            $(".modal-body #sumid_promotion").val(result.sumid_promotion);
            $(".modal-body #sum_price_promotion").val(result.price_promotion);

        });
        $(".modal-body #cart_id").val(cart_check);
        $(".modal-body #url_route").val("dashboard/history/create");
    }
</script>
<script>
    function action_(url, form) {
        var formData = new FormData(document.getElementById(form));
        if (id_book_check.endsWith(',')) {
            id_book_check = id_book_check.slice(0, -1);
        }
        if (form == 'form_create_history_cart') {
            formData.append('name_book_create__', id_book_check);
            formData.append('sumid_promotion', $('#sumid_promotion').val());
            formData.append('cart_id', $('#cart_id').val());
        }
        $.ajax({
            url: '<?= base_url() ?>' + url,
            type: "POST",
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function (response) {
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
    function confirm_Alert() {
        Swal.fire({
            title: 'ต้องการยกเลิกตระกร้าหรือไม่?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "submit",
        }).then((result) => {
            if (result.isConfirmed) {
                var formData = new FormData();
                formData.append('name_book_create__', id_book_check);
                formData.append('cart_id', cart_check);

                $.ajax({
                    url: '<?= base_url('dashboard/history/cartcancel') ?>',
                    type: "POST",
                    cache: false,
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "JSON",
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).done(function (response) {
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