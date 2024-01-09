
<footer class="footer bg-success">
    <div class="container">
        <div class="row">
            <nav class="footer-nav">
                <ul>
                    <li>
                        <a href="<?= base_url('/') ?>" style="color: white;">ร้านบางเล่ม</a>
                    </li>
                    <li>
                        <a href="<?= site_url('/book/booklist') ?>" style="color: white;">รายการหนังสือ</a>
                    </li>
                    <li>
                        <a href="<?= site_url('/contact') ?>" style="color: white;">ติดต่อเรา</a>
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
        var check_cart = <?php echo session()->get('check') ?>;
        var check_his = <?php echo session()->get('check_his') ?>;
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

        var text = '';
        if (check_cart == '1') {
            text += '<?php echo session()->get('message_cart') ?>' + '<br><hr>';
        }
        if (check_his == '1') {
            text += '<?php echo session()->get('message_his') ?>';
        }
        if (text !== '') {
            Toast.fire({
                icon: "warning",
                title: text,
            })
        }
    });
</script>