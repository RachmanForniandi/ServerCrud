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
            $data['response_code'] = 404;

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
                $data['response_code'] = 404;
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
            $data['response_code'] = 404;
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


    public function EditDataUser(){
        $id_user = $this->input->post('id_user');
        $nama_user = $this->input->post('nama_user');
        $email_user = $this->input->post('email_user');
        $no_hp_user = $this->input->post('no_hp_user');
        $alamat = $this->input->post('alamat');

        $check = $this->db->get('tbl_user');
        if ($check->num_rows() > 0) {
            $this->db->where('id_user', $id_user);

            $simpan['nama_user'] = $nama_user;
            $simpan['email_user'] = $email_user;
            $simpan['no_hp_user'] = $no_hp_user;
            $simpan['alamat'] = $alamat;

            $hasil = $this->db->where('id_user',$id_user)->update('tbl_user',$simpan);

            if ($hasil) {
                $data['message']="Berhasil Ubah data user ";
                $data['status'] = true;
                $data['response_code'] = 200;
            }else {
                $data['message']="Gagal ubah data user ";
                $data['status'] = false;
                $data['response_code'] = 404;
            }
            echo json_encode($data);
        }
    }

    public function UploadFileImage(){
        $namafile = "";

		// check
		if(!empty($_FILES['userfile'])){
			$hasil = $this->file_upload('file_gambar');
			if($hasil ['status'] == false) {
				$data['status'] = false;
				$data['message'] = $hasil['message'];
				return $data;
			} else {
				$namafile = $hasil['namafile'];
			}
		}
		$tambah['file_gambar'] = $namafile;

		$masuk = $this->db->insert('tbl_gambar', $tambah);
		if($masuk){
			$data['message'] = 'Berhasil Menambah data';
			$data['status'] = true;
		} else {
			$data['message'] = 'Gagal Menambah data';
			$data['status'] = false;
		}
		echo json_encode($data);
	}

    public function file_upload($folder = 'file_gambar', $size = 3000000) //size = byte -> megabyte
	{
		$data = array();
		$folder = 'img/' .$folder. '/';

		$filename = $_FILES['userfile']['name'];

		$file_basename = substr($filename,0,strripos($filename, '.'));
		$file_ext = substr($filename,strripos($filename, '.')); //mendapatkan filename

		$filesize = $_FILES['userfile']['size'];
		$allowed_file_type = array('.jpg', '.png'); // tipe file yang bisa digunakan

		//validasi
		if(in_array($file_ext, $allowed_file_type) && ($filesize < $size)){
			//ganti nama file
			$newfilename = md5($file_basename.date('YmdHis')).$file_ext;

			// check ketika nama sudah ada atau belum
			if(file_exists($folder.$newfilename)){
				$data['status'] = false;
				$data['message'] = 'File sudah ada diserver';
			} else {
				if(move_uploaded_file($_FILES['userfile']['tmp_name'],$folder.$newfilename)){
					$data['status'] = true;
					$data['namafile'] = $newfilename;
					$data['message'] = "Berhasil Upload File";
				}else {
					$data['status'] = false;
					$data['message'] = 'Gagal Upload Data';
				}
			}
		}

		// cek jika data kosong
		else if(empty($file_basename)){
			$data['status'] = false;
            $data['message'] = "Silahkan pilih file untuk di upload";
            echo json_encode($data);

		}

		//cek ukuran file
		else if($filesize > $size){
			$data['status'] = false;
            $data['message'] = "Ukuran file tidak boleh lebih dari 3MB";
            echo json_encode($data);

		}

		//cek tipe file
		else{
			unlink(($_FILES['userfile']['tmp_name']));
			$data['status'] = false;
            $data['message'] = "File harus ber ekstensi".implode(',', $allowed_file_type);
            echo json_encode($data);

        }
		return $data;
	}
}
