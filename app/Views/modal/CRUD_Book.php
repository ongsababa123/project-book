<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="overlay preloader">
            <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
        <div class="modal-header bg-info">
            <h4 class="modal-title" id="title_modal" name="title_modal"></h4>
        </div>
        <div class="modal-body">
        <?php if (session()->get('type') == '3') { 
                    $type_hideen = 'hidden';
                    $type_disable = 'disabled';
                }else{
                    $type_hideen = '';
                    $type_disable = '';
                }
                ?>
            <form class="mb-3" id="form_book" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2 mx-auto text-center border">
                            <a href="<?= base_url('dist/img/image-preview.png') ?>" data-toggle="lightbox"
                                id="image-preview-extra">
                                <img class="img-fluid mb-2" src="<?= base_url('dist/img/image-preview.png') ?>"
                                    alt="white sample" id="image-preview" />
                            </a>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-2" <?= $type_hideen ?>>
                    <label for="uploadImage" class="btn btn-block-tool btn-success btn-sm mb-2">อัปโหลดรูป</label>
                    <input type="file" id="uploadImage" name="uploadImage" style="display: none;" accept="image/*"
                        onchange="previewImage(this);">
                </div>
                <div class="form-group" id="customSwitch" <?= $type_hideen ?>>
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="customSwitch3" name="customSwitch3"
                            onclick="change_status()">
                        <label class="custom-control-label" for="customSwitch3" id="LabelcustomSwitch3"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label>ชื่อหนังสือ</label>
                    <input type="text" class="form-control" placeholder="กรอกชื่อหนังสือ" id="name_book"
                        name="name_book" required <?= $type_disable ?>>
                </div>
                <div class="form-group">
                    <label>ชื่อผู้แต่ง</label>
                    <input type="text" class="form-control" placeholder="กรอกชื่อผู้แต่ง" id="name_book_author"
                        name="name_book_author" required <?= $type_disable ?>>
                </div>
                <div class="form-group">
                    <label>รายละเอียด</label>
                    <textarea class="form-control" rows="3" placeholder="กรอกรายละเอียด" id="detail_category"
                        name="detail_category" required <?= $type_disable ?>></textarea>
                </div>
                <div class="form-group">
                    <label>ราคาเช่า</label>
                    <input type="number" class="form-control" placeholder="ราคาหนังสือ" id="price_book"
                        name="price_book" required <?= $type_disable ?>>
                </div>
                <div class="form-group">
                    <label>ราคาหนังสือ</label>
                    <input type="number" class="form-control" placeholder="ราคาหนังสือ" id="price_book_book"
                        name="price_book_book" required <?= $type_disable ?>>
                </div>
                <div class="form-group">
                    <label>หมวดหมู่</label>
                    <select class="form-control gray-text" name="categorySelect" id="categorySelect" <?= $type_disable ?>>
                    </select>
                </div>
                <input type="text" id="url_route" name="url_route" hidden>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-success" name="submit" value="Submit" id="submit" <?= $type_hideen ?>></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".overlay").hide();
        change_status();
    });

    $("#form_book").on('submit', function (e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_book');
    });
</script>
<script>
    function change_status() {
        const isChecked = document.getElementById("customSwitch3").checked;
        if (isChecked) {
            $(".modal-body #LabelcustomSwitch3").text("เปิดใช้งาน");
        } else {
            $(".modal-body #LabelcustomSwitch3").text("ปิดใช้งาน");
        }
    }

</script>

<script>
    function previewImage(input) {
        var preview = document.getElementById('image-preview');
        var preview_extra = document.getElementById('image-preview-extra');
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