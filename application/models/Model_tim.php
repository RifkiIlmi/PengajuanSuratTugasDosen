<?php

class Model_tim extends CI_model
{
    public function tim_list()
    {
        //ambil data dari tabel
        $this->db->select('*');
        $this->db->from('tim');
        $this->db->join('detail_surat_tugas', 'detail_surat_tugas.id_detail_surat=tim.id_detail_surat');
        $this->db->join('dosen', 'dosen.nip=tim.nip');
        $query = $this->db->get();
        return $query->result();
    }

    function tim_id($id)
    {
        $this->db->like('tim.id_detail_surat', $id, 'both');
        $this->db->order_by('id_tim', 'ASC');
        $this->db->join('detail_surat_tugas', 'detail_surat_tugas.id_detail_surat=tim.id_detail_surat');
        $this->db->join('dosen', 'dosen.nip=tim.nip');
        // $this->db->where(array('tim.id_detail_surat' => $id));
        $query = $this->db->get('tim');
        return $query;
    }

    public function insert_tim()
    {
        $iddsm = $this->input->post('id_detail_surat');
        $niptim = $this->input->post('nip');
        $statusdlmtim = $this->input->post('status_dlm_tim');

        $data = array(
            'nip' => $niptim,
            'status_dlm_tim' => $statusdlmtim,
            'id_detail_surat' => $iddsm,
        );

        $this->db->insert('tim', $data);
    }
 
    public function delete_tim($id)
    {
        $this->db->where('id_tim', $id);
        $this->db->delete('tim');
    }
}
