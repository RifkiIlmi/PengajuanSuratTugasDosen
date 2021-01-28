<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Semua_surat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_surat', '', TRUE);
        $this->load->model('model_detail_surat', '', TRUE);
        $this->load->model('model_tim', '', TRUE);
        $this->load->helper(array('form', 'url'));

        if (!$this->session->userdata('nip')) {
            redirect('auth');
        }
        // if ($this->session->userdata('id_user_type') == 2) {
        //     redirect('auth/blocked');
        // }
    }

    public function index()
    {
        $data['surat'] = $this->model_surat->allSurat();

        $data['judul'] = "SISTP - Semua Surat";
        $data['user'] = $this->db->get_where('dosen', ['nip' => $this->session->userdata('nip')])->row_array();
        $data['akun'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('surat/semua_surat', $data);
        $this->load->view('templates/main_footer');
    }

    public function detail()
    {
        $id = $this->uri->segment(3);
        $data['detail'] = $this->model_detail_surat->detail_surat($id)->row_array();
        $data['detail_tim'] = $this->model_tim->tim_id($id)->result();
        $data['user'] = $this->db->get_where('dosen', ['nip' => $this->session->userdata('nip')])->row_array();
        $data['akun'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

        $judul = "Detail Surat";
        $data['judul'] = $judul;

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('surat/detail', $data);
        $this->load->view('templates/main_footer');
    }

    public function uploadRekom($id)
    {
        $this->model_detail_surat->uploadFileRekom($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses Upload Surat Rekomendasi dari Dinas PMPTSP</div>');
        redirect('semua_surat');
    }
}
