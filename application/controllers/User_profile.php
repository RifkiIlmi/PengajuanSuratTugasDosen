<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_surat', '', TRUE);
        $this->load->model('model_dosen', '', TRUE);
        $this->load->model('model_tim', '', TRUE);
        $this->load->model('model_user', '', TRUE);
        $this->load->helper(array('form', 'url'));

        if (!$this->session->userdata('nip')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['judul'] = "SISTP - My Profile";
        $data['user'] = $this->db->get_where('dosen', ['nip' => $this->session->userdata('nip')])->row_array();
        $data['akun'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/profile', $data);
        $this->load->view('templates/main_footer');
    }

    public function update()
    {
        $this->model_dosen->update_dosen();
        $this->model_user->update_email();
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-with-icon"><i class="material-icons" data-notify="icon" >info_outline</i><button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button><span data-notify="message"> <b>Info Alert:</b> Berhasil Update Data</span></div>');
        redirect('user_profile');
    }
    public function update_akun()
    {
        $this->model_user->update_akun();
        redirect('user_profile');
    }
}
