<div class="content">
    <div class="container-fluid">
        <!-- Page Heading -->

        <div class="row">
            <?php if ($akun['password'] === '12345') : ?>
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <a class="btn btn-lg btn-warning" href="<?= base_url('user_changePass/encrypt') ?>">You Must Encrypt Password First Before Change it!</a>
                </div>
            <?php else : ?>
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card">
                        <form action="<?= base_url('user_changePass') ?>" method="post">
                            <div class="card-header card-header-icon" data-background-color="rose">
                                <i class="material-icons">vpn_key</i>
                            </div>
                            <div class="card-content">
                                <h4 class="card-title">Form change password</h4>
                                <?= $this->session->flashdata('message'); ?>
                                <div class="form-group label-floating">
                                    <label for="current_password" class="control-label">
                                        Current Password
                                        <small>*</small>
                                    </label>
                                    <input class="form-control" id="current_password" name="current_password" type="password" />
                                    <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group label-floating">
                                    <label for="new_password1" class="control-label">
                                        New Password
                                        <small>*</small>
                                    </label>
                                    <input class="form-control" id="new_password1" name="new_password1" type="password" />
                                    <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group label-floating">
                                    <label for="new_password2" class="control-label">
                                        Repeat Password
                                        <small>*</small>
                                    </label>
                                    <input class="form-control" id="new_password2" name="new_password2" type="password" />
                                    <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-footer text-right">
                                    <button type="submit" class="btn btn-rose btn-fill">Change Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
</div>
