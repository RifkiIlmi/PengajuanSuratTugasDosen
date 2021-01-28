<?php

class Model_surat extends CI_model
{

    public function allSurat()
    {
        //ambil data dari tabel join 3 table
        $this->db->select('*');
        $this->db->from('surat_masuk');
        $this->db->join('detail_surat_tugas', 'detail_surat_tugas.id_surat=surat_masuk.id_surat');
        $this->db->join('dosen', 'dosen.nip=surat_masuk.nip');
        $this->db->order_by('tanggal_surat_masuk', 'DESC');
        // $this->db->where(array('dosen.nip' => $this->session->userdata('nip')));
        // $this->db->where(array('status_surat' => 'Selesai'));
        // $this->db->join('tim', 'tim.id_detail_surat=detail_surat_tugas.id_detail_surat');
        $query = $this->db->get();
        return $query->result();
    }

    public function statusSuratCount()
    {
        $query = $this->db
            ->select('status_surat, COUNT(status_surat) as total')
            ->group_by('status_surat')
            // ->order_by('num_of_time', 'desc')
            ->get('surat_masuk');
        return $query->result();
    }

    public function surat_saya()
    {
        //ambil data dari tabel join 3 table
        $this->db->select('*');
        $this->db->from('surat_masuk');
        $this->db->join('detail_surat_tugas', 'detail_surat_tugas.id_surat=surat_masuk.id_surat');
        $this->db->join('dosen', 'dosen.nip=surat_masuk.nip');
        $this->db->where(array('dosen.nip' => $this->session->userdata('nip')));
        $this->db->order_by('tanggal_surat_masuk', 'DESC');
        // $this->db->where(array('status_surat' => 'Pending'));
        // $this->db->join('tim', 'tim.id_detail_surat=detail_surat_tugas.id_detail_surat');
        $query = $this->db->get();
        return $query->result();
    }

    public function surat_selesai()
    {
        //ambil data dari tabel join 3 table
        $this->db->select('*');
        $this->db->from('surat_masuk');
        $this->db->join('detail_surat_tugas', 'detail_surat_tugas.id_surat=surat_masuk.id_surat');
        $this->db->join('dosen', 'dosen.nip=surat_masuk.nip');
        // $this->db->where(array('dosen.nip' => $this->session->userdata('nip')));
        $this->db->where(array('status_surat' => 'Selesai'));
        // $this->db->join('tim', 'tim.id_detail_surat=detail_surat_tugas.id_detail_surat');
        $query = $this->db->get();
        return $query->result();
    }

    public function surat_masuk()
    {
        //ambil data dari tabel join 3 table
        $this->db->select('*');
        $this->db->from('surat_masuk');
        $this->db->join('detail_surat_tugas', 'detail_surat_tugas.id_surat=surat_masuk.id_surat');
        $this->db->join('dosen', 'dosen.nip=surat_masuk.nip');
        $this->db->where(array('status_surat' => 'Pending'));
        $this->db->order_by('tanggal_surat_masuk', 'DESC');
        // $this->db->join('tim', 'tim.id_detail_surat=detail_surat_tugas.id_detail_surat');
        $query = $this->db->get();
        return $query->result();
    }
    //surat masuk tampil untuk pimpinan
    public function surat_masukP()
    {
        //ambil data dari tabel join 3 table
        $this->db->select('*');
        $this->db->from('surat_masuk');
        $this->db->join('detail_surat_tugas', 'detail_surat_tugas.id_surat=surat_masuk.id_surat');
        $this->db->join('dosen', 'dosen.nip=surat_masuk.nip');
        $this->db->where(array('status_surat' => 'Disposisi'));
        $this->db->order_by('tanggal_surat_masuk', 'DESC');
        // $this->db->join('tim', 'tim.id_detail_surat=detail_surat_tugas.id_detail_surat');
        $query = $this->db->get();
        return $query->result();
    }

    public function disposisi_surat($id)
    {
        $date = getdate();
        $nosurat = $this->input->post('nomor_surat');

        // var_dump($id);
        // die();

        $status = array(
            'status_surat'  => 'Disposisi',
        );

        $this->db->where('id_surat', $id);
        $this->db->update('surat_masuk', $status);

        $no_surat = array(
            'no_surat'      => 'Un.04/L.1/TL.01/' . $nosurat . '/' . $date['year']

        );

        $this->db->where('id_surat', $id);
        $this->db->update('detail_surat_tugas', $no_surat);
    }

    public function buat_surat($id)
    { 
        $status = array(
            'status_surat'           => 'Selesai'
        );
        $this->db->where('id_surat', $id);
        $this->db->update('surat_masuk', $status);
    }

    public function setujui_surat($id)
    {
        $status = array(
            'status_surat'           => 'Disetujui'
        );
        $this->db->where('id_surat', $id);
        $this->db->update('surat_masuk', $status);
    }

    public function statusSelesai($id)
    {
        $status = array(
            'status_surat'           => 'Selesai'
        );
        $this->db->where('id_surat', $id);
        $this->db->update('surat_masuk', $status);
    }

    // public function tolak_surat($id)
    // {
    //     $status = array(
    //         'status_surat'           => 'Ditolak'
    //     );
    //     $this->db->where('id_surat', $id);
    //     $this->db->update('surat_masuk', $status);
    // }

    public function ajukan_surat($id)
    {
        $status = array(
            'status_surat'           => 'Pending'
        );
        $this->db->where('id_surat', $id);
        $this->db->update('surat_masuk', $status);
    }

    // public function batal_surat($id)
    // {
    //     $status = array(
    //         'status_surat'           => 'Batal'
    //     );
    //     $this->db->where('id_surat', $id);
    //     $this->db->update('surat_masuk', $status);
    // }

    public function delete_surat($id)
    {
        $data['surat'] = $this->db->get_where('detail_surat_tugas', ['id_surat' => $id])->row_array();
        $old_ktp = $data['surat']['foto_ktp'];
        $old_proposal = $data['surat']['proposal'];
        unlink(FCPATH . 'assets/upload/ktp/' . $old_ktp);
        unlink(FCPATH . 'assets/upload/proposal/' . $old_proposal);
        // var_dump($old_proposal);
        // die;
        $this->db->where('id_surat', $id);
        $this->db->delete('surat_masuk');
    }



    public function insert_surat()
    {
        $tglnow = date('Y-m-d');
        $tglawal = $this->input->post('tgl_mulai', TRUE);
        $tglakhir = $this->input->post('tgl_akhir', TRUE);
        $diff = ((abs(strtotime($tglawal) - strtotime($tglakhir))) / (60 * 60 * 24));

        $data_surat_masuk = array(
            'tanggal_surat_masuk' => $tglnow,
            'status_surat'        => 'Pending',
            'nip'                 => $this->session->userdata('nip')
        );

        $this->db->insert('surat_masuk', $data_surat_masuk);
        // mengambil last insert id
        $lastidsm = $this->db->insert_id();

        // lakukan pengecekan untuk file upload ktp dan proposal
        $upload_ktp = $_FILES['foto_ktp']['name'];
        $upload_proposal = $_FILES['proposal']['name'];

        if ($upload_ktp) {
            $config['upload_path']          = './assets/upload/ktp/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024; // 1MB
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('foto_ktp')) {
                $foto_ktp = $this->upload->data('file_name');
            } else {
                echo $this->upload->display_errors();
            }
        }

        if ($upload_proposal) {
            $config['upload_path']          = './assets/upload/proposal/';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 2048; // 2MB
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('proposal')) {
                $proposal = $this->upload->data('file_name');
            } else {
                echo $this->upload->display_errors();
            }
        }

        $rekom = $this->input->post('rekom_dinas', TRUE);
        if ($rekom === "Iya") {
            if ($upload_ktp == NULL || $upload_proposal == NULL) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-with-icon"><i class="material-icons" data-notify="icon" >info_outline</i><button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button><span data-notify="message"> <b>Info Alert:</b> File upload kosong!</span></div>');
                redirect('ajukan_surat');
            } else {
                // insert ke tabel detail surat
                $data_detail_surat = array(
                    'tujuan_penelitian' => $this->input->post('tujuan_penelitian'),
                    'judul_penelitian' => $this->input->post('judul_penelitian'),
                    'lokasi_penelitian' => $this->input->post('lokasi_penelitian'),
                    'rekom_dinas'      => $rekom,
                    'foto_ktp'         => $foto_ktp,
                    'proposal'         => $proposal,
                    'tgl_mulai'        => date('Y-m-d', strtotime($this->input->post('tgl_mulai', TRUE))),
                    'tgl_akhir'        => date('Y-m-d', strtotime($this->input->post('tgl_akhir', TRUE))),
                    'lama_tugas'       => $diff,
                    'id_surat'         => $lastidsm
                );
            }
        } else {
            // insert ke tabel detail surat
            $data_detail_surat = array(
                'tujuan_penelitian' => $this->input->post('tujuan_penelitian'),
                'judul_penelitian' => $this->input->post('judul_penelitian'),
                'lokasi_penelitian' => $this->input->post('lokasi_penelitian'),
                // 'rekom_dinas'      => $rekom,
                // 'foto_ktp'         => $foto_ktp,
                // 'proposal'         => $proposal,
                'tgl_mulai'        => date('Y-m-d', strtotime($this->input->post('tgl_mulai', TRUE))),
                'tgl_akhir'        => date('Y-m-d', strtotime($this->input->post('tgl_akhir', TRUE))),
                'lama_tugas'       => $diff,
                'id_surat'         => $lastidsm
            );
        }

        $this->db->insert('detail_surat_tugas', $data_detail_surat);
        $lastiddsm = $this->db->insert_id();

        $niptim = $this->input->post('nipajukan');
        $statusdlmtim = $this->input->post('status_dlm_tim');
        $datatim = array();

        $index = 0;
        foreach ($niptim as $datanip) {
            array_push($datatim, array(
                'nip' => $datanip,
                'status_dlm_tim' => $statusdlmtim[$index],
                'id_detail_surat' => $lastiddsm
            ));
            $index++;
        }

        $this->db->insert_batch('tim', $datatim);
    }


    // ini digunakan nantinya untuk autoselect option
    function get_nip_dosen($title)
    {
        $this->db->like('nip', $title, 'both');
        $this->db->order_by('nip', 'ASC');
        $this->db->limit(10);
        return $this->db->get('dosen')->result();
    }
}
