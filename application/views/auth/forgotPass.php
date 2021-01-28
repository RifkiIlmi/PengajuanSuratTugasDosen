<nav class="navbar navbar-primary navbar-transparent navbar-absolute">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= base_url('auth') ?>">Surat Tugas Penelitian Dosen</a>
        </div>
    </div>
</nav>
<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" filter-color="black" data-image="<?= base_url() ?>assets/img/loginn.jpg">
        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                        <?php if ($judul == 'Change Password') : ?>
                            <form class="user" method="post" action="<?= base_url('auth/changePassword') ?>">
                                <div class="card card-login card-hidden">
                                    <div class="card-header text-center" data-background-color="purple">
                                        <h4 class="card-title">Change your password for</h4>
                                        <h5><?= $this->session->userdata('reset_email'); ?></h5>
                                    </div>
                                    <p class="category text-center">
                                        <?= $this->session->flashdata('message'); ?>
                                    </p>
                                    <div class="card-content">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label for="new_password1" class="control-label">
                                                    New Password
                                                    <small>*</small>
                                                </label>
                                                <input class="form-control" id="new_password1" name="new_password1" type="password" />
                                                <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label for="new_password2" class="control-label">
                                                    Repeat Password
                                                    <small>*</small>
                                                </label>
                                                <input class="form-control" id="new_password2" name="new_password2" type="password" />
                                                <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">Change Password</button><br>
                                        <a href="<?= base_url('auth') ?>">Back to login</a>
                                    </div>
                                </div>
                            </form> <?php else : ?>
                            <form class="user" method="post" action="<?= base_url('auth/forgotPassword') ?>">
                                <div class="card card-login card-hidden">
                                    <div class="card-header text-center" data-background-color="purple">
                                        <h4 class="card-title">Forgot Your Password ?</h4>
                                    </div>
                                    <p class="category text-center">
                                        <?= $this->session->flashdata('message'); ?>
                                    </p>
                                    <div class="card-content">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter your email" value="<?= set_value('email'); ?>">
                                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">Reset Password</button><br>
                                        <a href="<?= base_url('auth') ?>">Back to login</a>
                                    </div>
                                </div>
                            </form>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <p class="copyright pull-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </div>
        </footer>
    </div>
</div>