<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="overlay preloader">
            <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
        <div class="modal-header bg-info">
            <h4 class="modal-title" id="title_modal" name="title_modal"></h4>
        </div>
        <div class="modal-body">
            <form class="mb-3" id="form_create_history" action="javascript:void(0)" method="post"
                enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6 mx-auto">
                        <div class="form-group">
                            <label>ปรับราคาการปรับ</label>
                            <input type="text" class="form-control" placeholder="ราคาค่าปรับ" id="late_price"
                                name="late_price" required>
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

    $("#form_create_history").on('submit', function (e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_create_history');
    });
</script>
