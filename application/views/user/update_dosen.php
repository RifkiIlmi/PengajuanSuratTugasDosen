<div class="content">
    <div class="container-fluid">
        <!-- Page Heading -->

        <?php
        echo form_open_multipart('user_management/update/' . $detail['nip'], 'role="form" class="form" id="update" ');
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">edit</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Data Pribadi <?= $detail['nama'] ?></h4>

                        <!-- nip atau nik  -->
                        <div class="form-group label-floating">
                            <label>NIP/NIK<span class="text-danger">*</span></label>
                            <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
                            <input type="text" value="<?= $detail['nip'] ?>" class="form-control form-control-user" id="nip" name="nip">
                        </div>

                        <!-- gelar dan nama  -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label>Gelar Depan<span class="text-danger">*</span></label>
                                    <?= form_error('gelar_depan', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <input type="text" value="<?= $detail['gelar_depan'] ?>" class="form-control form-control-user" id="gelar_depan" name="gelar_depan">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label>Nama<span class="text-danger">*</span></label>
                                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <input type="text" value="<?= $detail['nama'] ?>" class="form-control form-control-user" id="nama" name="nama">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label>Gelar Belakang<span class="text-danger">*</span></label>
                                    <?= form_error('gelar_belakang', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <input type="text" value="<?= $detail['gelar_belakang'] ?>" class="form-control form-control-user" id="gelar_belakang" name="gelar_belakang">
                                </div>
                            </div>
                        </div>

                        <!-- tempat tanggal Lahir -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label>Tempat Lahir<span class="text-danger">*</span></label>
                                    <?= form_error('tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <input type="text" value="<?= $detail['tempat_lahir'] ?>" class="form-control form-control-user" id="tempat_lahir" name="tempat_lahir">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <?php $tanggal = date('Y-m-d'); ?>
                                    <label>Tangal Lahir<span class="text-danger">*</span></label>
                                    <?= form_error('tanggal_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <input type="text" value="<?= date('m-d-Y', strtotime($detail['tanggal_lahir'])) ?>" class="form-control form-control-user" id="tanggal_lahir" name="tanggal_lahir">
                                </div>
                                <script>
                                    $('input[name="tanggal_lahir"]').daterangepicker({
                                        singleDatePicker: true,
                                        showDropdowns: true,
                                        maxDate: new Date("<?php echo $tanggal; ?>")
                                    });
                                </script>
                            </div>
                        </div>

                        <!-- skill -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group label-floating">
                                    <label>Pangkat dan Golongan<span class="text-danger">*</span></label>
                                    <?= form_error('pangkat_gol', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <input type="text" value="<?= $detail['pangkat_gol'] ?>" class="form-control form-control-user" id="pangkat_gol" name="pangkat_gol">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group label-floating">
                                    <label>Jabatan<span class="text-danger">*</span></label>
                                    <?= form_error('jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <input type="text" value="<?= $detail['jabatan'] ?>" class="form-control form-control-user" id="jabatan" name="jabatan">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group label-floating">
                                    <label>Spesialisasi<span class="text-danger">*</span></label>
                                    <?= form_error('spesialisasi', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <input type="text" value="<?= $detail['spesialisasi'] ?>" class="form-control form-control-user" id="spesialisasi" name="spesialisasi">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group label-floating">
                                    <label>Pendidikan<span class="text-danger">*</span></label>
                                    <?= form_error('pendidikan', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <input type="text" value="<?= $detail['pendidikan'] ?>" class="form-control form-control-user" id="pendidikan" name="pendidikan">
                                </div>
                            </div>
                        </div>

                        <!-- bekerja di  -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label>Fakultas<span class="text-danger">*</span></label>
                                    <?= form_error('fakultas', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <select id="fakultas" class="form-control" name="fakultas" onchange="tampilkan()">
                                        <option disabled>Pilih Fakultas</option>
                                        <option value="Dakwah dan Komunikasi">Dakwah dan
                                            Komunikasi
                                        </option>
                                        <option value="Ekonomi dan Ilmu Sosial">Ekonomi dan
                                            Ilmu Sosial
                                        </option>
                                        <option value="Pertanian dan Peternakan">Pertanian
                                            dan Peternakan
                                        </option>
                                        <option value="Psikologi">Psikologi</option>
                                        <option value="Syariah dan Ilmu Hukum">Syariah dan
                                            Ilmu Hukum
                                        </option>
                                        <option value="Sains dan Teknologi">Sains dan
                                            Teknologi</option>
                                        <option value="Tarbiyah dan Keguruan">Tarbiyah dan
                                            Keguruan</option>
                                        <option value="Ushuluddin">Ushuluddin</option>
                                        <option value="Pasca Sarjana">Pasca Sarjana</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label>Program Studi<span class="text-danger">*</span></label>
                                    <?= form_error('prodi', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <select class="form-control" title="Pilih Jurusan" data-style="select-with-transition" id="tampil" name="prodi">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- alamat -->
                        <div class="form-group label-floating">
                            <label>Alamat<span class="text-danger">*</span></label>
                            <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                            <input type="text" value="<?= $detail['alamat'] ?>" class="form-control form-control-user" id="alamat" name="alamat">
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-md-4"></div>
            <div class="col-lg-4 ">
                <a type="submit" id='update' class="btn btn-primary btn-block update">
                    Update
                </a>
            </div>
            <div class="col-md-4"></div>
        </div>

    </div>
    </form>
</div>
</div>

</div>
<!-- script untuk menampilkan notice sebelum update -->
<script>
    $('.update').on("click", function(e) {
        e.preventDefault();
        var url = $(this).parents('#update');
        swal({
                title: "Are you sure?",
                text: "Apakah data sudah benar?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Ya!',
                cancelButtonText: "Tidak, Batal!",
                confirmButtonClass: "btn-success",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    url.submit();
                } else {
                    swal("Cek kembali");
                }
            });
    });
</script>

<!-- script untuk tampil jurusan -->
<script>
    function tampilkan() {
        var nama_fakultas = document.getElementById("update").fakultas.value;
        if (nama_fakultas == "Dakwah dan Komunikasi") {
            document.getElementById("tampil").innerHTML =
                "<option value='Ilmu Komunikasi'>Ilmu Komunikasi</option><option value='Pengembangan Masyarakat Islam'>Pengembangan Masyarakat Islam</option><option value='Manajemen Dakwah'>Manajemen Dakwah</option><option value='Bimbingan Konseling Islam'>Bimbingan Konseling Islam</option>";
        } else if (nama_fakultas == "Ekonomi dan Ilmu Sosial") {
            document.getElementById("tampil").innerHTML =
                "<option value='Manajemen'>Manajemen</option><option value='Administrasi Negara S1'>Administrasi Negara S1</option><option value='Akuntansi S1'>Akuntansi S1</option><option value='D.III Manajemen Perusahaan'>D.III Manajemen Perusahaan</option><option value='D.III Akuntansi'>D.III Akuntansi</option><option value='D.III Administrasi Perpajakan'>D.III Administrasi Perpajakan</option>";
        } else if (nama_fakultas == "Pertanian dan Peternakan") {
            document.getElementById("tampil").innerHTML =
                "<option value='Peternakan'>Peternakan</option><option value='Agroteknologi'>Agroteknologi</option><option value='Gizi'>Gizi</option>";
        } else if (nama_fakultas == "Psikologi") {
            document.getElementById("tampil").innerHTML =
                "<option value='S1 Psikologi'>S1 Psikologi</option><option value='S2 Psikologi'>S2 Psikologi</option>";
        } else if (nama_fakultas == "Syariah dan Ilmu Hukum") {
            document.getElementById("tampil").innerHTML =
                "<option value='Ahwal Al-Syakhshiyyah'>Ahwal Al-Syakhshiyyah</option><option value='Jinayah Siyasah'>Jinayah Siyasah</option><option value='Perbandingan Mazhab dan Hukum'>Perbandingan Mazhab dan Hukum</option><option value='Muammalah'>Muammalah</option><option value='Ekonomi Islam'>Ekonomi Islam</option><option value='Ilmu Hukum'>Ilmu Hukum</option><option value='D.III Perbankan Syariah'>D.III Perbankan Syariah</option>";
        } else if (nama_fakultas == "Sains dan Teknologi") {
            document.getElementById("tampil").innerHTML =
                "<option value='Teknik Informatika'>Teknik Informatika</option><option value='Sistem Informasi'>Sistem Informasi</option><option value='Teknik Industri'>Teknik Industri</option><option value='Matematika'>Matematika</option><option value='Teknik Elektro'>Teknik Elektro</option>";
        } else if (nama_fakultas == "Tarbiyah dan Keguruan") {
            document.getElementById("tampil").innerHTML =
                "<option value='Manajemen Pendidikan Islam'>Manajemen Pendidikan Islam</option><option value='Pendidikan Agama Islam'>Pendidikan Agama Islam</option><option value='Pendidikan Bahasa Arab'>Pendidikan Bahasa Arab</option><option value='Pendidikan Bahasa Indonesia'>Pendidikan Bahasa Indonesia</option><option value='Pendidikan Bahasa Inggris'>Pendidikan Bahasa Inggris</option><option value='Pendidikan Ekonomi'>Pendidikan Ekonomi</option><option value='Pendidikan Geografi'>Pendidikan Geografi</option><option value='Pendidikan Guru Madrasah Ibtidaiyah'>Pendidikan Guru Madrasah Ibtidaiyah</option><option value='Pendidikan Kimia'>Pendidikan Kimia</option><option value='Pendidikan Matematika'>Pendidikan Matematika</option><option value='Tadris Ipa'>Tadris Ipa</option>";
        } else if (nama_fakultas == "Ushuluddin") {
            document.getElementById("tampil").innerHTML =
                "<option value='Aqidah dan Filsafat'>Aqidah dan Filsafat</option><option value='Tafsir Hadits'>Tafsir Hadits</option><option value='Ilmu Hadits'>Ilmu Hadits</option><option value='Perbandingan Agama'>Perbandingan Agama</option>";
        } else if (nama_fakultas == "Pasca Sarjana") {
            document.getElementById("tampil").innerHTML =
                "<option value='Pasca Sarjana'>Pasca Sarjana</option>";
        }
    }
</script>