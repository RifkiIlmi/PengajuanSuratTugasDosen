$(function() {

    $('.tombolTambahData').on('click',function () {

        $('#formModalLabel').html('Tambah Data Mahasiswa');
        $('.modal-footer button[type=submit]').html('Tambah data');
    })

    $('.tampilModalUbah').on('click', function() {

        $('#formModalLabel').html('Ubah Data Mahasiswa');
        $('.modal-footer button[type=submit]').html('Ubah data');
        $('.modal-body form').attr('action','http://localhost/TutorialLessons/PHPmvc2/public/Mahasiswa/ubah');

        const id = $(this).data('id');

        $.ajax({
            url: 'http://localhost/TutorialLessons/PHPmvc2/public/Mahasiswa/getubah',
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama').val(data.nama);
                $('#nim').val(data.nim);
                $('#kelas').val(data.kelas);
                $('#jurusan').val(data.jurusan);
                $('#umur').val(data.umur);
                $('#id').val(data.id);
            }
        });
            
       

    });

});