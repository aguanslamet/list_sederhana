<?php
defined('BASEPATH') or exit('No direct script access allowed');

class List_file extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('list_file_model'); //meload model lis_file_model
        if (!$this->session->userdata('email')) { //pembatasan hak access jika blum login tidak di izinkan masuk ke home
            redirect('login');
        }
    }

    //tambah data list
    public function tambah()
    {

        $data['pengguna'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('nama_file', 'nama_file', 'required');


        $data['title'] = 'Tambah Dokumen';

        if ($this->form_validation->run() == false) {
        } else {
            $this->list_file_model->tambah(); //mengambil data dari model list_file_model
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil di Tambah</div>');  //aksi setelah data di submit
            redirect('home');
        }
    }

    //edit data
    public function edit()
    {

        $data['pengguna'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('nama_file', 'nama_file', 'required');


        $data['title'] = 'Edit Dokumen';

        if ($this->form_validation->run() == false) {
        } else {

            $this->list_file_model->edit();
        }
    }

    //hapus data
    public function hapus($id)
    {
        $this->list_file_model->hapus($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil di Hapus</div>');
        redirect('home');
    }
}
