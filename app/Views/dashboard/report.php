<title>รายงานการขาย</title>
<link rel="stylesheet" href="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.css'); ?>">
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url('plugins/daterangepicker/daterangepicker.css'); ?>">
<!-- Tempusdominus Bootstrap 4 -->
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('plugins/select2/css/select2.min.css'); ?>">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?= base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
<link rel="stylesheet"
    href="<?= base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">

<body class="hold-transition sidebar-mini">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>รายงานการขาย
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><a>รายงานการขาย</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card card-navy card-tabs">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" class="score-radio" id="answer_day" name="r_" value="1"
                                                checked onclick="change_radio(this)">
                                            <label for="answer_day" id="label_answer_day">ยอดขายประจำวัน</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" class="score-radio" id="answer_mounth" name="r_"
                                                value="2" onclick="change_radio(this)">
                                            <label for="answer_mounth"
                                                id="label_answer_mounth">ยอดขายรายวันของเดือน</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" class="score-radio" id="answer_year" name="r_" value="3"
                                                onclick="change_radio(this)">
                                            <label for="answer_year" id="label_answer_year">ยอดขายรายเดือนของปี</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-2" id="day">
                                        <div class="form-group">
                                            <label>วัน</label>
                                            <div class="input-group date" id="datetimepicker_day"
                                                data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#datetimepicker_day" data-toggle="datetimepicker"
                                                    areaChartData_book.datasets=[];
                                                    areaChartData_book_sum_price.datasets=[]; id="day_input"
                                                    name="day_input" />
                                                <div class="input-group-append" data-target="#datetimepicker_day"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2" id="mounth">
                                        <div class="form-group">
                                            <label>เดือน</label>
                                            <div class="input-group date" id="datetimepicker_month"
                                                data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#datetimepicker_month" data-toggle="datetimepicker"
                                                    id="month_input" name="month_input" />
                                                <div class="input-group-append" data-target="#datetimepicker_month"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2" id="year">
                                        <div class="form-group">
                                            <label>ปี</label>
                                            <div class="input-group date" id="datetimepicker_year"
                                                data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#datetimepicker_year" data-toggle="datetimepicker"
                                                    id="year_input" name="year_input" />
                                                <div class="input-group-append" data-target="#datetimepicker_year"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2" id="year">
                                        <div class="form-group">
                                            <label>ค้นหา</label>
                                            <br>
                                            <button type="submit" class="btn btn-primary" id="search">ค้นหา</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card card-navy">
                            <div class="card-header border-0">
                                <h3 class="card-title">รายการหนังสือ</h3>
                                <div class="card-tools">
                                    <a href="<?php echo base_url('dashboard/report/generate/pdf') ?>"
                                        class="btn btn-primary">
                                        <i class="fas fa-download"></i>
                                        โหลดสรุปรายงาน PDF
                                    </a>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table id="table_book" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ชื่อหนังสือ</th>
                                            <th>ราคาเช่า</th>
                                            <th>จำนวนที่ขาย</th>
                                            <th>ยอดขาย (รวม)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($book as $key => $value): ?>
                                            <tr>
                                                <td>
                                                    <?= $value['name_book']; ?>
                                                </td>
                                                <td>
                                                    <?= $value['price']; ?> บาท
                                                </td>
                                                <td id="count_history_<?= $value['id_book']; ?>">
                                                </td>
                                                <td id="count_price_sum_<?= $value['id_book']; ?>">

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card card-navy">
                            <div class="card-header border-0">
                                <h3 class="card-title">กราฟแท่งเปรียบเทียบจำนวนที่ขาย</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="barChart_count_sale"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card card-navy">
                            <div class="card-header border-0">
                                <h3 class="card-title">กราฟแท่งเปรียบเทียบยอดขาย</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="barChart_count_sum_price"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    <!-- InputMask -->
    <script src="<?= base_url('plugins/moment/moment.min.js'); ?>"></script>
    <!-- date-range-picker -->
    <script src="<?= base_url('plugins/daterangepicker/daterangepicker.js'); ?>"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
    <!-- Select2 -->
    <script src="<?= base_url('plugins/select2/js/select2.full.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/filterizr/jquery.filterizr.min.js') ?>"></script>
    <script src="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.min.js') ?>"></script>
    <script src="<?= base_url('plugins/chart.js/Chart.min.js') ?>"></script>
    <script>
        $(document).ready(function () {
            var value = {
                value: '1'
            };
            change_radio(value)

        });
    </script>
    <script>
        $(function () {
            $('#datetimepicker_year').datetimepicker({
                viewMode: 'years',
                format: 'YYYY',
            });
            $('#datetimepicker_month').datetimepicker({
                viewMode: 'months',
                format: 'YYYY-MM',
            });
            $('#datetimepicker_day').datetimepicker({
                format: 'YYYY-MM-DD',
            });
        });
    </script>
    <script>
        function change_radio(value) {
            if (value.value == 1) {
                $("#mounth").hide();
                $("#year").hide();
                $("#day").show();
                $("#day_input").val("<?= date('Y-m-d') ?>");
                getdata(1)
            } else if (value.value == 2) {
                $("#mounth").show();
                $("#year").hide();
                $("#day").hide();
                $("#month_input").val("<?= date('Y-m') ?>");
                getdata(2)
            } else {
                $("#mounth").hide();
                $("#year").show();
                $("#day").hide();
                $("#year_input").val("<?= date('Y') ?>");
                getdata(3)
            }
        }
    </script>
    <script>
        function getdata(type_data) {
            var baseUrl = "<?= base_url('dashboard/report/getdata/') ?>";
            var dayInput = $("#day_input").val();
            var monthInput = $("#month_input").val();
            var yearInput = $("#year_input").val();
            var loadingIndicator;

            $.ajax({
                type: "POST",
                url: baseUrl + type_data,
                dataType: "JSON",
                data: {
                    input_day: dayInput,
                    input_month: monthInput,
                    input_year: yearInput
                },
                beforeSend: function () {
                    loadingIndicator = Swal.fire({
                        title: 'กําลังดําเนินการ...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
                },
                success: function (data) {
                    Swal.close();
                    var bookData = <?= json_encode($book) ?>;
                    var label = [];

                    function zeroPad(number, length) {
                        var str = String(number);
                        while (str.length < length) {
                            str = '0' + str;
                        }
                        return str;
                    }
                    if (type_data == 1) {
                        label = [dayInput];
                    } else if (type_data == 2) {
                        var [year, month] = monthInput.split('-');
                        var daysInMonth = new Date(year, month, 0).getDate();
                        label = Array.from({
                            length: daysInMonth
                        }, (_, i) => `${year}-${month.padStart(2, '0')}-${(i + 1).toString().padStart(2, '0')}`);
                    } else if (type_data == 3) {
                        var year = yearInput;
                        label = Array.from({
                            length: 12
                        }, (_, i) => `${year}-${zeroPad(i + 1, 2)}`);
                    }

                    var areaChartData_book = {
                        labels: label,
                        datasets: []
                    };
                    var areaChartData_book_sum_price = {
                        labels: label,
                        datasets: []
                    };

                    function areAllZeros(array) {
                        return array.every(value => value === 0);
                    }

                    bookData.forEach(element_bookdata => {
                        var data_count_history_set = [];
                        var data_count_price_set = [];

                        label.forEach(element_label => {
                            var count_history = 0;
                            var count_price_sum = 0;

                            data.data.forEach(element_history => {
                                var id_book_splite = element_history.id_book.split(",");
                                id_book_splite.forEach(element_id_book => {
                                    if (element_bookdata.id_book == element_id_book) {
                                        if ((type_data == 1 || type_data == 2) && element_label == element_history.submit_date) {
                                            count_history++;
                                            var price = (parseInt(element_history.sum_rental_price) + parseInt(element_history.sum_deposit_price)) - parseInt(element_history.sum_price_promotion);
                                            var late_price = parseInt(element_history.sum_late_price) + parseInt(element_history.sum_day_late_price) + parseInt(element_history.sum_book_des_price);
                                            count_price_sum += price + late_price;
                                        } else if (type_data == 3) {
                                            var submitDateYearMonth = element_history.submit_date.substring(0, 7);
                                            if (element_label === submitDateYearMonth) {
                                                count_history++;
                                                var price = (parseInt(element_history.sum_rental_price) + parseInt(element_history.sum_deposit_price)) - parseInt(element_history.sum_price_promotion);
                                                var late_price = parseInt(element_history.sum_late_price) + parseInt(element_history.sum_day_late_price) + parseInt(element_history.sum_book_des_price);
                                                count_price_sum += price + late_price;
                                            }
                                        }
                                    }
                                });
                            });

                            data_count_history_set.push(count_history);
                            data_count_price_set.push(count_price_sum);
                        });

                        if (!areAllZeros(data_count_history_set)) {
                            var dataset1 = {
                                label: element_bookdata.name_book,
                                backgroundColor: getRandomColor(),
                                borderColor: getRandomColor(),
                                pointRadius: false,
                                pointColor: getRandomColor(),
                                pointStrokeColor: getRandomColor(),
                                pointHighlightFill: getRandomColor(),
                                pointHighlightStroke: getRandomColor(),
                                data: data_count_history_set
                            };
                            var dataset2 = {
                                label: element_bookdata.name_book,
                                backgroundColor: getRandomColor(),
                                borderColor: getRandomColor(),
                                pointRadius: false,
                                pointColor: getRandomColor(),
                                pointStrokeColor: getRandomColor(),
                                pointHighlightFill: getRandomColor(),
                                pointHighlightStroke: getRandomColor(),
                                data: data_count_price_set
                            };

                            areaChartData_book.datasets.push(dataset1);
                            areaChartData_book_sum_price.datasets.push(dataset2);
                        }
                    });

                    bookData.forEach(element_bookdata => {
                        var count_history = 0;
                        var count_price_sum = 0;

                        data.data.forEach(element_history => {
                            var id_book_splite = element_history.id_book.split(",");
                            id_book_splite.forEach(element_id_book => {
                                if (element_bookdata.id_book == element_id_book) {
                                    count_history++;
                                    var price = (parseInt(element_history.sum_rental_price) + parseInt(element_history.sum_deposit_price)) - parseInt(element_history.sum_price_promotion);
                                    var late_price = parseInt(element_history.sum_late_price) + parseInt(element_history.sum_day_late_price) + parseInt(element_history.sum_book_des_price);
                                    count_price_sum += price + late_price;
                                }
                            });
                        });

                        $("#count_history_" + element_bookdata.id_book).text(count_history + ' ครั้ง');
                        $("#count_price_sum_" + element_bookdata.id_book).text(count_price_sum + ' บาท');
                    });

                    var barChartOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        datasetFill: false,
                        scales: {
                            yAxes: [{
                                display: true,
                                ticks: {
                                    min: 0
                                }
                            }]
                        }
                    };

                    var barChartCanvasCountSale = $('#barChart_count_sale')[0];
                    var barChartCanvasCountSumPrice = $('#barChart_count_sum_price')[0];

                    barChartCanvasCountSale.getContext('2d').clearRect(0, 0, barChartCanvasCountSale.width, barChartCanvasCountSale.height);
                    barChartCanvasCountSumPrice.getContext('2d').clearRect(0, 0, barChartCanvasCountSumPrice.width, barChartCanvasCountSumPrice.height);

                    if (barChartCanvasCountSale.chart) {
                        barChartCanvasCountSale.chart.destroy();
                    }
                    if (barChartCanvasCountSumPrice.chart) {
                        barChartCanvasCountSumPrice.chart.destroy();
                    }

                    barChartCanvasCountSale.chart = new Chart(barChartCanvasCountSale, {
                        type: 'bar',
                        data: areaChartData_book,
                        options: barChartOptions
                    });
                    barChartCanvasCountSumPrice.chart = new Chart(barChartCanvasCountSumPrice, {
                        type: 'bar',
                        data: areaChartData_book_sum_price,
                        options: barChartOptions
                    });
                }
            });
        }
    </script>

    <script>
        $('#search').on('click', function () {
            var checkedRadioValue = $('.score-radio:checked').val();
            getdata(checkedRadioValue)
        })
    </script>
    <script>
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>