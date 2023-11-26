<title>Profile</title>
<div class="page-header page-header-xs" data-parallax="true"
    style="background-image: url('<?= base_url('dist/img/background.png') ?>');">
    <div class="filter"></div>
</div>
<div class="main">
    <div class="section profile-content mb-3" style="padding-bottom: 8rem;">
        <div class="container">
            <div class="owner">
                <div class="avatar">
                    <img src="<?= base_url('dist/img/avatar7.png') ?>" alt="Circle Image"
                        class="img-circle img-no-padding img-responsive">
                </div>
                <div class="name">
                    <h4 class="title">
                        <?= $user_data[0]['name'] ?>
                        <?= $user_data[0]['lastname'] ?>
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto text-center">
                    <p>อีเมล์ :
                        <?= $user_data[0]['email_user'] ?>
                    </p>
                    <p>เบอร์โทรศัพท์ :
                        <?= $user_data[0]['phone'] ?>
                    </p>
                    <p>จำนวนครั้งที่ยืม :
                        <?= $count_data ?>
                    </p>
                    <br />
                    <btn class="btn btn-outline-default btn-round" data-toggle="modal" data-target="#loginModal"><i
                            class="fa fa-cog"></i> แก้ไขข้อมูล</btn>
                </div>
            </div>
            <br />
        </div>
    </div>
</div>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-register">
        <div class="modal-content">
            <div class="modal-header no-border-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title text-center">แก้ไขข้อมูล</h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label>ชื่อ</label>
                            <input type="text" class="form-control" placeholder="กรอกชื่อของคุณ">
                        </div>
                        <div class="col">
                            <label>นามสกุล</label>
                            <input type="text" class="form-control" placeholder="กรอกนามสกุลของคุณ">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>อีเมล์</label>
                    <input type="text" value="" placeholder="กรอกอีเมล์ของคุณ" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" value="" placeholder="กรอกรหัสผ่านของคุณ (กรณีเปลี่ยนรหัสผ่าน)"
                        class="form-control" />
                </div>
                <button class="btn btn-block btn-round"> บันทึกข้อมูล</button>
            </div>
        </div>
    </div>
</div>
