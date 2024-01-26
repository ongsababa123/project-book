<script>
    function check_promotion(id_user, sum_id_book, sum_price, callback) {
        var temp_Data = new FormData();
        temp_Data.append('id_user', id_user);
        temp_Data.append('sum_id_book', sum_id_book);
        temp_Data.append('sum_price', sum_price);

        $.ajax({
            url: '<?= base_url('dashboard/promotion/calculate') ?>',
            type: "POST",
            cache: false,
            data: temp_Data,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                callback(response);
            },
            error: function (error) {
                // Handle errors if needed
                callback(null); // Pass null to indicate an error
            }
        });
    }
</script>

<script>
    function calculate_price_late__(Fine_rate, distance_day, result_late) {
        var price_late = Fine_rate * distance_day;
        result_late(price_late);
    }
</script>
<script>
    //คำนวนหาความห่างวันปัจจุบันกับวันที่ต้องคืน
    function calculate_distance_day(return_date, result_distance_day) {
        var currentDate = new Date();
        currentDate.setHours(0, 0, 0, 0)
        var return_date = new Date(return_date);
        return_date.setHours(0, 0, 0, 0);
        var timeDifference = currentDate.getTime() - return_date.getTime();
        var daysDifference = Math.ceil((timeDifference / (1000 * 60 * 60 * 24)) - 1);
        result_distance_day(daysDifference + 1);
    }
</script>
<script>
    //คำนวนหาค่ามัดจำ
    function cal_Deposit_price(data_pricebook, result_deposit_price) {
        // Calculate the deposit price as 50% of data_pricebook
        var result_deposit = data_pricebook * 0.5;

        result_deposit_price(Math.floor(result_deposit));
    }
</script>
<script>
    function cal_book_destory(book_price, status_book_stock, result_destory_price) {
        if (status_book_stock == 2) {
            var result_= 0;
        } else if (status_book_stock == 3 || status_book_stock == 5) {
            var result_= book_price;
        } else if (status_book_stock == 4) {
            var result_= 0.2 * book_price;
        }
        result_destory_price(result_);
    }
</script>