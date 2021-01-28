<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Download extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->model('model_surat', '', TRUE);
        $this->load->model('model_detail_surat', '', TRUE);
        // $this->load->model('model_tim', '', TRUE);
        $this->load->helper(array('form', 'url', 'download'));
    }

    // download KTP
    public function index($id)
    {
        $fileinfo = $this->model_detail_surat->getDownloadId($id);
        $file = 'assets/upload/ktp/' . $fileinfo['foto_ktp'];
        force_download($file, NULL);
    }

    // /download file surat tugas
    public function suratTugas($id)
    {
        $fileinfo = $this->model_detail_surat->getDownloadId($id);
        $file = 'assets/fileSurat/' . $fileinfo['file_surat'];
        force_download($file, NULL);
    }

    // /download file surat rekomendasi dinas
    public function suratRekom($id)
    {
        $fileinfo = $this->model_detail_surat->getDownloadId($id);
        $file = 'assets/fileRekomDinas/' . $fileinfo['file_rekom'];
        force_download($file, NULL);
    }
}
