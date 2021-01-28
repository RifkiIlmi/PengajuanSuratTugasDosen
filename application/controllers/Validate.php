<?php
defined('BASEPATH') or exit('No direct script access allowed');

use setasign\Fpdi\Tcpdf\Fpdi;
// use \setasign\Fpdi\Fpdi;
use \setasign\Fpdi\PdfParser\StreamReader;

class Validate extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_surat', '', TRUE);
        $this->load->model('model_detail_surat', '', TRUE);
        $this->load->model('model_tim', '', TRUE);
        $this->load->helper(array('form', 'url'));
        $this->load->library('pdf');

        if (!$this->session->userdata('nip')) {
            redirect('auth');
        }
        // if (!$this->session->userdata('id_user_type') == 3) {
        //     redirect('auth/blocked');
        // }
    }

    public function index()
    {
        $id = $this->input->get('id');
        $data['surat'] = $this->db->get_where('detail_surat_tugas', ['qrcode_name' => $id . '.jpg'])->row_array();
        $filename = $data['surat']['file_surat'];
        // echo $file;
        class_exists('TCPDF', true);

        $tcpdf = new Fpdi();
        $tcpdf->setPrintHeader(false);
        $tcpdf->setPrintFooter(false);

        $fileContent = file_get_contents(base_url('assets/filesurat/') . $filename);
        $row = $tcpdf->setSourceFile(StreamReader::createByString($fileContent));
        // $row = $tcpdf->setSourceFile(StreamReader::createByString($fileContent));
        for ($i = 1; $i <= $row; $i++) {
            $tcpdf->addPage();
            $tplIdx = $tcpdf->importPage($i);
            $tcpdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
        }

        $tcpdf->Output($filename, 'I');
    }
}
