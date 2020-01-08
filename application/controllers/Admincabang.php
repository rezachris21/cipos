<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admincabang extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('status') != 'login')
		{
			redirect(base_url().'admin?pesan=belumlogin');
		}

		$this->load->model('My_model','m');

	}
	
	public function index()
	{
		
		$data['user'] = $this->db->query("SELECT tb_pengguna.id as id, tb_pengguna.nama as nama, tb_pengguna.username as username, tb_pengguna.password as password, tb_pengguna.level as level, tb_pengguna.foto as foto, tb_cabang.nama_cabang as nama_cabang FROM tb_pengguna,tb_cabang WHERE tb_pengguna.idcabang = tb_cabang.id AND level = 'admin' ")->result();
		$data['cabangs'] = $this->db->query("SELECT * FROM tb_cabang")->result();
		
		$data1['barang'] = $this->db->query("SELECT id,nama_barang,stok FROM tb_barang WHERE stok <= 2 ")->result();
		$data1['jumlah'] = $this->db->query("SELECT id,count(harga_jual) AS jumlah FROM tb_barang WHERE stok <= 2 ")->result();

  		$this->load->view('admin/header',$data1);
  		$this->load->view('admin/manage_toko/v_admin_cabang',$data);
  		$this->load->view('admin/footer');
	}

	public function do_upload()
    {
		$config['upload_path'] = './assets/images';
		$config['allowed_types'] = 'gif|jpg|png';
		//$config['encrypt_name'] = TRUE;

		$this->load->library('upload',$config);

		if ($this->upload->do_upload("file"))
		{
			$data = array ('upload_data' => $this->upload->data());

			$idcabang = $this->session->userdata('idcabang');

			$nama = $this->input->post('nama');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$upassword = $this->input->post('upassword');
			$cabang = $this->input->post('cabang');
			$image = $data['upload_data']['file_name'];

			$result = $this->m->simpan_upload_admin($idcabang,$nama,$username,$password,$cabang,$image);
			echo json_decode($result);

		}
	}
	
	public function ambilid()
    {
		$id = $this->input->post('id');
		$where = array (
			'id' => $id
		);

		$datauser = $this->m->ambilid('tb_pengguna',$where)->result();
		echo json_encode($datauser);
	}
	
	public function editdata()
    {
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$upassword = $this->input->post('upassword');
		$cabang = $this->input->post('cabang');

		if ($nama == '')
		{
			$result['pesan'] = "Nama harus di isi";
		}
		elseif ($username == '')
		{
			$result['pesan'] = "Username harus di isi";
		}
		elseif ($password == '') 
		{
			$result['pesan'] = "Password harus di isi";  
		}
		elseif ($upassword == '') 
		{
			$result['pesan'] = "Ulangi Password harus di isi";  
		}
		elseif ($password != $upassword) 
		{
			$result['pesan'] = "Password harus Sama";  
		}
		elseif ($cabang == '')
		{
			$result['pesan'] = "Cabang harus di isi";
		}
		else
		{
			$result['pesan'] = "";

			$where = array(
				'id' => $id
			);

			$data = array(
				'nama' => $nama,
				'username' => $username,
				'password' => md5($password),
				'idcabang' => $cabang
			);

			$this->m->updatedata($where,$data,'tb_pengguna');

		}
		echo json_encode($result);
	}
	
	public function hapusdata()
    {
		$id = $this->input->post('id');
		$where = array (
			'id' => $id
		);
		$this->m->hapusdata($where,'tb_pengguna');
    }
}
