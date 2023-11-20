<script>
    function check_promotion(id_user, sum_id_book, sum_price,callback) {
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
                callback(response);
            },
            error: function (error) {
                // Handle errors if needed
                console.log(error);
                callback(null); // Pass null to indicate an error
            }
        });
    }
</script>