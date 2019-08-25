<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiController extends CI_Controller {

    public function AddUser()
    {
        $nama_user = $this->input->post('nama_user');
        $email_user = $this->input->post('email_user');
        $no_hp_user = $this->input->post('no_hp_user');
        $alamat = $this->input->post('alamat');

        //check field
        $this->db->where('email_user',$email_user);
        //check email sudah digunakan apa belum
        $check = $this->db->get('tbl_user');
        if ($check->num_rows() > 0) {
            $data['message']= "Email sudah terdaftar, gunakan email lain";
            $data['status'] = false;
            $data['response_code'] = 500;

            echo json_encode($data);
        }else{
            //tambah data
            $tambah['nama_user'] = $nama_user;
            $tambah['email_user'] = $email_user;
            $tambah['no_hp_user'] = $no_hp_user;
            $tambah['alamat'] = $alamat;
            //action insert
            $masuk = $this->db->insert('tbl_user',$tambah);

            if ($masuk) {
                $data['message']="Pendaftaran Berhasil";
                $data['status'] = true;
                $data['response_code'] = 200;
            }else {
                $data['message']="Pendaftaran Gagal";
                $data['status'] = false;
                $data['response_code'] = 500;
            }
            echo json_encode($data);
        }

    }

    public function ShowDataUSer()
    {
        $result = $this->db->get('tbl_user');

        if ($result->num_rows()>0) {
            $data['message']="Berhasil menampilkan data user";
            $data['status'] = true;
            $data['response_code'] = 200;
            $data['data'] = $result ->result();
        }else {
            $data['message']="Gagal menampilkan data user";
            $data['status'] = false;
            $data['response_code'] = 500;
        }
        echo json_encode($data);
    }

    public function DeleteDataUSer()
    {
        $id_user = $this->input->post("id_user");
        $check_hapus['id_user'] = $id_user;

        $hapus =$this->db->delete('tbl_user', $check_hapus);
        if ($hapus) {
            $data['message']="Berhasil menghapus data user";
            $data['status'] = true;
            $data['response_code'] = 200;
        }else {
            $data['message']="Gagal menghapus data user";
            $data['status'] = false;
            $data['response_code'] = 404;
        }
        echo json_encode($data);
    }
}
