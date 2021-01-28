<div class="sidebar" data-active-color="purple" data-background-color="black" data-image="<?= base_url() ?>assets/img/sidebar11.jpg">
    <!-- TODO: hdhsajkd
        Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
        Tip 2: you can also add an image using data-image tag
        Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->
    <div class="logo">
        <a href="http://puslit-suska.com" class="simple-text logo-mini">
            <i class="material-icons">mail</i>
        </a>
        <a href="http://puslit-suska.com" class="simple-text logo-normal">
            Surat Tugas<br>penelitian
        </a>
    </div>
    <div class="sidebar-wrapper">

        <!-- sidebar admin -->
        <?php if ($this->session->userdata('id_user_type') == 1) : ?>
            <!-- <div class="user"> -->
            <div class="user">
                <div class="photo">
                    <img src="<?= base_url('assets/img/profile/') . $akun['foto'] ?>" />
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#tukar" class="collapsed">
                        <span>
                            <?= $user['nama'] ?>
                            <b class="caret"></b>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse" id="tukar">
                        <ul class="nav">
                            <li class="<?= activate_menu('user_profile') ?>">
                                <a href="<?= base_url('user_profile') ?>">
                                    <span class="sidebar-mini"> <i class="material-icons">perm_identity</i></span>
                                    <span class="sidebar-normal">My Profile</span>
                                </a>
                            </li>
                            <li class="<?= activate_menu('user_changePass') ?>">
                                <a href="<?= base_url('user_changePass') ?>">
                                    <span class="sidebar-mini"> <i class="material-icons">vpn_key</i></span>
                                    <span class="sidebar-normal">Change Password</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="user">

                <ul class="nav">
                    <li class="<?= activate_menu('admin') ?>">
                        <a href="<?= base_url('admin') ?>">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                </ul>
                <!-- </div> -->
            </div>
            <!-- <ul class="nav">
                <li class="<?= activate_menu('ajukan_surat') ?>">
                    <a href="<?= base_url('ajukan_surat') ?>">
                        <i class="material-icons">add_box</i>
                        <p>Ajukan Surat</p>
                    </a>
                </li>
                <li class="<?= activate_menu('surat_saya') ?>">
                    <a href="<?= base_url('surat_saya') ?>">
                        <i class="material-icons">mail</i>
                        <p>Surat Saya</p>
                    </a>
                </li>
            </ul> -->

            <!-- <div class="user"> -->
            <ul class="nav">
                <li class="<?= activate_menu('surat_masuk') ?>">
                    <a href="<?= base_url('surat_masuk') ?>">
                        <i class="material-icons">inbox</i>
                        <p>Permohonan Surat</p>
                    </a>
                </li>
                <li class="<?= activate_menu('semua_surat') ?>">
                    <a href="<?= base_url('semua_surat') ?>">
                        <i class="material-icons">mail</i>
                        <p>Semua Surat</p>
                    </a>
                </li>
                <li class="<?= activate_menu('tandatangan') ?>">
                    <a href="<?= base_url('tandatangan') ?>">
                        <i class="material-icons">touch_app</i>
                        <p>Tanda Tangan Surat</p>
                    </a>
                </li>
                <li class="<?= activate_menu('cetak_laporan') ?>">
                    <a href="<?= base_url('cetak_laporan') ?>">
                        <i class="material-icons">local_printshop</i>
                        <p>Cetak Laporan</p>
                    </a>
                </li>
                <li class="<?= activate_menu('user_management') ?>">
                    <a href="<?= base_url('user_management') ?>">
                        <i class="material-icons">people_alt</i>
                        <p>User Management</p>
                    </a>
                </li>
            </ul>


            <!-- </div> -->
            <!-- <hr class="sidebar-divider"> -->
        <?php endif; ?>

        <!-- sidebar pimpinan -->
        <?php if ($this->session->userdata('id_user_type') == 3) : ?>
            <!-- <div class="user"> -->
            <div class="user">
                <div class="photo">
                    <img src="<?= base_url('assets/img/profile/') . $akun['foto'] ?>" />
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#tukar" class="collapsed">
                        <span>
                            <?= $user['nama'] ?>
                            <b class="caret"></b>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse" id="tukar">
                        <ul class="nav">
                            <li class="<?= activate_menu('user_profile') ?>">
                                <a href="<?= base_url('user_profile') ?>">
                                    <span class="sidebar-mini"> <i class="material-icons">perm_identity</i></span>
                                    <span class="sidebar-normal">My Profile</span>
                                </a>
                            </li>
                            <li class="<?= activate_menu('user_changePass') ?>">
                                <a href="<?= base_url('user_changePass') ?>">
                                    <span class="sidebar-mini"> <i class="material-icons">vpn_key</i></span>
                                    <span class="sidebar-normal">Change Password</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="user">

                <ul class="nav">
                    <li class="<?= activate_menu('pimpinan') ?>">
                        <a href="<?= base_url('pimpinan') ?>">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                </ul>
                <!-- </div> -->
            </div>

            <!-- <ul class="nav">
                <li class="<?= activate_menu('ajukan_surat') ?>">
                    <a href="<?= base_url('ajukan_surat') ?>">
                        <i class="material-icons">add_box</i>
                        <p>Ajukan Surat</p>
                    </a>
                </li>
                <li class="<?= activate_menu('surat_saya') ?>">
                    <a href="<?= base_url('surat_saya') ?>">
                        <i class="material-icons">mail</i>
                        <p>Surat Saya</p>
                    </a>
                </li>
            </ul> -->
            <!-- <div class="user"> -->
            <ul class="nav">
                <li class="<?= activate_menu('surat_masuk') ?>">
                    <a href="<?= base_url('surat_masuk') ?>">
                        <i class="material-icons">inbox</i>
                        <p>Peromohonan Surat</p>
                    </a>
                </li>

                <li class="<?= activate_menu('semua_surat') ?>">
                    <a href="<?= base_url('semua_surat') ?>">
                        <i class="material-icons">mail</i>
                        <p>Semua Surat</p>
                    </a>
                </li>
            </ul>
            <!-- </div> -->
            <!-- <hr class="sidebar-divider"> -->
        <?php endif; ?>

        <!-- sidebar dosen -->
        <?php if ($this->session->userdata('id_user_type') == 2) : ?>
            <div class="user">
                <div class="photo">
                    <img src="<?= base_url('assets/img/profile/') . $akun['foto'] ?>" />
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#tukar" class="collapsed">
                        <span>
                            <?= $user['nama'] ?>
                            <b class="caret"></b>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse" id="tukar">
                        <ul class="nav">
                            <li class="<?= activate_menu('user_profile') ?>">
                                <a href="<?= base_url('user_profile') ?>">
                                    <span class="sidebar-mini"> <i class="material-icons">perm_identity</i></span>
                                    <span class="sidebar-normal">My Profile</span>
                                </a>
                            </li>
                            <li class="<?= activate_menu('user_changePass') ?>">
                                <a href="<?= base_url('user_changePass') ?>">
                                    <span class="sidebar-mini"> <i class="material-icons">vpn_key</i></span>
                                    <span class="sidebar-normal">Change Password</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- <div class="user"> -->
            <ul class="nav">
                <li class="<?= activate_menu('user_home') ?>">
                    <a href="<?= base_url('user_home') ?>">
                        <i class="material-icons">home</i>
                        <p>Home</p>
                    </a>
                </li>
            </ul>
            <!-- </div> -->

            <!-- <div class="user"> -->
            <ul class="nav">
                <li class="<?= activate_menu('ajukan_surat') ?>">
                    <a href="<?= base_url('ajukan_surat') ?>">
                        <i class="material-icons">add_box</i>
                        <p>Ajukan Surat</p>
                    </a>
                </li>
                <li class="<?= activate_menu('surat_saya') ?>">
                    <a href="<?= base_url('surat_saya') ?>">
                        <i class="material-icons">mail</i>
                        <p>Surat Saya</p>
                    </a>
                </li>
            </ul>
            <!-- </div> -->
            <!-- <hr class="sidebar-divider"> -->
        <?php endif; ?>
        <!-- <div class="user"> -->
        <ul class="nav">
            <li class="#">
                <a href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="material-icons">forward</i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
        <!-- </div> -->
    </div>
</div>