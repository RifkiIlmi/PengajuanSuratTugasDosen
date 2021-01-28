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
                        <form class="user" method="post" action="<?= base_url('auth') ?>">
                            <div class="card card-login card-hidden">
                                <div class="card-header text-center" data-background-color="purple">
                                    <h4 class="card-title">Login</h4>
                                    <h4>Welcome to SISTP</h4>
                                </div>
                                <?= $this->session->flashdata('message'); ?>
                                <div class="card-content">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">face</i>
                                        </span>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="nip" placeholder="Enter Username..." value="<?= set_value('nip'); ?>">
                                            <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">Login</button><br>
                                    <a href="<?= base_url('auth/forgotPassword') ?>">Forgot Password</a>
                                </div>
                            </div>
                        </form>
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
                    <a href="http://puslit-suska.com" target="_blank">Puslit UIN SUSKA RIAU</a>, website resmi
                </p>
            </div>
        </footer>
    </div>
</div>