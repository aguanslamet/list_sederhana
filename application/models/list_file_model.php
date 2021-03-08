<?php
defined('BASEPATH') or exit('No direct script access allowed');

class List_file_model extends CI_Model
{
    //model tambah
    public function tambah()
    {

        $upload_file = $_FILES['file']; //ambil nama dari form

        if ($upload_file) { //cek file 
            $config['allowed_types'] = 'pdf|doc|docx';
            $config['upload_path'] = './assets/file/';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                echo $this->upload->display_errors();
            } else {
                $data = [

                    'nama_file' => $this->input->post('nama_file'),
                    'file' => $this->upload->data('file_name')

                ];

                return $this->db->insert('dokumen', $data);
            }
        }
    }

    // model edit
    public function edit()
    {

        $id = $this->input->post('id_file');


        $upload_file = $_FILES['file'];

        if ($upload_file) {
            $config['allowed_types'] = 'pdf|doc|docx';
            $config['upload_path'] = './assets/file/pendukung/';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $data = [

                    'nama_file' => $this->input->post('nama_file')

                ];

                $this->db->where('id_file', $id);
                $this->db->update('dokumen', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil di Ubah</div>');
                redirect('home');
            } else {
                $data = [

                    'nama_file' => $this->input->post('nama_file'),
                    'file' => $this->upload->data('file_name')

                ];

                $this->db->where('id_file', $id);
                $this->db->update('dokumen', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil di Ubah</div>');
                redirect('home');
            }
        }
    }
    //hapus
    public function hapus($id)
    {
        $this->db->where('id_file', $id);
        $this->db->delete('dokumen');
    }
}
