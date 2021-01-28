<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajukan_surat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_surat', '', TRUE);
        // $this->load->model('model_detail_surat', '', TRUE);
        $this->load->model('model_tim', '', TRUE);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        if (!$this->session->userdata('nip')) {
            redirect('auth');
        }
        // if ($this->session->userdata('id_user_type') == 1) {
        //     redirect('auth/blocked');
        // }
    }

    public function index() 
    {
        // $tgl_mulai = $this->input->post('tgl_mulai');
        // $tgl_akhir = $this->input->post('tgl_akhir');
 
        // $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'less_than[' . $tgl_akhir . ']');
        // $this->form_validation->set_rules('tgl_akhir', 'Tanggal Berakhir', 'greater_than[' . $tgl_mulai . ']');
        $this->form_validation->set_rules('tujuan_penelitian', 'Tujuan', 'trim|required');
        $this->form_validation->set_rules('judul_penelitian', 'Judul Penelitian', 'trim|required');
        $this->form_validation->set_rules('lokasi_penelitian', 'Lokasi Penelitian', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['judul'] = "SISTP - Ajukan Surat";
            $data['user'] = $this->db->get_where('dosen', ['nip' => $this->session->userdata('nip')])->row_array();
            $data['akun'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

            $this->load->view('templates/main_header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('surat/ajukan_surat', $data);
            $this->load->view('templates/main_footer');
        } else {
            $niptim = $this->input->post('nipajukan');
            // cek pengajuan surat

            foreach ($niptim as $data) {
                $nipajukan = $this->db->get_where('dosen', ['nip' => $data])->row_array();
                if (!$nipajukan || $nipajukan === $data) {
                    $this->session->set_flashdata('nipajukan', '<div class="alert alert-warning alert-with-icon"><i class="material-icons" data-notify="icon" >info_outline</i><button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button><span data-notify="message"> <b>Info Alert:</b> NIP/NIK yang anda masukkan salah atau sama!</span></div>');
                    redirect('ajukan_surat');
                }
            }
            // jika validasinya sukses
            $this->_save();
        }
    }

    private function _save()
    {
        $tgl_mulai = $this->input->post('tgl_mulai');
        $tgl_akhir = $this->input->post('tgl_akhir');

        // cek rentang tangal yang diinputkan
        if ($tgl_mulai >= $tgl_akhir || $tgl_akhir <= $tgl_mulai) {
            $this->session->set_flashdata('time', '<div class="alert alert-warning alert-with-icon"><i class="material-icons" data-notify="icon" >info_outline</i><button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button><span data-notify="message"> <b>Info Alert:</b> Rentang waktu yang anda masukkan salah!</span></div>');
            redirect('ajukan_surat');
        } else {
            $this->model_surat->insert_surat();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-with-icon"><i class="material-icons" data-notify="icon" >info_outline</i><button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button><span data-notify="message"> <b>Info Alert:</b> Berhasil Mengajukan Surat</span></div>');
            redirect('surat_saya');
        }
    }


    // fungsi untuk autoselecet
    public function get_nip_dosen()
    {
        if (isset($_GET['term'])) {
            $result = $this->model_surat->get_nip_dosen($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $result_array[] = array(
                        'label' => $row->nip
                    );
                $json = json_encode($result_array);
                echo $json;
            }
        }
    }
}
