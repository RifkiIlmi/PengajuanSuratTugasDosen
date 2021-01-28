<div class="main-panel">
    <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container-fluid">
            <div class="navbar-minimize">
                <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                    <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                    <i class="material-icons visible-on-sidebar-mini">view_list</i>
                </button>
            </div>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"> <?= $judul; ?> </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a data-toggle="collapse" href="#profil" class="collapsed">
                            <span>
                                <?= $user['nama'] ?>
                                <b class="caret"></b>
                            </span>
                        </a>
                        <!-- <div class="clearfix"></div> -->
                        <div class="collapse" id="profil">
                            <div class="card" style="margin-top:-5px;">
                                <ul class="nav">
                                    <li>
                                        <a class="text-dark" href="<?= base_url('user_profile') ?>">
                                            <span>Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-dark" href="#" data-toggle="modal" data-target="#logoutModal">
                                            <span>Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                    </li>
                    <li class="separator hidden-lg hidden-md"></li>
                </ul>
            </div>
        </div>
    </nav>