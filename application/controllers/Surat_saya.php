<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_saya extends CI_Controller
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
        // if ($this->session->userdata('id_user_type') == 1) {
        //     redirect('auth/blocked');
        // }
    }

    public function index()
    {
        $data['surat_saya'] = $this->model_surat->surat_saya();

        // $data['tim'] = $this->model_tim->tim_list();

        $data['judul'] = "SISTP - Surat Saya";
        $data['user'] = $this->db->get_where('dosen', ['nip' => $this->session->userdata('nip')])->row_array();
        $data['akun'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('surat/surat_saya', $data);
        $this->load->view('templates/main_footer');
    }

    public function detail()
    {
        $id = $this->uri->segment(3);
        $data['detail'] = $this->model_detail_surat->detail_surat($id)->row_array();
        $data['detail_tim'] = $this->model_tim->tim_id($id)->result();
        $data['user'] = $this->db->get_where('dosen', ['nip' => $this->session->userdata('nip')])->row_array();
        $data['akun'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

        $judul = "SISTP - Detail Surat Saya";
        $data['judul'] = $judul;

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('surat/detail', $data);
        $this->load->view('templates/main_footer');
    }

    public function save()
    {
        $this->model_surat->insert_surat();
        redirect('surat/index');
    } 

    public function add_tim($id)
    {
        $this->model_tim->insert_tim();
        redirect('surat_saya/detail/' . $id);
    }

    public function deletetim()
    {
        $iddsp = $this->uri->segment(4);
        $idtim = $this->uri->segment(3);
        $this->model_tim->delete_tim($idtim);
        $this->session->set_flashdata('message', '<div class="alert alert-warning alert-with-icon"><i class="material-icons" data-notify="icon" >info_outline</i><button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button><span data-notify="message"> <b>Info Alert:</b> Surat Telah Dihapus!!!</span></div>');
        redirect('surat_saya/detail/' . $iddsp);
    }

    public function update_isi($id)
    {
        $this->model_detail_surat->update_surat();
        redirect('surat_saya/detail/' . $id);
    }

    public function delete($idsurat)
    {
        $this->model_surat->delete_surat($idsurat);
        $this->session->set_flashdata('deletesurat', '<div class="alert alert-warning alert-with-icon"><i class="material-icons" data-notify="icon" >info_outline</i><button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button><span data-notify="message"> <b>Info Alert:</b> Surat Telah Dihapus!!!</span></div>');
        redirect('surat_saya');
    }
    // public function batal_surat($id)
    // {
    //     $id = $this->uri->segment(3);
    //     $this->model_surat->batal_surat($id);
    //     redirect('surat_saya');
    // }
}
