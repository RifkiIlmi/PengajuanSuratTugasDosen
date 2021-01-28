<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Load plugin PHPExcel nya

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Cetak_laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_surat', '', TRUE);
        $this->load->model('model_detail_surat', '', TRUE);
        $this->load->model('model_tim', '', TRUE);
        // $this->load->model('model_laporan', '', TRUE);
        $this->load->helper(array('form', 'url'));

        if (!$this->session->userdata('nip')) {
            redirect('auth');
        }
        if ($this->session->userdata('id_user_type') == 2) {
            redirect('auth/blocked');
        }
    }

    public function index()
    {
        $data['surat'] = $this->model_surat->allSurat();

        $data['judul'] = "SISTP - Cetak Laporan";
        $data['user'] = $this->db->get_where('dosen', ['nip' => $this->session->userdata('nip')])->row_array();
        $data['akun'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('surat/laporan', $data);
        $this->load->view('templates/main_footer');
    }

    public function export()
    {
        // Load plugin PHPExcel nya
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        // Panggil class PHPExcel nya
        $excel = new PHPExcel();

        // Settingan mulai fil excel
        $excel->getProperties()->setCreator('Rifki Ilmi')
            ->setLastModifiedBy('Administrator')
            ->setTitle("Laporan")
            ->setSubject("Laporan Surat Tugas")
            ->setDescription("Laporan Surat Tugas Penelitian Dosen")
            ->setKeywords("Surat Tugas");

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Surat Tugas Penelitian Dosen"); // Set kolom A1 dengan tulisan "Laporan Surat Tugas Penelitian Dosen"
        $excel->getActiveSheet()->mergeCells('A1:K1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "Nomor Surat");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "Tanggal Mulai");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "Tanggal Berakhir");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "Judul Penelitian");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "Tujuan Penelitian");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "Lokasi Penelitian");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "Rekomendasi Dinas DPMPTSP");
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "Ketua Tim");
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "Nip");
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "Pangkat/Gol");

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);

        $tglmulai = date('Y-m-d', strtotime($this->input->post('tgl_mulai')));
        $tglakhir =  date('Y-m-d', strtotime($this->input->post('tgl_akhir')));
        $laporan = $this->model_detail_surat->getLaporan($tglmulai, $tglakhir)->result();

        $no = 1; // Untuk penomoran tabel, di mulai set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($laporan as $data) { // Lakukan looping
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->no_surat);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->tgl_mulai);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->tgl_akhir);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->judul_penelitian);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->tujuan_penelitian);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->lokasi_penelitian);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data->rekom_dinas);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data->nama);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data->nip);
            $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $data->pangkat_gol);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(15); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(15); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Laporan Surat Tugas");
        $excel->setActiveSheetIndex(0);

        $name = 'Laporan' . $tglmulai . " s/d " . $tglakhir;
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $name . '.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
}
