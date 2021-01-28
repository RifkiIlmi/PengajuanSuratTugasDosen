<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="<?= base_url() ?>/assets/css/cetak_css.css" rel="stylesheet" />

    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .tg td {
            font-family: Arial, sans-serif;
            font-size: 14px;
            padding: 10px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: black;
        }

        .tg th {
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            padding: 10px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: black;
        }

        .tg .tg-andl {
            font-weight: bold;
            font-size: 14px;
            font-family: "Times New Roman", Times, serif !important;
            ;
            border-color: #ffffff;
            text-align: center;
            vertical-align: top
        }

        .tg .tg-rg0r {
            font-weight: bold;
            font-size: 16px;
            font-family: "Times New Roman", Times, serif !important;
            ;
            border-color: #ffffff;
            text-align: center;
            vertical-align: top
        }

        .tg-rer {
            font-size: 9px;
            font-family: "Times New Roman", Times, serif !important;
            margin-top: 0;
            border-color: #ffffff;
            text-align: center;
            vertical-align: top
        }

        .tg .tg-rgr2 {
            font-size: 10px;
            font-family: "Times New Roman", Times, serif !important;
            ;
            border-color: #ffffff;
            text-align: left;
            vertical-align: top
        }

        .header {
            padding-top: 30px;
            text-align: center;
        }

        .content {
            font-family: "Times New Roman", Times, serif;
            padding-top: 20px;
            font-size: 14px;
            text-align: justify;
        }

        .title {
            font-family: "Times New Roman", Times, serif;
            font-size: 21px;
            color: #000000;
            font-weight: bold;
            text-decoration: underline solid rgb(68, 68, 68);
            font-style: normal;
            font-variant: normal;
            text-transform: uppercase;
        }

        .tembusan {
            font-family: "Times New Roman", Times, serif;
            margin-top: 20px;
            font-size: 14px;
            text-align: justify;
        }
    </style>
</head>

<body>
    <table class="tg">
        <tr>
            <th class="tg-rgr2" rowspan="5"><img width="100" src="<?= base_url('assets/img/logouin.jpg') ?>"></th>
            <th class="tg-andl" rowspan="5"></th>
            <th class="tg-rg0r" rowspan="5">KEMENTRIAN AGAMA<br>UNIVERSITAS ISLAM SULTAN SYARIF KASIM RIAU<br>
                LEMBAGA PENELITIAN DAN PENGABDIAN KEPADA MASYARAKAT<br>
                <img width="220" src="<?= base_url('assets/img/lppmArab.jpg') ?>"><br>
                <span style="color:rgb(50, 203, 0)">INSTITUTE FOR RESEARCH AND COMMUNITY SERVICE</span></th>
        </tr>
    </table>
    <p class="tg-rer">Alamat: Jl. H. R. Soebrantas No.155 KM 15 Simpang Baru Panam Pekanbaru PO. Box 1004 Web: lppm.uin-suska.ac.id Email: lppm@uin-suska.ac.id</p>
    <img src="<?= base_url('assets/img/border.jpg') ?>">
    <div class="header">
        <table>
            <tr>
                <td style="padding-right:35%;"> </td>
                <td style="vertical-align:top;padding-right:100px;text-align:center;"> <span class="title">
                        SURAT TUGAS
                    </span>
                    <br>
                    <span>
                        Nomor: <?= $detail['no_surat'] ?>
                    </span>
                </td>
                <td style="vertical-align:top;text-align:center;">
                    <span>
                        <img width="70" src="<?= base_url('assets/img/qrcode/' . $detail['qrcode_name']) ?>">
                        <p style="font-size:11px;">
                            <?php
                            $qrcodefile = $detail['qrcode_name'];
                            $qrcodename = explode('.', $qrcodefile);
                            echo $qrcodename[0];
                            ?>
                        </p>
                    </span>
                </td>
            </tr>
        </table>

    </div>

    <div class="content">
        <?php $date = getdate(); ?>
        <table>
            <tr>
                <td rowspan="2" style="vertical-align:top;padding-right:30px;">Menimbang</td>
                <td style="vertical-align:top;padding-right:10px;">a.</td>
                <td style="text-align: justify;"> Bahwa dalam rangka terlaksananya kegiatan penelitian pada Lembaga Penelitian dan Pengembangan pada Masyarakat <?= $date['year'] ?>.
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top;padding-right:10px;">b.</td>
                <td style="text-align: justify;">Bahwa berdasarkan pertimbangan pada poin a diatas, untuk percepatan pelaksanaan dan pertanggungjawaban penggunaan dana penelitian maka dipandang perlu memberikan surat tugas ini. </td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="vertical-align:top;padding-right:70px;">Dasar</td>
                <td style="vertical-align:top;padding-right:17px;">:</td>
                <td style="text-align: justify;"> Surat Keputusan Rektor No. 1177/R/2019 tanggal 11 Juli 2019 tentang penetapan peneliti <i>cluster interdisipliner</i> pada Lembaga Penelitian dan Pengabdian kepada Masyarakat UIN Suska Riau Tahun <?= $date['year'] ?>.
                </td>
            </tr>
        </table>
        <p style="text-align: center;">Memberikan Tugas</p>
        <table>
            <tr>
                <td style="vertical-align:top;padding-right:60px;">Kepada</td>
                <td style="vertical-align:top;padding-right:10px;">:</td>
            </tr>
            <?php $no = 1; ?>
            <?php foreach ($detail_tim as $item) : ?>
                <tr>
                    <td rowspan="4"></td>
                    <td style="vertical-align:top;" rowspan="4"><?= $no++; ?>.</td>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= $item->gelar_depan; ?> <?= $item->nama ?> <?= $item->gelar_belakang; ?></td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td><?= $item->nip; ?></td>
                </tr>
                <tr>
                    <td>Pangkat/Gol</td>
                    <td>:</td>
                    <td><?= $item->pangkat_gol; ?></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td><?= $item->status_dlm_tim; ?></td>
                </tr>
                <tr>
                    <td colspan="5"><br></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <table>
            <tr>
                <td style="vertical-align:top;padding-right:70px;">Untuk</td>
                <td style="vertical-align:top;padding-right:15px;">:</td>
                <td style="text-align: justify;">Melaksanakan penelitian dengan judul "<?= $detail['judul_penelitian'] ?>" dan tujuan "<?= $detail['tujuan_penelitian'] ?>", pada tanggal <?= formaldate_indo($detail['tgl_mulai']) ?> s.d <?= formaldate_indo($detail['tgl_akhir']) ?> di <?= $detail['lokasi_penelitian'] ?>.
                </td>
            </tr>
        </table>
        <p style="font-size:14px;">Biaya yang berkaitan dengan pelaksanaan tugas ini dibebankan pada anggaran BOPTN <i>cluster interdisipliner</i>.<br>Setelah selesai melaksanakan tugas segera menyampaikan laporan kepada pemberi tugas.<br>Demikian surat tugas ini dibuat untuk dilaksanakan dengan penuh tanggung jawab.</i></p>
        <table style="padding-left:420px;">
            <tr>
                <td>Dibuat di</td>
                <td>:</td>
                <td>Pekanbaru</td>
            </tr>
            <tr>
                <td>Pada Tanggal</td>
                <td>:</td>
                <td><?= date('d F Y'); ?></td>
            </tr>
            <br>
        </table>
        <div style="padding-left:420px;">
            <img width="280" src="<?= base_url('assets/img/signature.jpg') ?>">
        </div>
    </div>
    <div class="tembusan">
        <p>
            <span style="text-decoration: underline;">Tembusan:</span>
            <br>
            <span>Yth. Rektor UIN Suska Riau</span>
        </p>
    </div>
</body>

</html>