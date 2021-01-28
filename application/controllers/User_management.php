<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_management extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_surat', '', TRUE);
        $this->load->model('model_dosen', '', TRUE);
        $this->load->model('model_tim', '', TRUE);
        $this->load->model('model_user', '', TRUE);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        if (!$this->session->userdata('nip')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['judul'] = "SISTP - User Management";
        $data['user'] = $this->db->get_where('dosen', ['nip' => $this->session->userdata('nip')])->row_array();
        $data['akun'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();
        $data['dosen'] = $this->model_dosen->listDosen();

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/usr_mng', $data);
        $this->load->view('templates/main_footer');
    }

    // public function detail()
    // {
    //     $id = $this->uri->segment(3);
    //     $data['user'] = $this->db->get_where('dosen', ['nip' => $this->session->userdata('nip')])->row_array();
    //     $data['akun'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

    //     $judul = "Detail User";
    //     $data['judul'] = $judul;

    //     $this->load->view('templates/main_header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('surat/detail', $data);
    //     $this->load->view('templates/main_footer');
    // }

    public function tambah()
    {

        $this->form_validation->set_rules('nip', 'NIP/NIK', 'trim|required|numeric');
        $this->form_validation->set_rules('nama', 'NAMA', 'trim|required');
        $this->form_validation->set_rules('fakultas', 'Fakultas', 'trim|required');
        $this->form_validation->set_rules('prodi', 'Program Studi', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {

            $nip = $this->uri->segment(3);
            // $data['detail'] = $this->model_dosen->getDosenById($nip)->row_array();
            $data['user'] = $this->db->get_where('dosen', ['nip' => $this->session->userdata('nip')])->row_array();
            $data['akun'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

            $judul = "Tambah User";
            $data['judul'] = $judul;

            $this->load->view('templates/main_header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/tambah_dosen', $data);
            $this->load->view('templates/main_footer');
        } else {
            $this->_tambah();
        }
    }

    public function changeaccess()
    {
        $id_user_type = $this->input->post('userType');
        $id_user = $this->input->post('idUser');

        // var_dump($id_user_type);
        // var_dump($id_user);
        // die();

        $this->model_user->changeaccess($id_user_type, $id_user);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Ubah hak Akses</div>');
    }

    private function _tambah()
    {
        // $this->session->set_flashdata('time', '<div class="alert alert-danger" role="alert">Rentang waktu yang anda masukkan salah!</div>');
        $this->model_dosen->tambah_dosen();
        $this->model_user->tambah_user();

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-with-icon"><i class="material-icons" data-notify="icon" >info_outline</i><button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button><span data-notify="message"> <b>Info Alert:</b> Berhasil Tambah data dosen</span></div>');
        redirect('user_management');
    }

    public function update()
    {

        $this->form_validation->set_rules('nip', 'NIP/NIK', 'trim|required|numeric');

        if ($this->form_validation->run() == false) {

            $nip = $this->uri->segment(3);
            $data['detail'] = $this->model_dosen->getDosenById($nip)->row_array();
            $data['user'] = $this->db->get_where('dosen', ['nip' => $this->session->userdata('nip')])->row_array();
            $data['akun'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

            $judul = "SISTP - Update Dosen";
            $data['judul'] = $judul;

            $this->load->view('templates/main_header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/update_dosen', $data);
            $this->load->view('templates/main_footer');
        } else {
            $this->_update();
        }
    }

    private function _update()
    {
        // $this->session->set_flashdata('time', '<div class="alert alert-danger" role="alert">Rentang waktu yang anda masukkan salah!</div>');
        $id = $this->uri->segment(3);
        $this->model_dosen->update_dosenBySatff($id);
        $this->model_user->update_nipUser($id);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-with-icon"><i class="material-icons" data-notify="icon" >info_outline</i><button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button><span data-notify="message"> <b>Info Alert:</b> Berhasil update data dosen</span></div>');
        redirect('user_management');
    }

    public function delete()
    {
        $id = $this->uri->segment(3);
        $this->model_dosen->delete_dosen($id);
        $this->model_user->delete_user($id);

        $this->session->set_flashdata('message', '<div class="alert alert-info alert-with-icon"><i class="material-icons" data-notify="icon" >info_outline</i><button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button><span data-notify="message"> <b>Info Alert:</b> Berhasil hapus data dosen</span></div>');
        redirect('user_management');
    }
}
