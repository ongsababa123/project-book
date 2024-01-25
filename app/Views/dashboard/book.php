<title>ข้อมูลหนังสือ</title>
<link rel="stylesheet" href="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.css'); ?>">

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>ข้อมูลหนังสือ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/dashboard/index'); ?>">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">ข้อมูลหนังสือ</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-lightblue">
                                <h4 class="card-title">
                                    <div class="row">
                                        <div class="col-10 text-center">
                                            <label for="categorySelect">เลือกหมวดหมู่</label>
                                            <div class="form-group">
                                                <select name="categorySelect" id="categorySelect" class="form-control">
                                                    <option value="0">ทั้งหมด</option>
                                                    <?php foreach ($categoryData as $key => $value): ?>
                                                        <option value="<?= $value['id_category'] ?>">
                                                            <?= $value['name_category'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2 text-center">
                                            <label for="">&nbsp;</label>
                                            <button type="submit" class="btn btn-dark"
                                                onclick="getTableData()">ค้นหา</button>
                                        </div>
                                    </div>
                                </h4>
                                <br>
                                <div class="card-tools">
                                    <?php if (session()->get('type') == '2'): ?>
                                        <button type="button" class="btn btn-block-tool btn-dark btn-sm" data-toggle="modal"
                                            data-target="#modal-default" onclick="load_modal(1)">สร้างหนังสือ</button>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="table_book" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ภาพหนังสือ</th>
                                                    <th>ชื่อหนังสือ</th>
                                                    <th>ราคาเช่า</th>
                                                    <th>ราคาหนังสือ</th>
                                                    <th>จำนวนในคลัง <br> (พร้อมใช้งาน)</th>
                                                    <th>สถานะหนังสือ</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="overlay dark">
                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <div class="modal fade" id="modal-default">
        <div id="CRUD_Book">
            <?= $this->include("modal/CRUD_Book"); ?>
        </div>
    </div>

    <script src="<?= base_url('plugins/filterizr/jquery.filterizr.min.js') ?>"></script>
    <script src="<?= base_url('plugins/ekko-lightbox/ekko-lightbox.min.js') ?>"></script>

    <script>
        $(document).ready(function () {
            getTableData();
        })
    </script>
    <script>
        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function (event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.btn[data-filter]').on('click', function () {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>
    <script>
        function load_modal(load_check, data_encode) {
            CRUD_Book = document.getElementById("CRUD_Book");
            var categoryData = <?php echo json_encode($categoryData); ?>;
            $(".modal-body #categorySelect").empty();
            $(".modal-body #name_book").val('');
            $(".modal-body #name_book_author").val('');
            $(".modal-body #detail_category").val('');
            $(".modal-body #price_book").val('');
            $(".modal-body #price_book_book").val('');
            $(".modal-body #uploadImage").val('');
            $(".modal-body #stock_book").val('');
            $(".modal-body #stock").hide();
            $(".modal-body #image-preview-").attr("src", '<?= base_url("dist/img/image-preview.png"); ?>');
            $(".modal-body #image-preview-extra-").attr("href", '<?= base_url("dist/img/image-preview.png"); ?>');
            if (load_check == 1) {
                CRUD_Book.style.display = "block";
                categoryData.forEach(element_cat => {
                    if (element_cat.status == 1) {
                        var newOption = $('<option>').val(element_cat.id_category).text(element_cat.name_category);
                        $(".modal-body #categorySelect").append(newOption);
                    }
                });
                $(".modal-body #name_book, #name_book_author, #detail_category,  #price_book_book, #stock_book, #categorySelect").prop('disabled', false);
                $(".modal-body #upload").show();
                $(".modal-header #title_modal").text("สร้างข้อมูลหนังสือ");
                $(".modal-footer #submit").text("สร้างข้อมูลหนังสือ");
                $(".modal-body #url_route").val("dashboard/book/create");
            } else if (load_check == 2) {
                const rowData = JSON.parse(decodeURIComponent(data_encode));
                categoryData.forEach(element_cat => {
                    var newOption = $('<option></option>').val(element_cat.id_category).text(element_cat.name_category);
                    if (element_cat.id_category == rowData.category_id) {
                        $(".modal-body #categorySelect").append(newOption.prop('selected', true));
                    } else {
                        if (element_cat.status == 1) {
                            $(".modal-body #categorySelect").append(newOption);
                        }
                    }
                });
                $(".modal-body #name_book").val(rowData.name_book);
                $(".modal-body #name_book_author").val(rowData.book_author);
                $(".modal-body #detail_category").val(rowData.details);
                $(".modal-body #price_book").val(rowData.price);
                $(".modal-body #price_book_book").val(rowData.price_book);
                $(".modal-body #stock_book").val(rowData.count_stock);
                $(".modal-body #stock").show();
                $(".modal-body #name_book, #name_book_author, #detail_category,  #price_book_book, #stock_book, #categorySelect").prop('disabled', true);
                $(".modal-body #upload").hide();
                if (rowData.pic_book == null) {
                    var imageSrc = '<?= base_url("dist/img/image-preview.png"); ?>';
                } else {
                    var imageSrc = "data:image/png;base64," + rowData.pic_book;
                }
                $(".modal-body #image-preview-").attr("src", imageSrc);
                $(".modal-body #image-preview-extra-").attr("href", imageSrc);
                $(".modal-header #title_modal").text("แก้ไขข้อมูลหนังสือ");
                $(".modal-footer #submit").text("แก้ไขข้อมูลหนังสือ");
                $(".modal-body #url_route").val("dashboard/book/edit/" + rowData.id_book);
            }
        }
    </script>
    <script>
        function action_(url, form) {
            var formData = new FormData(document.getElementById(form));
            $.ajax({
                url: '<?= base_url() ?>' + url,
                type: "POST",
                cache: false,
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                beforeSend: function () {
                    // Show loading indicator here
                    var loadingIndicator = Swal.fire({
                        title: 'กําลังดําเนินการ...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
                },
                success: function (response) {
                    Swal.close();
                    if (response.success) {
                        Swal.fire({
                            title: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                        setTimeout(() => {
                            if (response.reload) {
                                window.location.reload();
                            }
                        }, 2000);
                    } else {
                        Swal.fire({
                            title: response.image_error,
                            icon: 'error',
                            confirmButtonText: "ตกลง",
                            showConfirmButton: true,
                            width: '55%'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        title: "เกิดข้อผิดพลาด",
                        icon: 'error',
                        showConfirmButton: true,
                        confirmButtonText: "ตกลง",
                    });
                }
            });
        }
    </script>
    <script>
        function confirm_Alert(text, url) {
            Swal.fire({
                title: text,
                icon: 'question',
                            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
                confirmButtonColor: "#28a745",
                confirmButtonText: "ตกลง",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>' + url,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
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
                    }).done(function (response) {
                        Swal.close();
                        if (response.success) {
                            Swal.fire({
                                title: response.message,
                                icon: 'success',
                                showConfirmButton: false
                            });
                            setTimeout(() => {
                                if (response.reload) {
                                    window.location.reload();
                                }
                            }, 2000);
                        } else {
                            Swal.fire({
                                title: response.message,
                                icon: 'error',
                                showConfirmButton: true,
                                confirmButtonText: "ตกลง",
                            });
                        }
                    });
                }
            });
        }
    </script>
    <script>
        function getTableData() {
            var id_category = $("#categorySelect").val();
            if ($.fn.DataTable.isDataTable('#table_book')) {
                $('#table_book').DataTable().destroy();
            }
            $('#table_book').DataTable({
                "processing": $("#customer_Table .overlay").show(),
                "pageLength": 5,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?php echo site_url('dashboard/book/getdata/'); ?>" + id_category,
                    'type': 'GET',
                    'dataSrc': 'data',
                },
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "ordering": false,
                "lengthChange": false,
                "autoWidth": false,
                "searching": true,
                "drawCallback": function (settings) {
                    $("#customer_Table .overlay").hide();
                    var daData = settings.json.data;
                    if (daData.length == 0) {
                        $('#table_book tbody').html(`
                        <tr>
                            <td colspan="8" class="text-center">
                                ยังไม่มีข้อมูล
                            </td>
                        </tr>`
                        );
                    }
                },
                'columns': [
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return meta.settings.oAjaxData.start += 1;
                        }
                    },
                    {
                        'data': null,
                        'render': function (data, type, row, meta) {
                            var imageSrc = 'data:image/png;base64,' + data.pic_book;
                            return '<a href="' + imageSrc + '" data-toggle="lightbox" id="image-preview-extra">' +
                                '<img class="img-fluid" style="width: 15rem; height: 12rem" src="' + imageSrc + '" alt="white sample" id="image-preview" />' +
                                '</a>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.name_book;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.price;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.price_book;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return data.count_stock
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            var status_book = data.status_book;
                            if (status_book == 0) {
                                return "<span class='badge bg-danger'>ยังไม่พร้อมใช้งาน</span>";
                            } else if (status_book == 1) {
                                return "<span class='badge bg-success'>พร้อมใช้งาน</span>";
                            } else if (status_book == 2) {
                                return "<span class='badge bg-info'>กำลังเช่า</span>";
                            }
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            const encodedRowData = encodeURIComponent(JSON.stringify(row));
                            return `<button type="button" class="btn btn-block-tool btn-info btn-sm mb-2" data-toggle="modal" data-target="#modal-default"
                                onclick="load_modal(2, '${encodedRowData}')">รายละเอียด</button>
                                <hr>
                                <a type="button" class="btn btn-block-tool btn-warning btn-sm mb-2" target="_blank" href="<?= site_url('dashboard/book/stock/index/'); ?>${data.id_book}">จัดการคลัง</a>`;
                        }
                    },
                ]
            });
            $('[data-toggle="tooltip"]').tooltip();
        }
    </script>