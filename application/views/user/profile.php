<div class="content">
    <div class="container-fluid">
        <?= $this->session->flashdata('message'); ?>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">perm_identity</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">My Profile -
                            <small class="category">Complete your profile</small>
                        </h4>
                        <?php echo form_open('user_profile/update', 'role="form" class="form" id="form1" '); ?>
                        <input type="hidden" value="<?= $user['nip'] ?>" name="nip">
                        <input type="hidden" value="<?= $user['nama'] ?>" name="nama">
                        <input type="hidden" value="<?= $user['prodi'] ?>" name="prodi">
                        <input type="hidden" value="<?= $user['fakultas'] ?>" name="fakultas">
                        <input type="hidden" value="<?= $user['pendidikan'] ?>" name="pendidikan">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Tempat Lahir</label>
                                    <input type="text" value="<?= $user['tempat_lahir'] ?>" name="tempat_lahir" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <?php $tanggal = date('Y-m-d'); ?>
                                    <label class="control-label">Tanggal Lahir</label>
                                    <input type="text" name="tanggal_lahir" value="<?= date('m-d-Y', strtotime($user['tanggal_lahir'])) ?>" class="form-control">
                                    <script>
                                        $('input[name="tanggal_lahir"]').daterangepicker({
                                            singleDatePicker: true,
                                            showDropdowns: true,
                                            maxDate: new Date("<?php echo $tanggal; ?>")
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Gelar Depan</label>
                                    <input type="text" value="<?= $user['gelar_depan'] ?>" name="gelar_depan" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Gelar Belakang</label>
                                    <input type="text" value="<?= $user['gelar_belakang'] ?>" name="gelar_belakang" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Pangkat/golongan</label>
                                    <input type="text" value="<?= $user['pangkat_gol'] ?>" name="pangkat_gol" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Jabatan</label>
                                    <input type="text" value="<?= $user['jabatan'] ?>" name="jabatan" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Spesialisasi</label>
                                    <input type="text" value="<?= $user['spesialisasi'] ?>" name="spesialisasi" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Email address</label>
                                    <input type="email" value="<?= $akun['email'] ?>" name="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Alamat</label>
                                    <input type="text" value="<?= $user['alamat'] ?>" name="alamat" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="submit" onclick="submitOne()" class="btn btn-rose pull-right">Update Profile</button>
                        <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php echo form_open_multipart('user_profile/update_akun', 'id="form2" '); ?>
                <div class="card card-profile">
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail img-circle card-avatar">
                            <img src="<?= base_url('assets/img/profile/') . $akun['foto'] ?>" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail card-avatar img-circle"></div>
                        <div>
                            <span class="btn btn-round btn-rose btn-file">
                                <span class="fileinput-new">Browse Photo</span> <span class="fileinput-exists">Other</span>
                                <input type="hidden" value="<?= $user['nip'] ?>" name="nip">
                                <input type="hidden" value="<?= $akun['email'] ?>" name="email">
                                <input type="file" name="foto" value="<?= $akun['foto'] ?>" />
                            </span>
                            <span onclick="submitTwo()" class="fileinput-exists btn btn-round btn-success btn-file" type="submit">Save</span>
                            <br />
                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title"><?= $user['nama'] ?></h4>
                        <h4 class="card-title"><?= $user['nip'] ?></h4>
                        <br>
                        <h4 class="card-title">Prodi/Fakultas:</h4>
                        <p class="description">
                            <?= $user['prodi'] ?>
                            <br>
                            <?= $user['fakultas'] ?>
                        </p>
                        <br>
                        <h6 class="card-title">Universitas Islam Negeri Sultan Syarif Kasim Riau</h6>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    function submitOne() {

        $('#form1').submit();
    }

    function submitTwo() {

        $('#form2').submit();
    }
</script>