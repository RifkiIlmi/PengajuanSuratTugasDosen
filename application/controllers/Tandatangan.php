<?php
defined('BASEPATH') or exit('No direct script access allowed');

use setasign\Fpdi\Tcpdf\Fpdi;
// use \setasign\Fpdi\Fpdi;
use \setasign\Fpdi\PdfParser\StreamReader;

class Tandatangan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_surat', '', TRUE);
        $this->load->model('model_detail_surat', '', TRUE);
        $this->load->model('model_tim', '', TRUE);
        $this->load->helper(array('form', 'url'));
        // $this->load->library('pdf');


        if (!$this->session->userdata('nip')) {
            redirect('auth');
        }
        if ($this->session->userdata('id_user_type') == 2) {
            redirect('auth/blocked');
        }
    }

    public function index()
    {

        $data['judul'] = "SISTP - Tanda Tangan Elektronik";
        $data['user'] = $this->db->get_where('dosen', ['nip' => $this->session->userdata('nip')])->row_array();
        $data['akun'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();
        $data['nosurat'] = $this->model_detail_surat->getNoSuratByFile()->result();

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('surat/tandatangan', $data);
        $this->load->view('templates/main_footer');
    }

    public function sign()
    {
        $data['user'] = $this->db->get_where('dosen', ['nip' => $this->session->userdata('nip')])->row_array();
        $nama = $data['user']['nama'];

        $file = $this->input->post('file_surat');
        $iddetailx = explode("-", $file);
        $iddetail = explode(".", $iddetailx[1]);
        // var_dump($iddetail[0]);
        // die();

        $data['detail'] = $this->model_detail_surat->detail_surat($iddetail[0])->row_array();
        $idsurat = $data['detail']['id_surat'];
        // var_dump($idsurat);
        // die();

        $filename = '[signed]' . $file;
        $location = FCPATH . "assets/fileSurat/";

        $certificate = "file://" . realpath('C:/xampp/htdocs/sistp/assets/digitalSignature/puslitpen.crt');
        $key = "file://" . realpath('C:/xampp/htdocs/sistp/assets/digitalSignature/private.key');
        $passphrase = "lppmuinsuska";

        class_exists('TCPDF', true);

        $tcpdf = new Fpdi();
        $tcpdf->setPrintHeader(false);
        $tcpdf->setPrintFooter(false);

        $fileContent = file_get_contents(base_url('assets/filesurat/') . $file);

        $row = $tcpdf->setSourceFile(StreamReader::createByString($fileContent));
        // $row = $tcpdf->setSourceFile(StreamReader::createByString($fileContent));
        for ($i = 1; $i <= $row; $i++) {
            $tcpdf->addPage();
            $tplIdx = $tcpdf->importPage($i);
            $tcpdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
        }

        $info = array(
            'Name' => $nama,
            'Location' => 'ID/Indonesia',
            'Reason' => 'Otentikasi Dokumen PDF',
            'ContactInfo' => 'puslitpen.LPPM@gmail.com',
        );

        $tcpdf->setSignature($certificate, $key, $passphrase, '', 2, $info);
        // $tcpdf->Image(base_url() . 'assets/img/signature.jpg', 117, 201, 60, 18, 'JPG');
        // $tcpdf->setSignatureAppearance(117, 201, 60, 18);
        $tcpdf->Output($location . $filename, 'F');
        $this->model_detail_surat->add_file_surat($iddetail[0], $filename);
        $this->model_surat->statusSelesai($idsurat);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menandatangani surat</div>');
        redirect('semua_surat');
    }
}
