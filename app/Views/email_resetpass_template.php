<!-- email_template.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .reset-password-link {
            color: blue;
            background-color: #86d9ab;
            padding: 10px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-block;
        }

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
                <h3 style="color: black; font-weight: 600;">สวัสดีคุณ <?= $data['name'] ?> <?= $data['lastname'] ?></h3>
                <h3 style="color: black; font-weight: 400;">คุณเพิ่งขอรีเซ็ตรหัสผ่านสำหรับบัญชี ร้านบางเล่ม ของคุณ คลิกปุ่มด้านล่างเพื่อเปลี่ยนแปลงรหัสผ่าน</h3>
                <a href="<?= $url_resetpassword ?>" class="reset-password-link">เปลี่ยนรหัสผ่าน</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 footer">
                <h3 style="color: white; font-weight: 400;">หากไม่สามารถเปลี่ยนรหัสผ่านได้ กรุณาติดต่อเจ้าหน้าที่</h3>
            </div>
        </div>
    </div>
</body>
</html>
