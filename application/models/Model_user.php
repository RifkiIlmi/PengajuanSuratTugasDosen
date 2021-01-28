<?php

use phpDocumentor\Reflection\Types\This;

class Model_user extends CI_model
{

    public function changePass($newPass)
    {
        $encrypted = password_hash($newPass, PASSWORD_DEFAULT);

        $this->db->set('password', $encrypted);
        $this->db->where('nip', $this->session->userdata['nip']);
        $this->db->update('user');
    }
 
    public function changeForgotPass($newPass, $email)
    {
        $encrypted = password_hash($newPass, PASSWORD_DEFAULT);

        $this->db->set('password', $encrypted);
        $this->db->where('email', $email);
        $this->db->update('user');
    }

    public function encrypt($pass)
    {
        $encrypted = password_hash($pass, PASSWORD_DEFAULT);

        $this->db->set('password', $encrypted);
        $this->db->where('nip', $this->session->userdata['nip']);
        $this->db->update('user');
    }

    public function update_email()
    {
        $nip = $this->input->post('nip');
        $email = $this->input->post('email');

        $this->db->set('email', $email);

        $this->db->where('nip', $nip);
        $this->db->update('user');
    }

    public function tambah_user()
    {
        $data = array(
            'nip' => $this->input->post('nip'),
            'email' => $this->input->post('email'),
            'id_user_type' => $this->input->post('id_user_type'),
        );

        $this->db->insert('user', $data);
    }

    public function changeaccess($id_user_type, $id_user)
    {

        $user_type = $id_user_type;

        $this->db->set('id_user_type', $user_type);

        $this->db->where('id_user', $id_user);
        $this->db->update('user');
    }

    public function update_nipUser($id)
    {
        $nip = $this->input->post('nip');
        // $email = $this->input->post('email');

        $this->db->set('nip', $nip);

        $this->db->where('nip', $id);
        $this->db->update('user');
    }

    public function update_akun()
    {
        $data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();

        $foto = $_FILES['foto']['name'];
        $nip = $this->input->post('nip');
        // $email = $this->input->post('email');

        if ($foto) {
            $config['upload_path']          = './assets/img/profile/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024; // 1MB
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('foto')) {
                //fungsi ini agar file lama terhapus dan diganti dengan yang baru ---- belum dites
                $old_foto = $data['user']['foto'];
                if ($old_foto != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile/' . $old_foto);
                } 

                $foto_new = $this->upload->data('file_name');
                $this->db->set('foto', $foto_new);
            } else {
                echo $this->upload->display_errors();
            }
        } else {
            $fototetap = $this->input->post('foto');
            $this->db->set('foto', $fototetap);
        }

        // $this->db->set('email', $email);

        $this->db->where('nip', $nip);
        $this->db->update('user');
    }

    public function delete_user($id)
    {
        $this->db->where('nip', $id);
        $this->db->delete('user');
    }
}
