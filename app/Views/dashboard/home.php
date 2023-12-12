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
                    <div class="col-12 col-sm-12">
                        <div class="card card-navy card-tabs">
                            <div class="card-header">
                                <h3>หนังสือเด่นประจำสัปดาห์ <i class="fas fa-star" style="color: #d3cd22;"></i></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach ($bookData as $key => $value): ?>
                                        <div class="col-md-4">
                                            <div class="card card-profile card-plain text-center">
                                                <div class="">
                                                    <?php
                                                    // Assuming $book['pic_book'] contains the base64-encoded image data
                                                    if ($value['pic_book'] === null) {
                                                        $imageSrc = base_url('dist/img/image-preview.png');
                                                    } else {
                                                        $base64Data = $value['pic_book'];
                                                        $decodedData = base64_decode($base64Data);
                                                        $imageSrc = 'data:image/png;base64,' . base64_encode($decodedData);
                                                    }
                                                    ?>
                                                    <img src="<?= $imageSrc ?>" class="img-fluid" alt="white sample"
                                                        style="height: 30rem;" />
                                                </div>
                                                <div class="card-body">
                                                    <a>
                                                        <div class="text-center">
                                                            <h4 class="">
                                                                <?= $value['name_book'] ?>
                                                            </h4>
                                                            <h6 class="">
                                                                <?= $value['book_author'] ?>
                                                            </h6>
                                                        </div>
                                                    </a>
                                                    <p class="card-description text-center">
                                                        <?php
                                                        $details_book = $value['details'];
                                                        $encoding = mb_detect_encoding($details_book, 'UTF-8,ISO-8859-1');
                                                        $details_book = mb_convert_encoding($details_book, 'UTF-8', $encoding);
                                                        echo strlen($details_book) > 350 ? htmlspecialchars(mb_substr($details_book, 0, 350) . '...', ENT_QUOTES, 'UTF-8') : htmlspecialchars($details_book, ENT_QUOTES, 'UTF-8');
                                                        ?>
                                                    </p>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <a href="<?= site_url('/book/details/') . $value['id_book'] ?>"
                                                        class="btn btn-info btn-round">เพิ่มเติม</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>