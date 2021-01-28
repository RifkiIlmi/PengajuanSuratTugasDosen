<div class="content">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">

            <div class="col-md-12">
                <a href="<?= base_url('user_management/tambah') ?>" class="btn btn-md btn-primary ml-0">
                    <i class="material-icons">person_add</i> Tambah Dosen
                </a>
                <div class="card shadow">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">people</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">List User</h4>
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                            <?= $this->session->flashdata('message'); ?>

                        </div>
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP/NIK</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Hak Akses</th>
                                        <!-- <th>Tim</th> -->
                                        <th class="disabled-sorting text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP/NIK</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Hak Akses</th>
                                        <!-- <th>Tim</th> -->
                                        <th class="text-right">Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($dosen as $item) : $no++; ?>
                                        <tr>
                                            <td><?= $no . "." ?></td>
                                            <td><?= $item->nip; ?></td>
                                            <td> <?= $item->gelar_depan . ' ' . $item->nama . ' ' . $item->gelar_belakang ?></td>
                                            <td><?= $item->email ?></td>
                                            <td>
                                                <select class="hak-akses" name="id_user_type" data-iduser="<?= $item->id_user ?>">
                                                    <option><?= $item->user_type ?></option>
                                                    <option data-id="1">Staff LPPM</option>
                                                    <option data-id="2">Dosen</option>
                                                    <option data-id="3">Pimpinan</option>
                                                </select>
                                                <script>
                                                    $('select').change(function() {
                                                        const userType = $(this).find(':selected').data('id');
                                                        const idUser = $(this).data('iduser');

                                                        $.ajax({
                                                            url: "<?= site_url('user_management/changeaccess'); ?>",
                                                            type: "POST",
                                                            data: {
                                                                userType: userType,
                                                                idUser: idUser
                                                            },
                                                            success: function() {
                                                                document.location.href = "<?= base_url('user_management') ?>"
                                                            },

                                                        });

                                                    });
                                                </script>
                                            </td>
                                            <td class="td-actions text-right">
                                                <button type="button" data-toggle="modal" data-target="#modal-see<?= $item->nip; ?>" rel="tooltip" class="btn btn-info btn-round" data-toggle="tooltip" data-placement="bottom" title="Detail" aria-hidden="true">
                                                    <i class="material-icons">person</i>
                                                </button>
                                                <a href="user_management/update/<?= $item->nip ?>" type="button" rel="tooltip" class="btn btn-success btn-round" data-toggle="tooltip" data-placement="bottom" title="Edit" aria-hidden="true">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <button type="button" data-toggle="modal" data-target="#delete<?= $item->nip; ?>" rel="tooltip" class="btn btn-danger btn-round" data-toggle="tooltip" data-placement="bottom" title="Hapus" aria-hidden="true">
                                                    <i class="material-icons">close</i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
</div>
</div>

<!-- Lihat Dosen Modal-->
<?php $no = 0;
foreach ($dosen as $item) : $no++; ?>
    <div class="modal fade" id="modal-see<?= $item->nip; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                    <!-- <span aria-hidden="true">&times;</span> -->
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">

                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th scope="row">NIP/NIK</th>
                                    <td>:</td>
                                    <td>
                                        <?= $item->nip ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Nama</th>
                                    <td>:</td>
                                    <td>
                                        <?= $item->gelar_depan . ' ' . $item->nama . ' ' . $item->gelar_belakang ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Tempat/Tanggal Lahir</th>
                                    <td>:</td>
                                    <td>
                                        <?= $item->tempat_lahir . ' ' . $item->tanggal_lahir ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Prodi/Fakultas</th>
                                    <td>:</td>
                                    <td>
                                        <?= $item->prodi . ' ' . $item->fakultas ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Pangkat/Golongan</th>
                                    <td>:</td>
                                    <td>
                                        <?= $item->pangkat_gol ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Jabatan</th>
                                    <td>:</td>
                                    <td>
                                        <?= $item->jabatan ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Spesialisasi</th>
                                    <td>:</td>
                                    <td>
                                        <?= $item->spesialisasi ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Alamat</th>
                                    <td>:</td>
                                    <td>
                                        <?= $item->alamat ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Pendidikan</th>
                                    <td>:</td>
                                    <td>
                                        <?= $item->pendidikan ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- hapus dosen modal  -->
<?php foreach ($dosen as $item) : ?>
    <div class="modal fade" id="delete<?= $item->nip; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <?= form_open('user_management/delete/' . $item->nip) ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
            </div> -->
                <div class="modal-body text-center">
                    <h4 class="card-title">Yakin ingin menghapus <?= $item->nama ?>??</h4>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary pull-left" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Yakin</button>
                </div>
            </div>
        </div>
        </form>
    </div>
<?php endforeach; ?>

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }

        });


        var table = $('#datatables').DataTable();

        // Edit record
        table.on('click', '.edit', function() {
            $tr = $(this).closest('tr');

            var data = table.row($tr).data();
            alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });

        // Delete a record
        table.on('click', '.remove', function(e) {
            $tr = $(this).closest('tr');
            table.row($tr).remove().draw();
            e.preventDefault();
        });

        //Like record
        table.on('click', '.like', function() {
            alert('You clicked on Like button');
        });

        $('.card .material-datatables label').addClass('form-group');
    });
</script>