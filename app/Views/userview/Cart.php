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
                        <button class="btn btn-danger btn-round">ยกเลิก</button>
                    </div>
                </div>
            </div>
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
                <form>
                    <div class="form-group">
                        <table class="table" id="cartTable">
                        </table>
                        <table class="table">
                            <tr>
                                <th></th>
                                <td>
                                </td>
                                <td>
                                </td>
                                <th>โปรโมชั่น :</th>
                                <td>
                                    10 บาท
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                </td>
                                <td>
                                </td>
                                <th>ราคารวม :</th>
                                <td>
                                    10 บาท
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="label-control">เลิอกวันที่รับหนังสือ</label>
                                <input type="text" class="form-control datetimepicker" required />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="label-control">เลิอกวันที่คืน</label>
                                <input type="text" class="form-control datetimepicker" required />
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-block btn-round"> จอง</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('.datetimepicker').datetimepicker({
        icons: {
            time: "fa fa-clock-o",
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

</script>
<!-- Add this at the end of your HTML file, after including jQuery -->
<script>
    // Initialize cart_check as an empty array
    var cart_check = [];
    var price_sum = 0;
    if (cart_check.length === 0) {
        $("#button_modal").prop("disabled", true);
    } else {
        $("#button_modal").prop("disabled", false);
    }
    $(document).ready(function () {
        $('.form-check-input').on('change', function () {

            var value = $(this).val();
            var if_check = false;

            cart_check.forEach((element, index) => {
                if (element == value) {
                    if_check = true;
                    // Assuming you want to remove the duplicate element
                    cart_check.splice(index, 1);
                    categoryData.forEach(element_cat => {
                        if (element_cat.id_cart == element) {
                            price_sum = price_sum - parseInt(element_cat.bookData[0].price);

                        }
                    });
                }
            });

            // Add the value to the cart_check array if it's not already present
            if (!if_check) {
                cart_check.push(value);
                categoryData.forEach(element_cat => {
                    if (element_cat.id_cart == value) {
                        price_sum = price_sum + parseInt(element_cat.bookData[0].price);
                    }
                });
            }
            $("#price").text(price_sum);
            $("#quantity").text(cart_check.length);
            if (cart_check.length === 0) {
                $("#button_modal").prop("disabled", true);
            } else {
                $("#button_modal").prop("disabled", false);
            }
        });
    });

</script>
<script>
    function loadmodal() {
        var count = 0;
        $("#cartTable").empty();

        cart_check.forEach(element => {
            count++;
            categoryData.forEach(element_cat => {
                if (element_cat.id_cart == element) {
                    price_sum = price_sum - parseInt(element_cat.bookData[0].price);
                    var row1 = `
                        <tr>
                            <th>ลำดับ : ${count}</th>
                            <th>ชื่อหนังสือ : </th>
                            <td>${element_cat.bookData[0].name_book}</td>
                            <th>ราคา :</th>
                            <td>${element_cat.bookData[0].price}</td>
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
                            <td>${price_sum}</td>
                        </tr>
                        `;
        $("#cartTable").append(row2);
    }
</script>