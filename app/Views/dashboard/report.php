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
                                            <label for="answer_day" id="label_answer_day">ยอดขายรายวัน</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" class="score-radio" id="answer_mounth" name="r_"
                                                value="2" onclick="change_radio(this)">
                                            <label for="answer_mounth" id="label_answer_mounth">ยอดขายรายเดือน</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" class="score-radio" id="answer_year" name="r_" value="3"
                                                onclick="change_radio(this)">
                                            <label for="answer_year" id="label_answer_year">ยอดขายรายปี</label>
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
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-bars"></i>
                                    </a>
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
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">กราฟแท่งเปรียบเทียบจำนวนที่ขาย</h3>
                                    <a href="javascript:void(0);"></a>
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
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">กราฟแท่งเปรียบเทียบยอดขาย </h3>
                                    <a href="javascript:void(0);"></a>
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
            var value = { value: '1' };
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
        var first = 0;
        function getdata(type_data) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('dashboard/report/getdata/') ?>" + type_data,
                dataType: "JSON",
                data: {
                    input_day: $("#day_input").val(),
                    input_month: $("#month_input").val(),
                    input_year: $("#year_input").val()
                },
                beforeSend: function () {
                    // Show loading indicator here
                    var loadingIndicator = Swal.fire({
                        title: 'กําลังดําเนินการ...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
                },
                success: function (data) {
                    Swal.close();

                    var bookData = <?php echo json_encode($book); ?>;
                    var label;
                    if (type_data == 1) {
                        label = [$("#day_input").val()];
                        // YYYY-MM-DD
                    } else if (type_data == 2) {
                        // ดึงข้อมูลเดือนและปีจาก input
                        var monthInput = $("#month_input").val();

                        // แยกปีและเดือน
                        var year = parseInt(monthInput.slice(0, 4));
                        var month = parseInt(monthInput.slice(5, 7));

                        // หาจำนวนวันในเดือนนั้น ๆ
                        var daysInMonth = new Date(year, month, 0).getDate();

                        // สร้าง label สำหรับทุกวันในเดือนนั้น
                        label = [];
                        for (var i = 1; i <= daysInMonth; i++) {
                            // เพิ่มวันที่ในรูปแบบ YYYY-MM-DD ลงใน label
                            label.push(year + '-' + month.toString().padStart(2, '0') + '-' + i.toString().padStart(2, '0'));
                        }
                    } else if (type_data == 3) {
                        var year = $("#year_input").val();
                        label = [];
                        for (var month = 1; month <= 12; month++) {
                            label.push(year + '-' + month.toString().padStart(2, '0'));
                        }
                    }

                    var areaChartData_book = {
                        labels: label,
                        datasets: []
                    };

                    var areaChartData_book_sum_price = {
                        labels: label,
                        datasets: []
                    };

                    areaChartData_book.datasets = [];
                    areaChartData_book_sum_price.datasets = [];
                    if (data.data.length != 0) {
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

                            if (count_history != 0) {

                                // สร้าง dataset สำหรับแต่ละหนังสือ
                                var dataset1 = {
                                    label: element_bookdata.name_book,
                                    backgroundColor: getRandomColor(),
                                    borderColor: getRandomColor(),
                                    pointRadius: false,
                                    pointColor: getRandomColor(),
                                    pointStrokeColor: getRandomColor(),
                                    pointHighlightFill: getRandomColor(),
                                    pointHighlightStroke: getRandomColor(),
                                    data: [count_history]
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
                                    data: [count_price_sum]
                                };
                                areaChartData_book.datasets.push(dataset1);
                                areaChartData_book_sum_price.datasets.push(dataset2);
                            }
                        });
                    } else {
                        bookData.forEach(element_bookdata => {
                            $("#count_history_" + element_bookdata.id_book).text(0 + ' ครั้ง');
                            $("#count_price_sum_" + element_bookdata.id_book).text(0 + ' บาท');
                        })
                        var dataset1 = {
                            label: "ไม่มีข้อมูล",
                            backgroundColor: getRandomColor(),
                            borderColor: getRandomColor(),
                            pointRadius: false,
                            pointColor: getRandomColor(),
                            pointStrokeColor: getRandomColor(),
                            pointHighlightFill: getRandomColor(),
                            pointHighlightStroke: getRandomColor(),
                            data: [0]
                        };
                        var dataset2 = {
                            label: "ไม่มีข้อมูล",
                            backgroundColor: getRandomColor(),
                            borderColor: getRandomColor(),
                            pointRadius: false,
                            pointColor: getRandomColor(),
                            pointStrokeColor: getRandomColor(),
                            pointHighlightFill: getRandomColor(),
                            pointHighlightStroke: getRandomColor(),
                            data: [0]
                        };
                        areaChartData_book.datasets.push(dataset1);
                        areaChartData_book_sum_price.datasets.push(dataset2);
                    }


                    //-------------
                    //- BAR CHART -
                    //-------------
                    var barChart_count_sale = $('#barChart_count_sale').get(0).getContext('2d');
                    var barChartData1 = $.extend(true, {}, areaChartData_book);
                    var temp0 = areaChartData_book.datasets[0];
                    var temp1 = areaChartData_book.datasets[1];
                    barChartData1.datasets[0] = temp1;
                    barChartData1.datasets[1] = temp0;

                    var barChart_count_sum_price = $('#barChart_count_sum_price').get(0).getContext('2d');
                    var barChartData2 = $.extend(true, {}, areaChartData_book_sum_price);
                    var temp2 = areaChartData_book_sum_price.datasets[0];
                    var temp3 = areaChartData_book_sum_price.datasets[1];
                    barChartData2.datasets[0] = temp2;
                    barChartData2.datasets[1] = temp3;

                    var barChartOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        datasetFill: false,
                        scales: {
                            yAxes: [{
                                display: true,
                                ticks: {
                                    min: 0, // minimum value
                                }
                            }]
                        }
                    };


                    // ในฟังก์ชั่น success หลังจาก Swal.close();

                    // เลือก canvas ของ chart เก่า
                    var barChartCanvasCountSale = $('#barChart_count_sale')[0];
                    var barChartCanvasCountSumPrice = $('#barChart_count_sum_price')[0];

                    // ล้างข้อมูลเก่าใน canvas ของ chart
                    barChartCanvasCountSale.getContext('2d').clearRect(0, 0, barChartCanvasCountSale.width, barChartCanvasCountSale.height);
                    barChartCanvasCountSumPrice.getContext('2d').clearRect(0, 0, barChartCanvasCountSumPrice.width, barChartCanvasCountSumPrice.height);

                    // ทำลาย chart เก่า (ถ้ามี)
                    if (barChartCanvasCountSale.chart) {
                        barChartCanvasCountSale.chart.destroy();
                    }

                    if (barChartCanvasCountSumPrice.chart) {
                        barChartCanvasCountSumPrice.chart.destroy();
                    }

                    // สร้าง chart ใหม่
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
            })
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