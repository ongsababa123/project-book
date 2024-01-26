<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="overlay preloader">
            <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
        <div class="modal-header bg-info">
            <h4 class="modal-title" id="title_modal" name="title_modal"></h4>
        </div>
        <div class="modal-body">
            <form class="mb-3" id="form_promotion" action="javascript:void(0)" method="post"
                enctype="multipart/form-data">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2 mx-auto text-center border">
                            <a href="<?= base_url('dist/img/image-preview.png') ?>" data-toggle="lightbox"
                                id="image-preview-extra__" name="image-preview-extra__">
                                <img class="img-fluid mb-2" src="<?= base_url('dist/img/image-preview.png') ?>"
                                    alt="white sample" id="image-preview___" />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-2" id="uploadImage_div">
                    <label for="uploadImage" class="btn btn-block-tool btn-success btn-sm mb-2">อัปโหลดรูป</label>
                    <input type="file" id="uploadImage" name="uploadImage" style="display: none;" accept="image/*"
                        onchange="previewImage(this);">
                </div>
                <div id="status_check">
                    <label for="">สถานะ</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="icheck-success d-inline">
                                <input type="radio" class="score-radio" id="answer_5" name="status_promotion" value="1">
                                <label for="answer_5" id="label_answer_5">เปิดใช้งาน</label>
                            </div>
                            <div class="icheck-danger d-inline">
                                <input type="radio" class="score-radio" id="answer_6" name="status_promotion" value="0">
                                <label for="answer_6" id="label_answer_6">ปิดใช้งาน</label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>ประเภทโปรโมชั่น</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>รูปแบบการคำนวน</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="icheck-primary d-inline">
                            <input type="radio" class="score-radio" id="answer_1" name="type_promotion" value="1"
                                onclick="logValue(this)">
                            <label for="answer_1" id="label_answer_1">ลดราคาหนังสือ</label>
                        </div>
                        <div class="icheck-primary d-inline">
                            <input type="radio" class="score-radio" id="answer_2" name="type_promotion" value="2"
                                onclick="logValue(this)">
                            <label for="answer_2" id="label_answer_2">ลดราคาหมวดหมู่</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="icheck-orange d-inline">
                            <input type="radio" class="score-radio" id="answer_3" name="type_sale" value="1"
                                onclick="change_text()">
                            <label for="answer_3" id="label_answer_3">คิดแบบลบ</label>
                        </div>
                        <div class="icheck-orange d-inline">
                            <input type="radio" class="score-radio" id="answer_4" name="type_sale" value="2"
                                onclick="change_text()">
                            <label for="answer_4" id="label_answer_4">คิดแบบเปอร์เซ็นต์</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-2">
                        <div class="form-group">
                            <select class="select2 form-control" style="width: 100%;" id="id_book_cat"
                                name="id_book_cat" onchange="change_text()">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="form-group">
                            <input class="form-control no-arrow" type="number" id="number_cal" name="number_cal"
                                placeholder="กรอกจำนวนเลขที่ต้องการคำนวน" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label>วันที่สิ้นสุดโปรโมชั่น</label>
                        <div class="input-group date" id="end_date_promotion" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input gray-text"
                                data-target="#end_date_promotion" name="end_date_promotion" id="end_date_promotion"
                                data-toggle="datetimepicker" required />
                            <div class="input-group-append" data-target="#end_date_promotion"
                                data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>รายละเอียดโปรโมชั่น</label>
                            <textarea class="form-control" rows="3" placeholder="กรอกรายละเอียด"
                                id="detail_promotion_show" name="detail_promotion_show" required></textarea>
                            <textarea class="form-control" rows="3" placeholder="กรอกรายละเอียด" id="detail_promotion"
                                name="detail_promotion" required hidden></textarea>
                        </div>
                    </div>
                </div>
                <input type="text" id="url_route" name="url_route" hidden>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="submit" value="Submit" id="submit"></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".overlay").hide();
        $(".select2").select2();
        var today = moment().format('YYYY-MM-DD');
        $('#end_date_promotion').datetimepicker({
            format: 'YYYY-MM-DD',
            minDate: today,
        });
    });

    $("#form_promotion").on('submit', function (e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_promotion');
    });
</script>

<script>
    function previewImage(input) {
        var preview = document.getElementById('image-preview___');
        var preview_extra = document.getElementById('image-preview-extra__');
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            preview_extra.href = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
<script>
    $('#number_cal').on('input', function () {
        change_text();
    });
    function change_text() {
        var data_book = <?php echo json_encode($book); ?>;
        var data_category = <?php echo json_encode($category); ?>;
        var id_book_cat = document.getElementById('id_book_cat');
        var type_promotion = document.getElementsByName('type_promotion');
        var number_cal = document.getElementById('number_cal');
        var type_sale = document.getElementsByName('type_sale');
        var num = 0;
        if (number_cal.value != '') {
            num = number_cal.value;
        }

        var text1 = "";
        var text2 = "";

        if (type_sale[0].checked) {
            text1 = num + " บาท";
        } else {
            text1 = num + "%";
        }

        if (type_promotion[0].checked) {
            let mat_book = data_book.find(element_book => element_book.id_book === id_book_cat.value);
            text2 = " จากหนังสือเรื่อง " + mat_book.name_book;
        } else {
            let matcategory = data_category.find(element_category => element_category.id_category === id_book_cat.value);
            text2 = " จากหมวดหมู่ " + matcategory.name_category;
        }

        var text = "ส่วนลดราคาเช่า " + text1 + text2;

        // Corrected line using jQuery
        $('#detail_promotion_show').val(text);
        $('#detail_promotion').val(text);

    }

    function logValue(radioButton) {
        var data_book = <?php echo json_encode($book); ?>;
        var data_category = <?php echo json_encode($category); ?>;
        $(".modal-body #id_book_cat").empty();
        if (radioButton.value == 1) {
            data_book.forEach(element_book_cr => {
                var newOption = $('<option>').val(element_book_cr.id_book).text(element_book_cr.name_book);
                $(".modal-body #id_book_cat").append(newOption);
            });
        } else if (radioButton.value == 2) {
            data_category.forEach(element_category_cr => {
                var newOption = $('<option>').val(element_category_cr.id_category).text(element_category_cr.name_category);
                $(".modal-body #id_book_cat").append(newOption);
            })
        }
        change_text();
    }
</script>