<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->model('model_surat', '', TRUE);
        // $this->load->model('model_tim', '', TRUE);
        $this->load->model('model_user', '', TRUE);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
    }

    public function index()
    {
        $this->form_validation->set_rules('nip', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'SISTP - Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // jika validasinya sukse
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('nip');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', [
            'nip' => $username,
            // 'password' => $password
        ])->row_array();
        // var_dump($user);

        // jika user ada
        if ($user) {
            // jika user aktif
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password']) || $password == $user['password']) {

                    $data = [
                        'nip' => $user['nip'],
                        'id_user_type' => $user['id_user_type'],
                    ];
                    $this->session->set_userdata($data);
                    if ($user['id_user_type'] == 1) {
                        redirect('admin');
                    } elseif ($user['id_user_type'] == 3) {
                        redirect('pimpinan');
                    } else {
                        redirect('user_home');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account has been block by Admin</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username is not registered</div>');
            redirect('auth');
        }
    }

    private function _sendmail($type)
    {
        $config = [
            'protocol'      => 'smtp',
            'smtp_host'     => 'ssl://smtp.googlemail.com',
            'smtp_user'     => 'puslitpen.LPPM@gmail.com',
            'smtp_pass'     => 'puslitpen123',
            'smtp_port'     => 465,
            'mailtype'      => 'html',
            'charset'       => 'utf-8',
            'newline'       => "\r\n"
        ];

        $this->email->initialize($config);

        $this->email->from('puslitpen.LPPM@gmail.com', 'LPPM Admin');
        $this->email->to($this->input->post('email'));

        if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetPassword?email=' . $this->input->post('email') . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'SISTP - Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgotPass');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email])->row_array();

            if ($user) {
                $this->session->set_userdata('reset_email', $email);
                $this->_sendmail('forgot');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
                redirect('auth/forgotPassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
                redirect('auth/forgotPassword');
            }
        }
    }

    public function resetPassword()
    {
        // $email = $this->input->get('email');
        $email = $this->session->userdata('reset_email');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            // $this->session->set_userdata('reset_email', $email);
            $this->changePassword();
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Reset password failed! Wrong email</div>');
            redirect('auth');
        } 
    }

    public function changePassword()
    {
        if (!$this->session->userdata['reset_email']) {
            redirect('auth/blocked');
        }

        $data['judul'] = 'SISTP - Change Password';

        $this->form_validation->set_rules('new_password1', 'New Password', 'trim|required|min_Length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'trim|required|min_Length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgotPass');
            $this->load->view('templates/auth_footer');
        } else {
            $new_password = $this->input->post('new_password1');
            $email = $this->session->userdata('reset_email');
            // password ok/
            $this->model_user->changeForgotPass($new_password, $email);
            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('nip');
        $this->session->unset_userdata('id_user_type');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logout</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('errors/blocked');
    }
}
