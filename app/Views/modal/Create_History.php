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
                <div class="form-group">
                    <label>ชือหนังสือ</label>
                    <div class="select2-secondary ">
                        <select class="select2" multiple="multiple" data-placeholder="Select Books"
                            data-dropdown-css-class="select2-secondary" style="width: 100%;" id="name_book_create"
                            required onchange="change()">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>ชื่อผู้ยืม</label>
                    <div class="select2-secondary ">
                        <select class="form-control gray-text" name="name_user_create" id="name_user_create"
                            onchange="change()">
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>วันที่ยืม</label>
                            <div class="input-group date" id="rental_date__create" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input gray-text"
                                    data-target="#rental_date__create" name="rental_date_create" id="rental_date_create"
                                    required />
                                <div class="input-group-append" data-target="#rental_date__create"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>วันที่ต้องคืน</label>
                            <div class="input-group date" id="return_date_create" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input gray-text"
                                    data-target="#return_date_create" name="return_date_create" id="return_date_create"
                                    required />
                                <div class="input-group-append" data-target="#return_date_create"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>ส่วนลดโปรโมชั่น</label>
                            <p id="details_promotion"></p>
                            <input type="text" class="form-control" placeholder="โปรโมชั่น" id="promotion_book"
                                name="promotion_book" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>ราคาหนังสือ(ยอดรวม)</label>
                            <input type="text" class="form-control" placeholder="ราคาเช่า(รวม)" id="price_book_"
                                name="price_book_" disabled>
                        </div>
                    </div>
                </div>
                <input type="text" class="form-control" id="price_book_create" name="price_book_create" hidden>
                <input type="text" class="form-control" id="sumid_promotion" name="sumid_promotion" hidden>
                <input type="text" class="form-control" id="sum_price_promotion" name="sum_price_promotion" hidden>
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
<script>
    $(function () {
        var today = moment();
        var formattedReturnDate = null;
        $('#return_date_create').datetimepicker({
            format: 'YYYY-MM-DD',
            minDate: formattedReturnDate,
        });
        $('#rental_date__create').datetimepicker({
            format: 'YYYY-MM-DD',
            minDate: today,
        });

        $('#rental_date__create').on('change.datetimepicker', function (e) {
            var rentalDate = e.date;
            var returnDate = rentalDate.clone().add(7, 'days');
            formattedReturnDate = returnDate.format('YYYY-MM-DD');

            // Destroy and reinitialize datetimepicker for return_date_create
            $('#return_date_create').datetimepicker('destroy');
            $('#return_date_create').datetimepicker({
                format: 'YYYY-MM-DD',
                minDate: formattedReturnDate,
            });

            $(".modal-body #return_date_create").val(formattedReturnDate);
        });
    })
</script>
<script>
    $(document).ready(function () {
        $(".select2").select2({
            closeOnSelect: false,
            placeholder: "Placeholder",
            allowHtml: true,
            allowClear: true,
            tags: true // creates new options on the fly
        });
    });
</script>
<script>
    var data_book = <?php echo json_encode($data_book); ?>;

    function change() {
        var selectedid_book = [];
        let price__ = 0;
        var selectElement = document.getElementById("name_book_create");
        var id_user = document.getElementById("name_user_create").value;
        for (var i = 0; i < selectElement.options.length; i++) {
            if (selectElement.options[i].selected) {
                selectedid_book.push(selectElement.options[i].value);
                let book__mat = data_book.find(element_book___ => element_book___.id_book === selectElement.options[i].value);
                price__ = price__ + parseInt(book__mat.price);
            }
        }

        check_promotion(id_user, selectedid_book, price__, function (result) {
            $(".modal-body #details_promotion").html(result.text);
            $(".modal-body #promotion_book").val(result.price_promotion);
            $(".modal-body #sum_price_promotion").val(result.price_promotion);

            $(".modal-body #sumid_promotion").val(result.sumid_promotion);

            $(".modal-body #price_book_create").val(result.price_result);
            $(".modal-body #price_book_").val(result.price_result);
        });

    }
</script>