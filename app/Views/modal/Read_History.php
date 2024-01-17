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
                        <div class="col-sm-12">
                            <div class="icheck-primary d-inline">
                                <input type="radio" class="score-radio" id="answer1_1" name="r1_1" value="0">
                                <label for="answer1_1">หนังสือปกติ</label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" class="score-radio" id="answer1_2" name="r1_1" value="1">
                                <label for="answer1_2">หนังสือหาย</label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" class="score-radio" id="answer1_3" name="r1_1" value="1">
                                <label for="answer1_2">หนังสือชำรุด</label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" class="score-radio" id="answer1_4" name="r1_1" value="1">
                                <label for="answer1_2">หนังสือไม่สามรถใช้ต่อได้</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 mt-1">
                            <input type="text" class="form-control" placeholder="คำอธิบาย" id="text_book_xxx"
                                name="text_book_xxx" >
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
                            <input type="text" class="form-control" id="text_promotion" name="text_promotion">
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
                            <label>ตัวเลือกการเก็บค่าปรับเพิ่ม</label>
                            <br>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>ราคาค่าปรับ</label>
                            <input type="text" class="form-control" id="sum_late_price" name="sum_late_price">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>รวมทั้งสิ้น</label>
                            <input type="text" class="form-control" id="total_price_all" name="total_price_all">
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
        const price_book = parseFloat($("#price_book").val()) || 0;
        const price_deposit = parseFloat($("#price_deposit").val()) || 0;
        const price_all = parseFloat($("#price_all").val()) || 0;
        const lateFee = parseFloat($("#price_late").val()) || 0;
        const pice_promotion = parseFloat($("#pice_promotion").val()) || 0;

        // Calculate the new values
        const newPriceAll = (price_book + price_deposit) - pice_promotion;
        const newPriceTotal = newPriceAll + lateFee;

        // Update the values of the elements
        $("#price_all").val(newPriceAll);
        $("#price_total").val(newPriceTotal);
    }

    // Event handler for pice_promotion input
    $("#pice_promotion").on('input', function () {
        updateTotalPrice();
    });

    // Event handler for price_late input
    $("#price_late").on('input', function () {
        updateTotalPrice();
    });
</script>