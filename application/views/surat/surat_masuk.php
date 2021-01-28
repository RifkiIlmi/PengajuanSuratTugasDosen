<div class="content">
    <div class="container-fluid">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header card-header-icon" data-background-color="purple">
                                <i class="material-icons">assignment</i>
                            </div>
                            <div class="card-content">
                                <h4 class="card-title">Surat Tugas Penelitian</h4>
                                <div class="toolbar">
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                                </div>
                                <div class="material-datatables">
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul Penelitian</th>
                                                <th>Tujuan Penelitian</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Lama Tugas</th>
                                                <!-- <th>Tim</th> -->
                                                <th class="disabled-sorting text-right">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul Penelitian</th>
                                                <th>Tujuan Penelitian</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Lama Tugas</th>
                                                <!-- <th>Tim</th> -->
                                                <th class="text-right">Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php if ($akun['id_user_type'] === '1') : ?>
                                                <?php $no = 0;
                                                    foreach ($surat_masuk as $item) : $no++; ?>
                                                    <tr>
                                                        <td><?= $no . "." ?></td>
                                                        <td><?= $item->judul_penelitian; ?></td>
                                                        <td><?= $item->tujuan_penelitian; ?></td>
                                                        <td><?= date('d F Y', strtotime($item->tgl_mulai)); ?></td>
                                                        <td><?= $item->lama_tugas . " Hari" ?></td>
                                                        <td class="text-center">
                                                            <?php echo anchor(
                                                                        'surat_masuk/detail/' . $item->id_detail_surat,
                                                                        '<i class="fa fa-eye" aria-hidden="true"></i>',
                                                                        array(
                                                                            'class' => 'btn btn-primary btn-sm',
                                                                            'data-toggle' => 'tooltip',
                                                                            'data-placement' => 'bottom',
                                                                            'title' => 'Lihat Detail'
                                                                        )
                                                                    ); ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <?php if ($akun['id_user_type'] === '3') : ?>
                                                <?php $no = 0;
                                                    foreach ($surat_masukP as $item) : $no++; ?>
                                                    <tr>
                                                        <td><?= $no . "." ?></td>
                                                        <td><?= $item->judul_penelitian; ?></td>
                                                        <td><?= $item->tujuan_penelitian; ?></td>
                                                        <td><?= date('d F Y', strtotime($item->tgl_mulai)); ?></td>
                                                        <td><?= $item->lama_tugas . " Hari" ?></td>
                                                        <td class="text-center">
                                                            <?php echo anchor(
                                                                        'surat_masuk/detail/' . $item->id_detail_surat,
                                                                        '<i class="fa fa-eye" aria-hidden="true"></i>',
                                                                        array(
                                                                            'class' => 'btn btn-primary btn-sm',
                                                                            'data-toggle' => 'tooltip',
                                                                            'data-placement' => 'bottom',
                                                                            'title' => 'Lihat Detail'
                                                                        )
                                                                    ); ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>

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
    </div>
</div>
</div>
