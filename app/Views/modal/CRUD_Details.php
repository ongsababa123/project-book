<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="overlay preloader">
            <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
        <div class="modal-header bg-info">
            <h4 class="modal-title" id="title_modal" name="title_modal"></h4>
        </div>
        <div class="modal-body">
            <form class="mb-3" id="form_details" action="javascript:void(0)" method="post"
                enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12 mx-auto" id="detail_group">
                        <div class="form-group" >
                            <label>รายละเอียด</label>
                            <textarea class="form-control" name="detail" id="detail" cols="5" rows="5" required></textarea>
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

    $("#form_details").on('submit', function (e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_details');
    });
</script>
<script>
    document.getElementById('detail').addEventListener('input', function () {
        // Remove any existing alert
        removeAlert();

        var detailValue = this.value; // Get the value of the 'detail' input

        if (detailValue.includes("'")) {
            // Create and append a danger alert
            createAlert('danger', "ข้อความห้ามมีตัวอักษร ' เด็ดขาด");
            $('.modal-footer #submit').prop('disabled', true);
        } else {
            removeAlert();
            $('.modal-footer #submit').prop('disabled', false);
        }
    });


    function createAlert(type, message) {
        var alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-' + type + ' alert-dismissible';
        alertDiv.innerHTML = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
            '<h5><i class="icon fas fa-ban"></i> Alert!</h5>' +
            message;

        document.body.appendChild(alertDiv);
        $('#detail_group').append(alertDiv);
    }

    function removeAlert() {
        var existingAlert = document.querySelector('.alert');
        if (existingAlert) {
            existingAlert.parentNode.removeChild(existingAlert);
        }
    }
</script>