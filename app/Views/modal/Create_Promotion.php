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
            <form class="mb-3" id="form_promotion" action="javascript:void(0)" method="post" enctype="multipart/form-data">
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
                <div class="form-group">
                    <label>รายละเอียดโปรโมชั่น</label>
                    <textarea class="form-control" rows="3" placeholder="กรอกรายละเอียด" id="detail_promotion"
                        name="detail_promotion" required <?= $type_disable ?>></textarea>
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
    });

    $("#form_promotion").on('submit', function (e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_promotion');
    });
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