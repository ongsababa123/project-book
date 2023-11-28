<footer class="footer bg-success">
    <div class="container">
        <div class="row">
            <nav class="footer-nav">
                <ul>
                    <li>
                        <a href="<?= base_url('/') ?>" style="color: white;">ร้านบางเล่ม</a>
                    </li>
                    <li>
                        <a href="http://blog.creative-tim.com/" style="color: white;">รายการหนังสือ</a>
                    </li>
                    <li>
                        <a href="<?= site_url('/contact') ?>" style="color: white;">ติดต่อเรา</a>
                    </li>
                    <li>
                        <a href="<?= site_url('/contact') ?>" style="color: white;">
                            <?= session()->get('today') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('/contact') ?>" style="color: white;">
                            <?= session()->get('check') ?>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="credits ml-auto">
                <span class="copyright" style="color: white;">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, made with <i class="fas fa-heart heart"></i> by Banglem
                </span>
            </div>
        </div>
    </div>
</footer>
<script>
    $(document).ready(function () {
        var check = <?php echo session()->get('check') ?>;
        console.log(<?php echo session()->get('time') ?>);
        if (check == 1) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: true,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "warning",
                title: '<?php echo session()->get('message_cart') ?>',
            });
        }
    });
</script>