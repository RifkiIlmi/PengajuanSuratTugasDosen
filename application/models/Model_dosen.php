<?php

class Model_dosen extends CI_model
{
    public function listDosen()
    {
        $this->db->select('*');
        $this->db->from('dosen');
        $this->db->join('user', 'user.nip=dosen.nip');
        $this->db->join('user_type', 'user_type.id_user_type=user.id_user_type');
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDosenById($nip)
    {
        $this->db->select('*');
        $this->db->from('dosen');
        $this->db->join('user', 'user.nip=dosen.nip');
        $this->db->join('user_type', 'user_type.id_user_type=user.id_user_type');
        $this->db->where(array('dosen.nip' => $nip));
        $query = $this->db->get();
        return $query;
    }

    public function tambah_dosen()
    {
        $data = array(
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'nama' => $this->input->post('nama'),
            'nip' => $this->input->post('nip'),
            'tanggal_lahir' => date('Y-m-d', strtotime($this->input->post('tanggal_lahir', TRUE))),
            'gelar_depan' => $this->input->post('gelar_depan'),
            'gelar_belakang' => $this->input->post('gelar_belakang'),
            'pangkat_gol' => $this->input->post('pangkat_gol'),
            'jabatan' => $this->input->post('jabatan'),
            'spesialisasi' => $this->input->post('spesialisasi'),
            'prodi' => $this->input->post('prodi'),
            'fakultas' => $this->input->post('fakultas'),
            'pendidikan' => $this->input->post('pendidikan'),
            'alamat' => $this->input->post('alamat'),
        );
        // var_dump($data);
        // die();

        $this->db->insert('dosen', $data);
    }

    public function update_dosen()
    {

        $nip = $this->input->post('nip');
        $nama = $this->input->post('nama');
        $tmpt_lahir = $this->input->post('tempat_lahir');
        $tgl_lahir = date('Y-m-d', strtotime($this->input->post('tanggal_lahir', TRUE)));
        $gelar_depan = $this->input->post('gelar_depan');
        $gelar_belakang = $this->input->post('gelar_belakang');
        $pangkat_gol = $this->input->post('pangkat_gol');
        $jabatan = $this->input->post('jabatan');
        $spesialisasi = $this->input->post('spesialisasi');
        // $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $prodi = $this->input->post('prodi');
        $fakultas = $this->input->post('fakultas');
        $pendidikan = $this->input->post('pendidikan');

        // echo $tmpt_lahir;
        // die();

        $this->db->set('tempat_lahir', $tmpt_lahir);
        $this->db->set('nama', $nama);
        $this->db->set('nip', $nip);
        $this->db->set('tanggal_lahir', $tgl_lahir);
        $this->db->set('gelar_depan', $gelar_depan);
        $this->db->set('gelar_belakang', $gelar_belakang);
        $this->db->set('pangkat_gol', $pangkat_gol);
        $this->db->set('jabatan', $jabatan);
        $this->db->set('spesialisasi', $spesialisasi);
        $this->db->set('prodi', $prodi);
        $this->db->set('fakultas', $fakultas);
        $this->db->set('pendidikan', $pendidikan);
        // $this->db->set('email', $email);
        $this->db->set('alamat', $alamat);

        $this->db->where('nip', $nip);
        $this->db->update('dosen');
    }

    public function update_dosenBySatff($id)
    {

        $nip = $this->input->post('nip');
        $nama = $this->input->post('nama');
        $tmpt_lahir = $this->input->post('tempat_lahir');
        $tgl_lahir = date('Y-m-d', strtotime($this->input->post('tanggal_lahir', TRUE)));
        $gelar_depan = $this->input->post('gelar_depan');
        $gelar_belakang = $this->input->post('gelar_belakang');
        $pangkat_gol = $this->input->post('pangkat_gol');
        $jabatan = $this->input->post('jabatan');
        $spesialisasi = $this->input->post('spesialisasi');
        // $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $prodi = $this->input->post('prodi');
        $fakultas = $this->input->post('fakultas');
        $pendidikan = $this->input->post('pendidikan');

        // echo $tmpt_lahir;
        // die();

        $this->db->set('tempat_lahir', $tmpt_lahir);
        $this->db->set('nama', $nama);
        $this->db->set('nip', $nip);
        $this->db->set('tanggal_lahir', $tgl_lahir);
        $this->db->set('gelar_depan', $gelar_depan);
        $this->db->set('gelar_belakang', $gelar_belakang);
        $this->db->set('pangkat_gol', $pangkat_gol);
        $this->db->set('jabatan', $jabatan);
        $this->db->set('spesialisasi', $spesialisasi);
        $this->db->set('prodi', $prodi);
        $this->db->set('fakultas', $fakultas);
        $this->db->set('pendidikan', $pendidikan);
        // $this->db->set('email', $email);
        $this->db->set('alamat', $alamat);

        $this->db->where('nip', $id);
        $this->db->update('dosen');
    }

    public function delete_dosen($id)
    {
        $this->db->where('nip', $id);
        $this->db->delete('dosen');
    }
}
