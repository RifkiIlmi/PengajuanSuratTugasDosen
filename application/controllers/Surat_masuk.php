
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_masuk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_surat', '', TRUE);
        $this->load->model('model_detail_surat', '', TRUE);
        $this->load->model('model_tim', '', TRUE);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        if (!$this->session->userdata('nip')) {
            redirect('auth');
        }
        if ($this->session->userdata('id_user_type') == 2) {
            redirect('auth/blocked');
        }
    }

    public function index()
    {
        $data['surat_masuk'] = $this->model_surat->surat_masuk();
        // show surat masuk pimpinan
        $data['surat_masukP'] = $this->model_surat->surat_masukP();

        $data['judul'] = "SISTP - Permohonan Surat";
        $data['user'] = $this->db->get_where('dosen', ['nip' => $this->session->userdata('nip')])->row_array();
        $data['akun'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('surat/surat_masuk', $data);
        $this->load->view('templates/main_footer');
    }

    public function detail()
    {
        $id = $this->uri->segment(3);
        $data['detail'] = $this->model_detail_surat->detail_surat($id)->row_array();
        $data['detail_tim'] = $this->model_tim->tim_id($id)->result();
        $data['user'] = $this->db->get_where('dosen', ['nip' => $this->session->userdata('nip')])->row_array();
        $data['akun'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

        $judul = "Detail Surat Masuk";
        $data['judul'] = $judul;

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('surat/detail', $data);
        $this->load->view('templates/main_footer');
    }

    // fungsi mengubah status menjadi selesai/ telah terbuat
    public function buat_surat($id)
    {
        $id = $this->uri->segment(3);
        $this->model_surat->buat_surat($id);
        redirect('cetak_surat');
    }

    public function disposisi_surat()
    {
        $id = $this->input->post('id_surat');
        $this->model_surat->disposisi_surat($id);

        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $random = rand(0, 1000); //random angka dari 0 sampai 1000

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/img/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $random . '' . $id . '.jpg'; //buat name dari qr code sesuai dengan nim

        $params['data'] = base_url('validate?id=') . $random . '' . $id; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        $this->model_detail_surat->update_qrcode($id, $image_name);

        redirect('surat_masuk');
    }

    public function disetujui($id)
    {
        $id = $this->uri->segment(3);
        $this->model_surat->setujui_surat($id);
        redirect('surat_masuk');
    }

    // public function tolak_surat($id)
    // {
    //     $id = $this->uri->segment(3);
    //     $this->model_surat->tolak_surat($id);
    //     redirect('surat_masuk');
    // }
}
