<title>ติดต่อเรา</title>
<style>
    .main {
        display: flex;
        flex-direction: column;
        height: 91vh;
        /* ความสูงเต็มหน้าจอ */
        margin: 0;
    }

    .section {
        flex: 1;
        /* ให้เต็มพื้นที่ที่เหลือ */
    }
</style>
<div class="main">
    <br>
    <div class="section">
        <div class="container ">
            <div class="row text-center">
                <div class="col-md-8 ml-auto mr-auto">
                    <h2 class="title">ติดต่อเรา</h2>
                    <hr>
                    <h3 class="title">ส่งคำติชมหรือเสนอคำแนะนำเพิ่มเติม ทางเรารอข้อความจากคุณอยู่นะ <i
                            class="fas fa-smile-wink" style="color: #eed21b;"></i></h3>
                </div>
            </div>
            <!-- แสดงข้อความ error ถ้ามี -->
            <?php if (session()->has('error')): ?>
                <p>
                    <?= session('error') ?>
                </p>
            <?php endif; ?>
            <form id="form_sendemail" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="name">ชื่อ</label>
                            <input type="text" class="form-control" placeholder="ชื่อจริง" id="name" name="name">
                        </div>
                        <div class="col">
                            <label for="lastname">นามสกุล</label>
                            <input type="text" class="form-control" placeholder="นามสกุล" id="lastname" name="lastname">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">อีเมล</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                        placeholder="อีเมลของคุณ" required>
                </div>
                <div class="form-group">
                    <label for="details">ส่งคำติชมหรือเสนอคำแนะนำเพิ่มเติม</label>
                    <textarea class="form-control" id="details" rows="4" name="details"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submit" value="Submit" id="submit">ส่ง</button>
            </form>
        </div>
    </div>
    <!-- <div class="section mb-5">
        <div class="container ">
            
    </div> -->
</div>


<!-- Your existing HTML code -->

<script>
    $(document).ready(function () {
        $(".overlay").hide();
    });

    $("#form_sendemail").on('submit', function (e) {
        e.preventDefault();
        submitForm();
    });

    function submitForm() {
        // Show the progress bar
        const progressBar = Swal.fire({
            title: 'Submitting...',
            html: '<div class="progress"><div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div>',
            allowOutsideClick: false,
            showCancelButton: false,
            showConfirmButton: false,
            closeOnEsc: false,
            closeOnClickOutside: false,
            didOpen: () => {
                Swal.showLoading();
                // Perform the form submission
                action_('contact/sendEmail', 'form_sendemail', progressBar);
            },
        });
    }

    function action_(url, form, progressBar) {
        var formData = new FormData(document.getElementById(form));
        $.ajax({
            url: '<?= base_url() ?>' + url,
            type: "POST",
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                // Upload progress
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        progressBar.updateProgressBar(percentComplete);
                    }
                }, false);
                return xhr;
            },
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function (response) {
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
                        title: response.message,
                        icon: 'error',
                        confirmButtonText: "ตกลง",
                        showConfirmButton: true
                    });
                }
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    title: "เกิดข้อผิดพลาด",
                    icon: 'error',
                    confirmButtonText: "ตกลง",
                    showConfirmButton: true
                });
            }
        });
    }

    // Extend Swal with a method to update the progress bar
    Swal.updateProgressBar = function (percent) {
        $('.swal2-progress-bar').css('width', percent + '%');
        $('.swal2-progress-bar').attr('aria-valuenow', percent);
    };


    // Add a method to the progress bar
    Swal.mixin({
        input: 'range',
        inputAttributes: {
            min: 0,
            max: 100,
            step: 1
        },
        customClass: {
            container: 'my-swal'
        },
        target: document.getElementById('range')
    }).updateProgressBar(0);
</script>
<script>

    function preventSpacebar(e) {
        if (e.keyCode === 32) {
            e.preventDefault();
        }
    }

    document.getElementById('email').addEventListener('keydown', preventSpacebar);
    document.getElementById('name').addEventListener('keydown', preventSpacebar);
    document.getElementById('lastname').addEventListener('keydown', preventSpacebar);
    document.getElementById('details').addEventListener('keydown', preventSpacebar);
</script>
<script>
    // ฟังก์ชันเพื่อตรวจสอบและป้องกันการพิมพ์ตัวอักษรที่ไม่ต้องการ
    function preventInvalidCharacters(event) {
        const invalidCharacters = ['!', '@', '#', '$', '%']; // ตัวอักษรที่ไม่ต้องการ

        if (invalidCharacters.includes(event.key)) {
            event.preventDefault(); // ยกเลิกการดำเนินการหากตัวอักษรไม่ถูกต้อง
        }
    }

    // เรียกใช้ฟังก์ชันเมื่อพิมพ์ใน input fields
    document.getElementById('name').addEventListener('keypress', preventInvalidCharacters);
    document.getElementById('lastname').addEventListener('keypress', preventInvalidCharacters);
</script>