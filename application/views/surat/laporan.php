<div class="content">
    <div class="container-fluid">

        <?php $tanggal = date('Y-m-d'); ?>
        <?php echo form_open('cetak_laporan/export', 'role="form" class="form-horizontal" data-parsley-validate novalidate'); ?>
        <div class="card shadow">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">mail_outline</i>
            </div> 
            <div class="card-content">
                <h4 class="card-title">Laporan</h4>
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-4 my-auto">
                            <input type="text" data-parsley-trigger="change" name="tgl_mulai" class="form-control" id="tgl_mulai">
                            <script>
                                $(function() {
                                    $('input[name="tgl_mulai"]').daterangepicker({
                                        singleDatePicker: true,
                                        showDropdowns: true,
                                        maxDate: new Date("<?php echo $tanggal; ?>")
                                    });
                                });
                            </script>
                        </div>
                        <div class="col-md-2 text-center">
                            <h4><b>Sampai Tanggal</b></h4>
                        </div>
                        <div class="form-group col-md-4 my-auto">
                            <input type="text" data-parsley-trigger="change" name="tgl_akhir" class="form-control" id="tgl_akhir">
                            <script>
                                $(function() {
                                    $('input[name="tgl_akhir"]').daterangepicker({
                                        singleDatePicker: true,
                                        showDropdowns: true,
                                        maxDate: new Date("<?php echo $tanggal; ?>")
                                    });
                                });
                            </script>
                        </div>
                        <div class="col-md-2 text-center m-auto">
                            <button class="btn btn-success" type="submit">
                                Cetak
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
</div>

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>