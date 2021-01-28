<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pimpinan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_surat', '', TRUE);
        $this->load->model('model_tim', '', TRUE);
        $this->load->helper(array('form', 'url'));

        if (!$this->session->userdata('nip')) {
            redirect('auth');
        }
        if (!$this->session->userdata('id_user_type') == 3) {
            redirect('auth/blocked');
        }
    }

    public function index()
    {

        $data['judul'] = "SISTP - Dashboard";
        $data['user'] = $this->db->get_where('dosen', ['nip' => $this->session->userdata('nip')])->row_array();
        $data['akun'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

        // mendapatkan data untuk status surat
        $data['pending'] = $this->db->query("SELECT * FROM surat_masuk WHERE status_surat = 'Pending' ")->num_rows();
        $data['disposisi'] = $this->db->query("SELECT * FROM surat_masuk WHERE status_surat = 'Disposisi' ")->num_rows();
        $data['disetujui'] = $this->db->query("SELECT * FROM surat_masuk WHERE status_surat = 'Disetujui' ")->num_rows();
        $data['selesai'] = $this->db->query("SELECT * FROM surat_masuk WHERE status_surat = 'Selesai' ")->num_rows();


        // mendapatkan data untuk pie chart
        $data['ftk'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE fakultas = 'Tarbiyah dan Keguruan' AND status_surat = 'Selesai' ")->num_rows();
        $data['ush'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE fakultas = 'Ushuluddin' AND status_surat = 'Selesai' ")->num_rows();
        $data['psi'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE fakultas = 'Psikologi' AND status_surat = 'Selesai' ")->num_rows();
        $data['fekonsos'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE fakultas = 'Ekonomi dan Ilmu Sosial' AND status_surat = 'Selesai' ")->num_rows();
        $data['sih'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE fakultas = 'Syariah dan Ilmu Hukum' AND status_surat = 'Selesai' ")->num_rows();
        $data['fdk'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE fakultas = 'Dakwah dan Ilmu Komunikasi' AND status_surat = 'Selesai' ")->num_rows();
        $data['fst'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE fakultas = 'Sains dan Teknologi' AND status_surat = 'Selesai' ")->num_rows();
        $data['perta'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE fakultas = 'Pertanian dan Peternakan' AND status_surat = 'Selesai' ")->num_rows();
        $data['pasca'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE fakultas = 'Pascasarjana' AND status_surat = 'Selesai' ")->num_rows();

        // mendapatkan data untuk jurusan di syariah
        $data['aas'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Ahwal Al-Syakhshiyyah' AND status_surat = 'Selesai' ")->num_rows();
        $data['ei'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Ekonomi Islam' AND status_surat = 'Selesai' ")->num_rows();
        $data['ih'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Ilmu Hukum' AND status_surat = 'Selesai' ")->num_rows();
        $data['js'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Jinayah Siyasah' AND status_surat = 'Selesai' ")->num_rows();
        $data['mmh'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Muammalah' AND status_surat = 'Selesai' ")->num_rows();
        $data['psd3'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'D.III Perbankan Syariah' AND status_surat = 'Selesai' ")->num_rows();

        // mendapatkan data untuk jurusan di fst
        $data['tif'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Teknik Informatika' AND status_surat = 'Selesai' ")->num_rows();
        $data['sif'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Sistem Informasi' AND status_surat = 'Selesai' ")->num_rows();
        $data['te'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Teknik Elektro' AND status_surat = 'Selesai' ")->num_rows();
        $data['ti'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Teknik Industri' AND status_surat = 'Selesai' ")->num_rows();
        $data['mt'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Matematika' AND status_surat = 'Selesai' ")->num_rows();

        // mendapatkan data untuk jurusan di dakwah
        $data['bki'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Bimbingan Konseling Islam' AND status_surat = 'Selesai' ")->num_rows();
        $data['ilkom'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Ilmu Komunikasi' AND status_surat = 'Selesai' ")->num_rows();
        $data['md'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Manajemen Dakwah' AND status_surat = 'Selesai' ")->num_rows();
        $data['pmi'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Pengembangan Masyarakat Islam' AND status_surat = 'Selesai' ")->num_rows();

        // mendapatkan data untuk jurusan di ekonomi
        $data['admn'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Administrasi Negara S1' AND status_surat = 'Selesai' ")->num_rows();
        $data['ak'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Akuntansi S1' AND status_surat = 'Selesai' ")->num_rows();
        $data['akd3'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'D.III Akuntansi' AND status_surat = 'Selesai' ")->num_rows();
        $data['apd3'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'D.III Administrasi Perpajakan' AND status_surat = 'Selesai' ")->num_rows();
        $data['mj'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Manajemen' AND status_surat = 'Selesai' ")->num_rows();
        $data['mpd3'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'D.III Manajemen Perusahaan' AND status_surat = 'Selesai' ")->num_rows();

        // mendapatkan data untuk jurusan di fapertapet
        $data['agk'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Agroteknologi' AND status_surat = 'Selesai' ")->num_rows();
        $data['ptk'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Peternakan' AND status_surat = 'Selesai' ")->num_rows();
        $data['gz'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Gizi' AND status_surat = 'Selesai' ")->num_rows();

        // mendapatkan data untuk jurusan di psikologi
        $data['s1psk'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Psikologi S1' AND status_surat = 'Selesai' ")->num_rows();
        $data['s2psk'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Psikologi S2' AND status_surat = 'Selesai' ")->num_rows();

        // mendapatkan data untuk jurusan di ftk
        $data['mpi'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Manajemen Pendidikan Islam' AND status_surat = 'Selesai' ")->num_rows();
        $data['pai'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Pendidikan Agama Islam' AND status_surat = 'Selesai' ")->num_rows();
        $data['pba'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Pendidikan Bahasa Arab' AND status_surat = 'Selesai' ")->num_rows();
        $data['pbhi'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Pendidikan Bahasa Indonesia' AND status_surat = 'Selesai' ")->num_rows();
        $data['pbi'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Pendidikan Bahasa Inggris' AND status_surat = 'Selesai' ")->num_rows();
        $data['pe'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Pendidikan Ekonomi' AND status_surat = 'Selesai' ")->num_rows();
        $data['pg'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Pendidikan Geografi' AND status_surat = 'Selesai' ")->num_rows();
        $data['pgmi'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Pendidikan Guru Madrasah Ibtidaiyah' AND status_surat = 'Selesai' ")->num_rows();
        $data['pk'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Pendidikan Kimia' AND status_surat = 'Selesai' ")->num_rows();
        $data['pmt'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Pendidikan Matematika' AND status_surat = 'Selesai' ")->num_rows();
        $data['tipa'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Tadris Ipa' AND status_surat = 'Selesai' ")->num_rows();

        // mendapatkan data untuk jurusan di ftk
        $data['af'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Aqidah dan Filsafat' AND status_surat = 'Selesai' ")->num_rows();
        $data['ihs'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Ilmu Hadits' AND status_surat = 'Selesai' ")->num_rows();
        $data['pag'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Perbandingan Agama' AND status_surat = 'Selesai' ")->num_rows();
        $data['th'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Tafsir Hadits' AND status_surat = 'Selesai' ")->num_rows();
        
        $data['pas'] = $this->db->query("SELECT * FROM dosen JOIN surat_masuk on dosen.nip=surat_masuk.nip JOIN detail_surat_tugas ON surat_masuk.id_surat=detail_surat_tugas.id_surat WHERE prodi = 'Pasca Sarjana' AND status_surat = 'Selesai' ")->num_rows();
        
        $data['label'] = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $data['year'] = date('Y');
        $year = $data['year'];
        // var_dump($year);
        // die();

        for ($bulan = 1; $bulan < 13; $bulan++) {
            $query = $this->db->query("SELECT * FROM `surat_masuk` WHERE status_surat= 'Selesai' AND MONTH(tanggal_surat_masuk)= '$bulan' AND YEAR(tanggal_surat_masuk)= '$year' ")->num_rows();
            $jumlah[] = $query;
        }
        $data['jumlah'] = $jumlah;

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/main_footer');
    }
}
