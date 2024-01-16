<!-- email_template.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .header {
            background-color: #86d9ab;
            padding: 10px;
            text-align: center;
        }

        .content {
            background-color: #fcd27b;
            padding: 10px;
            text-align: center;
        }

        .footer {
            background-color: #86d9ab;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div>
        <div class="row">
            <div class="col-md-12 header">
                <img src="<?= $imagePath ?>" style="width: 30%;" data-bit="iit">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 content">
                <h3 style="color: black; font-weight: 600;">สวัสดีคุณ
                    <?= $data['name'] ?>
                    <?= $data['lastname'] ?>
                </h3>
                <h3 style="color: black; font-weight: 400;">รหัสผ่านสำรองของคุณคือ</h3>
                <h1 style="color: blue; font-weight: 400;"><?= $number_random ?></h1>
                <h3 style="color: black; font-weight: 400;">ใช้สำหรับการเข้าสู่ระบบ</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 footer">
                <h3 style="color: white; font-weight: 400;">หากรหัสผ่านสำรองของคุณไม่สามารถใช้ได้ กรุณาติดต่อเจ้าหน้าที่
                </h3>
            </div>
        </div>
    </div>
</body>

</html>