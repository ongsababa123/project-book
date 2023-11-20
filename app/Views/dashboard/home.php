<title>Dashboard</title>

<style>
    .col-lg-custome {
        -ms-flex: 0 0 16.666667%;
        flex: 1 0 19.666667%;
        max-width: 20.666667%;
    }
</style>

<body class="hold-transition sidebar-mini">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dashboard
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>
                                    <?php
                                    $count = count(array_filter($data_history, function ($value) {
                                        return $value['submit_date'] !== null;
                                    }));
                                    ?>
                                    <?= $count ?>
                                </h3>
                                <p>จำนวนที่คืนแล้ว</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-default"
                                id="load-modal-button">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>
                                    <?php
                                    $count1 = count(array_filter($data_history, function ($value) {
                                        $today = date('Y-m-d');
                                        return $value['submit_date'] == null && $today <= $value['return_date'];
                                    }));
                                    ?>
                                    <?= $count1 ?>
                                </h3>
                                <p>จำนวนที่กำลังยืม</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-sync-alt"></i>
                            </div>
                            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-default"
                                id="load-modal-button">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>
                                    <?php
                                    $count2 = count(array_filter($data_history, function ($value) {
                                        $today = date('Y-m-d');
                                        return $value['submit_date'] == null && $today > $value['return_date'];
                                    }));
                                    ?>
                                    <?= $count2 ?>
                                </h3>
                                <p>จำนวนที่เกินกำหนด</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-default"
                                id="load-modal-button">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <!-- DONUT CHART -->
                        <div class="card card-indigo">
                            <div class="card-header">
                                <h3 class="card-title">Donut Chart</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="donutChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- BAR CHART -->
                        <div class="card card-fuchsia">
                            <div class="card-header">
                                <h3 class="card-title">Bar Chart</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="barChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- ChartJS -->
    <script src="<?= base_url('plugins/chart.js/Chart.min.js'); ?>"></script>
    <!-- jQuery -->
    <script>
        $(document).ready(function () {
            var data_history = <?php echo json_encode($data_history); ?>;
            var countComplate = data_history.filter(function (value) {
                return value.submit_date !== null;
            }).length;
            var today = new Date().toISOString().split('T')[0]; // Get today's date in 'YYYY-MM-DD' format

            var countWaite = data_history.filter(function (value) {
                return value.submit_date === null && today <= value.return_date;
            }).length;

            var countLate= data_history.filter(function (value) {
                return value.submit_date === null && today > value.return_date;
            }).length;

            $(function () {

                //-------------
                //- DONUT CHART -
                //-------------
                // Get context with jQuery - using jQuery's .get() method.
                var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                var donutData = {
                    labels: ['คืนแล้ว', 'กำลังยืม', 'เกินกำหนด'],

                    datasets: [{
                        data: [countComplate, countWaite , countLate],
                        backgroundColor: ['#28a745', '#ffc107' , '#dc3545'],
                    }]
                }
                var donutOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                new Chart(donutChartCanvas, {
                    type: 'doughnut',
                    data: donutData,
                    options: donutOptions
                })

                //-------------
                //- BAR CHART -
                //-------------
                var areaChartData = {
                    labels: ['Data Status'],
                    datasets: [{
                        label: 'คืนแล้ว',
                        backgroundColor: '#28a745',
                        borderColor: '#28a745',
                        pointRadius: false,
                        pointColor: '#28a745',
                        pointStrokeColor: '#28a745',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: '#28a745',
                        data: [countComplate]
                    },
                    {
                        label: 'กำลังยืม',
                        backgroundColor: '#ffc107',
                        borderColor: '#ffc107',
                        pointRadius: false,
                        pointColor: '#ffc107',
                        pointStrokeColor: '#ffc107',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: '#ffc107',
                        data: [countWaite]
                    },
                    {
                        label: 'เกินกำหนด',
                        backgroundColor: '#dc3545',
                        borderColor: '#dc3545',
                        pointRadius: false,
                        pointColor: '#dc3545',
                        pointStrokeColor: '#dc3545',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: '#dc3545',
                        data: [countLate]
                    },
                    ]
                }

                var barChartCanvas = $('#barChart').get(0).getContext('2d')
                var barChartData = $.extend(true, {}, areaChartData)
                var temp0 = areaChartData.datasets[0]
                var temp1 = areaChartData.datasets[1]

                barChartData.datasets[0] = temp0
                barChartData.datasets[1] = temp1

                console.log(barChartData);

                var barChartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    datasetFill: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0
                            }
                        }]
                    }
                };

                new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions
                })
            })
        });
    </script>