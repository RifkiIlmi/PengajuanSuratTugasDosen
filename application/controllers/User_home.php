<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_surat', '', TRUE);
        $this->load->model('model_tim', '', TRUE);
        $this->load->model('model_dosen', '', TRUE);
        $this->load->helper(array('form', 'url'));

        if (!$this->session->userdata('nip')) {
            redirect('auth');
        }
        if ($this->session->userdata('id_user_type') != 2) {
            redirect('auth/blocked');
        }
    }

    public function index()
    {
        $data['judul'] = "SISTP - Home";
        $data['user'] = $this->db->get_where('dosen', ['nip' => $this->session->userdata('nip')])->row_array();
        $data['akun'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/main_footer');
    }
}
