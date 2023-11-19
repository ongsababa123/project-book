
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="overlay preloader">
            <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
        <div class="modal-header bg-info">
            <h4 class="modal-title" id="title_modal" name="title_modal"></h4>
        </div>
        <div class="modal-body">
            <form class="mb-3" id="form_read_history" action="javascript:void(0)" method="post" enctype="multipart/form-data">
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
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>ราคาหนังสือ(ยอดรวม)</label>
                            <input type="text" class="form-control" placeholder="กรอกวันที่ยืม" id="price_book"
                                name="price_book" disabled>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>ค่าปรับ</label>
                            <input type="text" class="form-control" placeholder="กรอกวันที่คืน" id="price_late"
                                name="price_late" disabled>
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
    });

    $("#form_read_history").on('submit', function (e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_read_history');
    });
</script>

<script>
    $(function () {
        //Date picker
        $('#return_date__').datetimepicker({
            format: 'YYYY-MM-DD',
        });
    })
</script>