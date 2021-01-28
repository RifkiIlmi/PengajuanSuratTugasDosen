<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak_surat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_surat', '', TRUE);
        $this->load->model('model_detail_surat', '', TRUE);
        $this->load->model('model_tim', '', TRUE);
        $this->load->model('model_dosen', '', TRUE);
        $this->load->model('model_user', '', TRUE);
        $this->load->helper(array('form', 'url'));
        // $this->load->library('pdf');
        // $this->load->library('tcpdf/tcpdf_import');

        if (!$this->session->userdata('nip')) {
            redirect('auth');
        }
        if ($this->session->userdata('id_user_type') == 2) {
            redirect('auth/blocked');
        }
    }

    public function index()
    {
        $data['cetak'] = $this->model_surat->surat_selesai();
        $data['judul'] = "SISTP - Cetak Surat";
        $data['user'] = $this->db->get_where('dosen', ['nip' => $this->session->userdata('nip')])->row_array();
        $data['akun'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('surat/cetak_surat', $data);
        $this->load->view('templates/main_footer');
    }

    public function cetak()
    {
        $id = $this->uri->segment(3);
        $data['detail'] = $this->model_detail_surat->detail_suratMasuk($id)->row_array();
        $iddetailtim = $data['detail']['id_detail_surat'];
        $data['detail_tim'] = $this->model_tim->tim_id($iddetailtim)->result();
        $data['judul'] = "Cetak Surat " . $id;
        $id_detail = $data['detail']['id_detail_surat'];

        // var_dump($iddetailtim);
        // die();

        $filename = 'suratID-' . $id_detail . '.pdf';
        // var_dump($filename);
        // die();

        $mpdf = new \Mpdf\Mpdf([
            'format' => 'Folio',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 5,
            'margin_bottom' => 5,
            'margin_header' => 5,
            'margin_footer' => 10,
            'orientation' => 'P'
        ]);

        $location = FCPATH . "assets/fileSurat/";

        $html = $this->load->view('surat/cetak_view', $data, TRUE);
        $mpdf->WriteHTML($html);
        echo "<script>window.close();</script>";
        $mpdf->Output($location . $filename, \Mpdf\Output\Destination::FILE);

        $this->model_detail_surat->add_file_surat($id_detail, $filename);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil membuat surat, silahkan tandatangan dibawah</div>');
        redirect('tandatangan');
    }
}
