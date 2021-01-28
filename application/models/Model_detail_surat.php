<?php

class Model_detail_surat extends CI_model
{

    function detail_surat($id)
    {
        $this->db->select('*');
        $this->db->from('detail_surat_tugas');
        $this->db->join('surat_masuk', 'surat_masuk.id_surat=detail_surat_tugas.id_surat');
        $this->db->join('dosen', 'dosen.nip=surat_masuk.nip');
        $this->db->where(array('id_detail_surat' => $id));
        $query = $this->db->get();
        return $query;
    }

    function detail_suratMasuk($id)
    {
        $this->db->select('*');
        $this->db->from('detail_surat_tugas');
        $this->db->join('surat_masuk', 'surat_masuk.id_surat=detail_surat_tugas.id_surat');
        $this->db->join('dosen', 'dosen.nip=surat_masuk.nip');
        $this->db->where(array('detail_surat_tugas.id_surat' => $id));
        $query = $this->db->get();
        return $query;
    }

    public function update_surat()
    {
        $tujuan_penelitian = $this->input->post('tujuan_penelitian');
        $judul_penelitian = $this->input->post('judul_penelitian');
        // $foto_ktp         = 
        //     $proposal         = ,
        $tgl_mulai        = date('Y-m-d', strtotime($this->input->post('tgl_mulai', TRUE)));
        $tgl_akhir = date('Y-m-d', strtotime($this->input->post('tgl_akhir', TRUE)));
        $diff = ((abs(strtotime($tgl_mulai) - strtotime($tgl_akhir))) / (60 * 60 * 24));
        $id_detail_surat = $this->input->post('id_detail_surat');
        $rekom_dinas = $this->input->post('rekom_dinas');

        if ($rekom_dinas === "Iya") {
            $data['surat'] = $this->db->get_where('detail_surat_tugas', ['nip' => $this->session->userdata('nip')])->row_array();

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
                    //fungsi ini agar file lama terhapus dan diganti dengan yang baru ---- belum dites
                    $old_ktp = $data['surat']['foto_ktp'];
                    unlink(FCPATH . 'assets/upload/ktp/' . $old_ktp);

                    $foto_ktp = $this->upload->data('file_name');
                    $this->db->set('foto_ktp', $foto_ktp);
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $ktp = $this->input->post('ktp');
                $this->db->set('foto_ktp', $ktp);
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
                    //fungsi ini agar file lama terhapus dan diganti dengan yang baru ---- belum dites
                    $old_proposal = $data['surat']['proposal'];
                    unlink(FCPATH . 'assets/upload/proposal/' . $old_proposal);

                    $proposal = $this->upload->data('file_name');
                    $this->db->set('proposal', $proposal);
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $props = $this->input->post('props');
                $this->db->set('proposal', $props);
            }

            $this->db->set('tujuan_penelitian', $tujuan_penelitian);
            $this->db->set('judul_penelitian', $judul_penelitian);
            $this->db->set('tgl_mulai', $tgl_mulai);
            $this->db->set('tgl_akhir', $tgl_akhir);
            $this->db->set('lama_tugas', $diff);
            $this->db->set('rekom_dinas', $rekom_dinas);
        } else {
            $this->db->set('tujuan_penelitian', $tujuan_penelitian);
            $this->db->set('judul_penelitian', $judul_penelitian);
            $this->db->set('tgl_mulai', $tgl_mulai);
            $this->db->set('tgl_akhir', $tgl_akhir);
            $this->db->set('lama_tugas', $diff);
        }

        $this->db->where('id_detail_surat', $id_detail_surat);
        $this->db->update('detail_surat_tugas');
    }

    public function uploadFileRekom($id)
    {
        $uploadFile = $_FILES['file_rekom']['name'];

        if ($uploadFile) {
            $config['upload_path']          = './assets/fileRekomDinas/';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 2048; // 1MB
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file_rekom')) {
                //fungsi ini agar file lama terhapus dan diganti dengan yang baru ---- belum dites
                // $old_ktp = $data['surat']['file_rekom'];
                // unlink(FCPATH . 'assets/upload/ktp/' . $old_ktp);

                $file_rekom = $this->upload->data('file_name');
                $this->db->set('file_rekom', $file_rekom);
            } else {
                echo $this->upload->display_errors();
            }
        } else {
            $fileRekom = $this->input->post('file_rekom');
            $this->db->set('file_rekom', $fileRekom);
        }

        $this->db->where('id_detail_surat', $id);
        $this->db->update('detail_surat_tugas');
    }

    public function update_qrcode($id, $image_name)
    {
        $data['surat'] = $this->db->get_where('detail_surat_tugas', ['id_surat' => $id])->row_array();

        $old_qrcode = $data['surat']['qrcode_name'];
        unlink(FCPATH . 'assets/img/qrcode/' . $old_qrcode);
        $qrcode = array(
            'qrcode_name'           => $image_name
        );
        $this->db->where('id_surat', $id);
        $this->db->update('detail_surat_tugas', $qrcode);
    }

    public function getNoSuratByFile()
    {
        $this->db->select('*');
        $this->db->from('detail_surat_tugas');
        $this->db->join('surat_masuk', 'surat_masuk.id_surat=detail_surat_tugas.id_surat');
        // $this->db->join('dosen', 'dosen.nip=surat_masuk.nip');
        $this->db->where(array('status_surat' => 'Disetujui'));
        $this->db->where(array('file_surat !=' => ''));
        $query = $this->db->get();
        return $query;
    }

    public function getDownloadId($id)
    {
        $query = $this->db->get_where('detail_surat_tugas', array('id_detail_surat' => $id));
        return $query->row_array();
    }

    public function add_file_surat($id, $name)
    {
        $data['detail_surat'] = $this->db->get_where('detail_surat_tugas', ['id_detail_surat' => $id])->row_array();

        $old_fileSurat = $data['detail_surat']['file_surat'];
        if ($old_fileSurat != '') {
            unlink(FCPATH . 'assets/fileSurat/' . $old_fileSurat);
        }

        $data = array(
            'file_surat'           => $name
        );
        $this->db->where('id_detail_surat', $id);
        $this->db->update('detail_surat_tugas', $data);
    }

    public function laporan($tglmulai, $tglakhir)
    {
        $this->db->select('*');
        $this->db->from('surat_masuk');
        $this->db->join('detail_surat_tugas', 'detail_surat_tugas.id_surat=surat_masuk.id_surat');
        $this->db->join('dosen', 'dosen.nip=surat_masuk.nip');
        $this->db->where('tgl_mulai >= ', $tglmulai);
        $this->db->where('tgl_akhir <= ', $tglakhir);

        $query = $this->db->get();
        return $query->result();
    }

    public function getLaporan($tglmulai, $tglakhir)
    {
        $this->db->select('*');
        $this->db->from('surat_masuk');
        $this->db->join('detail_surat_tugas', 'detail_surat_tugas.id_surat=surat_masuk.id_surat');
        $this->db->join('dosen', 'dosen.nip=surat_masuk.nip');
        $this->db->where('tanggal_surat_masuk BETWEEN "' . $tglmulai . '" and "' . $tglakhir . '"');
        $this->db->where(array('status_surat' => 'Selesai'));
        return $this->db->get();
    }
}
