<title>Cart</title>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
<style>
    .center {
        padding: 5px 0;
        padding-left: 20px;
        padding-top: rem;
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
                            <div class="col-lg-1">
                                <div class="center">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox"
                                                    value="<?= $cartItem['id_cart'] ?>">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php foreach ($cartItem['bookData'] as $book): ?>

                            <?php endforeach; ?>
                            <div class="col-lg-11">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <h6 class="description">ชื่อหนังสือ</h6>
                                        <p class="description">
                                            <?= $book['name_book'] ?>
                                        </p>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6 ราคา class="description">ราคาเช่า</h6>
                                        <?= $book['price'] ?>
                                    </div>
                                    <div class="col-sm-2">
                                        <h6 ราคา class="description">วันที่กดเข้าตระกร้า</h6>
                                        <?= $cartItem['cart_date'] ?>
                                    </div>
                                </div>
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

                        </div>
                        <div class="col-lg-2">
                            <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#Payment"
                                onclick="loadmodal()" id="button_modal" name="button_modal">ดำเนินการจอง</button>
                        </div>
                        <div class="col-lg-2">
                            <button class="btn btn-danger btn-round" onclick="confirm_Alert()" id="button_cancel"
                                name="button_cancel">ยกเลิก</button>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="section mb-6" style="background-color: #bddce5; padding-bottom: 10rem;">
                    <div class="container ">
                        <h1 class="text-center">ไม่มีประวัติในตระกร้า</h1>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="modal fade " id="Payment" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-xl">
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
                                <th>ค่ามัดจำ :</th>
                                <td id="sum_price_deposit"></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td></td>
                                <td></td>
                                <th>ราคารวม(ค่ามัดจำและหักส่วนลด) :</th>
                                <td id="sum_price"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="label-control">เลือกวันที่รับหนังสือ</label>
                                <input type="text" class="form-control datetimepicker" required id="rental_date_create"
                                    name="rental_date_create" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="label-control">เลือกวันที่คืน</label>
                                <input type="text" class="form-control datetimepicker" required id="return_date_create"
                                    name="return_date_create" />
                            </div>
                        </div>
                    </div>
                    <input type="text" id="sumid_promotion" name="sumid_promotion" hidden>
                    <input type="text" id="name_book_create__" name="name_book_create__" hidden>
                    <input type="text" id="name_user_create" name="name_user_create" hidden>
                    <input type="text" id="cart_id" name="cart_id" hidden>
                    <input type="text" id="price_book_create" name="price_book_create" hidden>
                    <input type="text" id="price_deposit_" name="price_deposit_" hidden>
                    <input type="text" id="sum_price_promotion" name="sum_price_promotion" hidden>
                    <input type="text" id="id_stock_book" name="id_stock_book" hidden>
                    <input type="text" id="url_route" name="url_route" hidden>
                    <button class="btn btn-block btn-round"> จอง</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->include("calculate"); ?>
<script>

    $("#form_create_history_cart").on('submit', function (e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_create_history_cart');
    });
</script>
<script>
    var data_dayrent = <?php echo json_encode($data_dayrent); ?>;
    var today = moment().format('YYYY-MM-DD');

    // กำหนดรูปแบบ datetimepicker
    $('.datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD',
        icons: {
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        },
        minDate: today // กำหนดให้เลือกวันที่ปัจจุบันเป็นต่ำสุด
    });

    // ตั้งค่า flag ในการตรวจสอบว่ามีการเลือก rental_date_create แล้วหรือไม่
    var rentalDateSelected = false;
    $('#return_date_create').data('DateTimePicker').disable();

    $('#rental_date_create').on('dp.change', function (e) {
        // ดึงข้อมูลวันที่รับหนังสือ
        var rentalDate = e.date;
        var returnDatemin = rentalDate.clone().add(1, 'days');
        var returnDateMax = rentalDate.clone().add(data_dayrent[0].day_rent, 'days');
        // คำนวณวันที่คืน 7 วันหลัง
        var maxDate = moment(today).add(2, 'days');

        $('#return_date_create').data('DateTimePicker').minDate(returnDatemin);
        $('#return_date_create').data('DateTimePicker').maxDate(returnDateMax);

        $('#rental_date_create').data('DateTimePicker').maxDate(maxDate);
        // ตั้งค่า flag เมื่อมีการเลือก rental_date_create
        rentalDateSelected = true;
        $('#return_date_create').data('DateTimePicker').enable();

    });
</script>

<script>
    var cartData = <?php echo json_encode($cartData); ?>;
    var userData = <?php echo json_encode($userData); ?>;
    var cart_check = [];

    function cart_check_length(value) {
        if (cart_check.length === 0) {
            $("#button_cancel").prop("disabled", true);
            $("#button_modal").prop("disabled", true);
        } else {
            if (userData[0].status_rental == 2 || userData[0].status_rental == 3) {
                $("#button_modal").prop("disabled", true);
                $("#button_cancel").prop("disabled", false);
            } else {
                $("#button_cancel").prop("disabled", false);
                $("#button_modal").prop("disabled", false);
            }
        }
    }
    var StockIds = [];
    $(document).ready(function () {

        cart_check_length(cart_check);
        $('.form-check-input').on('change', function () {
            var value = $(this).val();
            if ($(this).is(':checked')) {
                cart_check.push(value);
            } else {
                cart_check = cart_check.filter(function (item) {
                    return item !== value;
                });
            }
            $('#quantity').text(cart_check.length);
            cart_check_length(value);
        });
    });

</script>
<script>
    function loadmodal() {
        $("#cartTable").empty();
        var count = 0;
        var sum_rental_price = 0;
        var sum_book_price = 0;
        var id_book_check = '';
        var id_stock_book = '';
        var id_user = <?= session()->get('id') ?>;
        cart_check.forEach(element => {
            let matcart = cartData.find(element_cart => element_cart.id_cart === element);
            $("#cartTable").append(
                `<tr>
                    <th>ลำดับ : </th>
                    <td>${count += 1}</td>
                    <th>ชื่อหนังสือ : </th>
                    <td>${matcart.bookData[0].name_book}</td>
                    <td></td>
                    <th>ราคาหนังสือ : </th>
                    <td>${matcart.bookData[0].price_book}</td>
                    <th>ราคาเช่า : </th>
                    <td>${matcart.bookData[0].price}</td>
                </tr>`
            );
            id_book_check += matcart.bookData[0].id_book + ',';
            id_stock_book += matcart.id_stock_book + ',';

            sum_rental_price += parseInt(matcart.bookData[0].price);
            sum_book_price += parseInt(matcart.bookData[0].price_book);
        });
        $(".modal-body #name_user_create").val(id_user);
        $(".modal-body #cart_id").val(cart_check);
        $(".modal-body #name_book_create__").val(id_book_check.slice(0, -1));
        $(".modal-body #id_stock_book").val(id_stock_book.slice(0, -1));

        $("#cartTable").append(
            `<tr>
                <th></th>
                <th></th>
                <td></td>
                <td></td>
                <td></td>
                <th>ราคาหนังสือรวม :</th>
                <td>${sum_book_price} บาท</td>
                <th>ราคาเช่ารวม :</th>
                <td>${sum_rental_price} บาท</td>
            </tr>`
        );
        check_promotion(id_user, cart_check, sum_rental_price, function (result) {
            if (result.text == null) {
                $("#details_promotion").html("ไม่มีส่วนลดโปรโมชั่น");
            } else {
                $("#details_promotion").html(result.text);
            }
            $("#sum_price_promotion").html(result.price_promotion + ' ' + 'บาท');
            $(".modal-body #sumid_promotion").val(result.sumid_promotion);
            cal_Deposit_price(sum_book_price, function (result_deposit) {
                $("#sum_price_deposit").html(result_deposit + ' ' + 'บาท');
                $("#sum_price").html(((sum_rental_price - result.price_promotion) + result_deposit) + ' ' + 'บาท');
                $(".modal-body #price_book_create").val(sum_rental_price);
                $(".modal-body #price_deposit_").val(result_deposit);
                $(".modal-body #sum_price_promotion").val(result.price_promotion);

            });
        });
        $(".modal-body #url_route").val("dashboard/history/create");
    }
</script>
<script>
    function action_(url, form) {
        var formData = new FormData(document.getElementById(form));

        // Show loading indicator

        if (cart_check.length > '7') {
            Swal.fire({
                title: "การเช่าหนังสือสามารถเช่าได้แค่ 7 เล่มต่อครั้ง",
                icon: 'error',
                confirmButtonText: "ตกลง",
                showConfirmButton: true
            });
            // Hide loading indicator
        } else {
            $.ajax({
                url: '<?= base_url() ?>' + url,
                type: "POST",
                cache: false,
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                beforeSend: function () {
                    // Show loading indicator
                    Swal.fire({
                        title: "กำลังโหลด...",
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function (response) {
                    Swal.close();
                    console.log(response);
                    if (response.success) {
                        Swal.fire({
                            title: response.message,
                            icon: 'success',
                            showConfirmButton: true,
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
                        confirmButtonText: "ตกลง",
                        showConfirmButton: true
                    });
                },
                complete: function () {
                    // Hide loading indicator
                    // Swal.close();
                }
            });
        }
    }

</script>
<script>
    function confirm_Alert() {
        cart_check.forEach(element => {
            let matcart = cartData.find(element_cart => element_cart.id_cart === element);
            StockIds.push(matcart.id_stock_book);
        });
        Swal.fire({
            title: 'ต้องการยกเลิกตระกร้าหรือไม่?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonColor: "#28a745",
            confirmButtonText: "ตกลง",
        }).then((result) => {
            if (result.isConfirmed) {
                var formData = new FormData();

                formData.append('StockIds', StockIds);
                formData.append('cart_id', cart_check);

                // เพิ่มกำลังโหลด
                var loading = Swal.fire({
                    title: 'กำลังโหลด...',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    }
                });

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
                    // ปิดกำลังโหลดหลังจากทำเสร็จสิ้น
                    loading.close();

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
                            confirmButtonText: "ตกลง",
                            showConfirmButton: true
                        });
                    }
                });
            }
        });
    }

</script>