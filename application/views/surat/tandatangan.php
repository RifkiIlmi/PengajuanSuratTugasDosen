<div class="content">
    <div class="container-fluid">
        <?php
        echo form_open_multipart('tandatangan/sign', 'role="form" class="form" id="sign" ');
        ?>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-7">
                <div class="card shadow">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">touch_app</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Digital Signature</h4>
                        <?= $this->session->flashdata('message'); ?>
                        <label>Choose File</label>
                        <select class="selectpicker" data-style="select-with-transition" title="Nomor Surat" class="form-control" name="file_surat">
                            <option disabled>Nomor Surat</option>
                            <?php foreach ($nosurat as $row) : ?>
                                <option value="<?php echo $row->file_surat; ?>"><?php echo $row->no_surat; ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <!-- <input type="file" accept="application/pdf" id="file_surat" name="file_surat"> -->
                        <a type="submit" id='sign' class="btn btn-primary btn-block sign">
                            Sign File
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
        </form>
    </div>
</div>
</div>

<script>
    $('.sign').on("click", function(e) {
        e.preventDefault();
        var url = $(this).parents('#sign');
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