<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('form_validation');
    }
    //indek halaman login
    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run()  == false) {
            $this->load->view('login/login');
        } else {
            $this->_Login();
        }
    }

    //login private karna hanya di butuhkan di sini saja jadi di buat private

    private function _Login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $pengguna = $this->db->get_where('pengguna', ['email' => $email])->row_array();
        if ($pengguna) {
            if (password_verify($password, $pengguna['password'])) { //meyocokan pasword yng telah di enkripsi
                $data = [
                    'email' => $pengguna['email'],
                ];
                $this->session->set_userdata($data);
                redirect('home');
            } else {
                $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
                    Wrong password!
                  </div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
            Email is not registered!
          </div>');
            redirect('login');
        }
    }

    // registrasi
    public function register()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[pengguna.email]', ['is_unique' => 'email sudah ada']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]');

        if ($this->form_validation->run()  == false) {
            $this->load->view('login/register');
        } else {
            $this->login_model->register();
            $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
            Congratulation! your account has been created. please Activate your account!
            </div>');
            redirect('login/register');
        }
    }
}
