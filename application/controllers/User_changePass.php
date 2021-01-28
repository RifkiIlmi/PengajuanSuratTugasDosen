<?php

use phpDocumentor\Reflection\Types\This;

defined('BASEPATH') or exit('No direct script access allowed');

class User_changePass extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_surat', '', TRUE);
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
        $data['judul'] = "SISTP - Change Password";
        $data['user'] = $this->db->get_where('dosen', ['nip' => $this->session->userdata('nip')])->row_array();
        $data['akun'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

        // if (password_verify('12345', $data['akun']['password'])) {
        //     echo 'ya';
        // } else {
        //     echo 'das';
        // }
        // die();

        $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('new_password1', 'New Password', 'trim|required|min_Length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'trim|required|min_Length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/main_header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/change_pass', $data);
            $this->load->view('templates/main_footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($current_password, $data['akun']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Current password Salah!</div>');
                redirect('user_changePass');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Current password tidak boleh sama dengan new password!</div>');
                    redirect('user_changePass');
                } else {
                    // password ok/
                    $this->model_user->changePass($new_password);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('user_changePass');
                }
            }
        }
    }

    public function encrypt()
    {
        $data['akun'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

        $pass = $data['akun']['password'];

        $this->model_user->encrypt($pass);

        redirect('user_changePass');
    }
}
