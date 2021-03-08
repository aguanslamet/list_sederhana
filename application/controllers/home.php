<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) { //melakukan batasan akses jika belum login tidak bisa akses ke halamn user
            redirect('login'); //akan di lempar ke login jika ada yang mencoba masuk tanpa prosedur
        }
    }

    //indek halaman home
    public function index()
    {
        $data['pengguna'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array(); //mengambil data berdasarkan session user yang login 
        $data['post'] = $this->db->get('dokumen')->result_array(); //mengambil semua data pada tabel dokumen
        $query = $this->db->get('dokumen');
        $row = $query->result_array();
        $data['post'] = $row;

        $this->load->view('home', $data);
    }
    public function Logout()
    {
        $this->session->unset_userdata('email'); //memebersihkan data session yng sedang login

        $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
       anda terlah keluar
        </div>');
        redirect('login'); // setelah di bersihkan akan di lempar ke halaman login
    }
}
