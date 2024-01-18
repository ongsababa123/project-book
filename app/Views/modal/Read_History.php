<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="overlay preloader">
            <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
        <div class="modal-header bg-info">
            <h4 class="modal-title" id="title_modal" name="title_modal"></h4>
        </div>
        <div class="modal-body">
            <form class="mb-3" id="form_read_history" action="javascript:void(0)" method="post"
                enctype="multipart/form-data">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2 mx-auto text-center border" id="image_thebook">
                            <a href="<?= base_url('dist/img/image-preview.png') ?>" data-toggle="lightbox"
                                id="image-preview-extra">
                                <img class="img-fluid mb-2" src="<?= base_url('dist/img/image-preview.png') ?>"
                                    alt="white sample" id="image-preview" />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row" id="formImageContainer">
                    </div>
                </div>
                <hr>
                <div class="form-group" id="form_thebook">
                    <label id="labelbook"></label>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>ชื่อหนังสือ</label>
                                <input type="text" class="form-control" placeholder="กรอกชื่อหนังสือ" id="name_book"
                                    name="name_book" disabled>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>ชื่อผู้แต่ง</label>
                                <input type="text" class="form-control" placeholder="กรอกชื่อผู้แต่ง"
                                    id="name_book_author" name="name_book_author" disabled>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>หมวดหมู่</label>
                                <input type="text" class="form-control" placeholder="กรอกชื่อผู้แต่ง"
                                    id="categorySelect" name="categorySelect" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9 pt-4">
                            <div class="icheck-success d-inline">
                                <input type="radio" class="score-radio " id="answer_1" name="r_" value="0"
                                    onclick="setScore(this)">
                                <label for="answer_1" id="label_answer_1">หนังสือปกติ</label>
                            </div>
                            <div class="icheck-danger d-inline">
                                <input type="radio" class="score-radio" id="answer_2" name="r_" value="1"
                                    onclick="setScore(this)">
                                <label for="answer_2" id="label_answer_2">หนังสือหาย</label>
                            </div>
                            <div class="icheck-danger d-inline">
                                <input type="radio" class="score-radio" id="answer_3" name="r_" value="2"
                                    onclick="setScore(this)">
                                <label for="answer_3" id="label_answer_3">หนังสือชำรุด</label>
                            </div>
                            <div class="icheck-danger d-inline">
                                <input type="radio" class="score-radio" id="answer_4" name="r_" value="3"
                                    onclick="setScore(this)">
                                <label for="answer_4" id="label_answer_4">หนังสือไม่สามรถใช้ต่อได้</label>
                            </div>
                            <input type="text" id="price_book_destroy_after" name="price_book_destroy_after" >
                            <input type="text" id="price_book_destroy_before" name="price_book_destroy_before" >
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label>ราคาเช่า</label>
                                <input type="text" class="form-control" id="price_rental_book" name="price_book"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>ราคาหนังสือ</label>
                                <input type="text" class="form-control" id="price_book" name="price_book" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 mt-1">
                            <input type="text" class="form-control" placeholder="คำอธิบาย" id="text_book_description"
                                name="text_book_description">
                        </div>
                    </div>
                    <hr>
                </div>
                <div id="formContainer"></div>
                <div class="form-group">
                    <label>ชื่อผู้ยืม</label>
                    <input type="text" class="form-control" placeholder="กรอกชื่อผู้ยืม" id="name_user" name="name_user"
                        disabled>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>วันที่ยืม</label>
                            <input type="text" class="form-control" placeholder="กรอกวันที่ยืม" id="rental_date"
                                name="rental_date" disabled>
                            <br>
                            <h6 id="label_return_date" name="label_return_date"></h6>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>วันที่ต้องคืน</label>
                            <div class="input-group date" id="return_date__" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input gray-text"
                                    data-target="#return_date__" name="return_date" id="return_date" required />
                                <div class="input-group-append" data-target="#return_date__"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>วันที่คืน</label>
                            <input type="text" class="form-control" placeholder="วันที่คืน" id="submit_date"
                                name="submit_date" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>รายละเอียดโปรโมชั่น</label>
                            <p id="text_promotion" name="text_promotion"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>ส่วนลดโปรโมชั่น</label>
                            <input type="text" class="form-control" id="sum_price_promotion" name="sum_price_promotion">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>ราคาเช่าหนังสือ (ยอดรวม)</label>
                            <input type="text" class="form-control" placeholder="ราคาเช่า(ยอดรวม)" id="sum_rental_price"
                                name="sum_rental_price" disabled>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>ค่ามัดจำ</label>
                            <input type="text" class="form-control" placeholder="ค่ามัดจำต่อเล่ม" id="sum_deposit_price"
                                name="sum_deposit_price" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>ราคาเช่าหนังสือทั้งหมด (ค่ามัดจำและหักโปรโมชั่น)</label>
                            <input type="text" class="form-control"
                                placeholder="ราคาเช่าหนังสือ(ค่ามัดจำและหักโปรโมชั่น)" id="total_price"
                                name="total_price" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>ราคาค่าปรับ</label>
                            <input type="text" class="form-control" id="sum_late_price" name="sum_late_price"
                                placeholder="ราคาค่าปรับ">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>รวมทั้งสิ้น</label>
                            <input type="text" class="form-control" id="total_price_all" name="total_price_all"
                                disabled>
                        </div>
                    </div>
                </div>
                <input type="text" id="url_route" name="url_route" hidden>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="submit" value="Submit" id="submit"></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    <a class="btn btn-app bg-danger mt-3" target="_blank" id="print" name="print"><i
                            class="fas fa-print"></i> พิมพ์ใบเสร็จ</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".overlay").hide();
    });

    $("#form_read_history").on('submit', function (e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_read_history');
    });
</script>
<script>
    // Common function to calculate total price
    function updateTotalPrice() {

        // Retrieve values as floats
        const sum_rental_price_cal = parseFloat($("#sum_rental_price").val()) || 0;
        const sum_deposit_price_cal = parseFloat($("#sum_deposit_price").val()) || 0;
        const sum_late_price_cal = parseFloat($("#sum_late_price").val()) || 0;
        const sum_price_promotion_cal = parseFloat($("#sum_price_promotion").val()) || 0;

        // Calculate the new values
        const total_price_cal = (sum_rental_price_cal + sum_deposit_price_cal) - sum_price_promotion_cal;
        const total_price_all_cal = total_price_cal + sum_late_price_cal;

        // Update the values of the elements
        $("#total_price").val(total_price_cal);
        $("#total_price_all").val(total_price_all_cal);
    }

    // Event handler for sum_price_promotion input
    $("#sum_price_promotion").on('input', function () {
        updateTotalPrice();
    });

    // Event handler for price_late input
    $("#sum_late_price").on('input', function () {
        updateTotalPrice();
    });
</script>
<script>
    function setScoreRadio(value) {
        let id_stock_check = value.id.split('_');
        //[0] = เลขลำดับตัวเลือก 1-4 [1] = id_stock [2] = id_book
        var sum_late_price_after = parseFloat($("#price_book_destroy_after_" + id_stock_check[1] + "_" + id_stock_check[2]).val()) || 0;
        var sum_late_price_before = parseFloat($("#price_book_destroy_before_" + id_stock_check[1] + "_" + id_stock_check[2]).val()) || 0;
        const sum_late_price_cal = parseFloat($("#sum_late_price").val()) || 0;
        var price_temp = (sum_late_price_cal - sum_late_price_before) + sum_late_price_after;
        $("#sum_late_price").val(price_temp);
    }
</script>
<script>
    function setScore(value) {
        let id_stock_check = value.id.split('_');
        //[0] = เลขลำดับตัวเลือก 1-4 [1] = id_stock [2] = id_book
        var sum_late_price_after = parseFloat($("#price_book_destroy_after_" + id_stock_check[1] + "_" + id_stock_check[2]).val()) || 0;
        var sum_late_price_before = parseFloat($("#price_book_destroy_before_" + id_stock_check[1] + "_" + id_stock_check[2]).val()) || 0;
        const sum_late_price_cal = parseFloat($("#sum_late_price").val()) || 0;

        var data_book = <?php echo json_encode($data_book); ?>;
        var mat_book = data_book.find(element_book => element_book.id_book === id_stock_check[2]);

        var price_book_destroy = 0;
        if (id_stock_check[0] == 1) {
            price_book_destroy = 0;
        } else if (id_stock_check[0] == 2 || id_stock_check[0] == 4) {
            price_book_destroy = mat_book.price_book;
        } else if (id_stock_check[0] == 3) {
            price_book_destroy = 0.2 * mat_book.price_book;
        }
        const showDescription = id_stock_check[0] == 3;
        $("#text_book_description_" + id_stock_check[1] + "_" + id_stock_check[2])[showDescription ? 'show' : 'hide']();

        $("#price_book_destroy_before_" + id_stock_check[1] + "_" + id_stock_check[2]).val(sum_late_price_after);
        $("#price_book_destroy_after_" + id_stock_check[1] + "_" + id_stock_check[2]).val(price_book_destroy);

        setScoreRadio(value)
        updateTotalPrice();

    }
</script>