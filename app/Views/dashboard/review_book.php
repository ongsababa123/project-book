<title>รีวิวหนังสือ
    <?= $bookData['name_book'] ?>
</title>
<link rel="stylesheet" href="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.css'); ?>">


<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>รีวิวหนังสือ :
                            <?= $bookData['name_book'] ?>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/dashboard/index'); ?>">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">รีวิวหนังสือ :
                                <?= $bookData['name_book'] ?>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card" id="history_user">
                            <div class="card-header">
                                <h2 class="card-title"></h2>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php if (!empty($reviewData)): ?>
                                            <!-- The time line -->
                                            <div class="timeline">
                                                <!-- timeline item -->
                                                <?php foreach ($reviewData as $review): ?>
                                                    <div>
                                                        <i class="fas fa-user bg-green"></i>
                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fas fa-clock"></i> <?= $review['date_time'] ?></span>
                                                            <h3 class="timeline-header"><a href="#">
                                                                    <?= $review['user']['name'] ?>
                                                                    <?= $review['user']['lastname'] ?>
                                                                </a>
                                                                <?php for ($i = 0; $i < $review['rating_value']; $i++): ?>
                                                                    <i class="fas fa-star" style="color: #FFD43B;"></i>
                                                                <?php endfor; ?>
        
                                                                <?php for ($i = 0; $i < 5 - floor($review['rating_value']); $i++): ?>
                                                                    <i class="far fa-star"></i>
                                                                <?php endfor; ?>
                                                            </h3>
                                                            <div class="timeline-body">
                                                                <?= $review['comment'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>

                                                <!-- END timeline item -->
                                                <div>
                                                    <i class="fas fa-star bg-yellow"></i>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <h3>ยังไม่มีรีวิวหนังสือ</h3>
                                        <?php endif; ?>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>