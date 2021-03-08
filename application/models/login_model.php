<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{

    //registrasi
    public function register()
    {

        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        ];
        return  $this->db->insert('pengguna', $data);
    }
}
