<?php
defined ('BASEPATH') OR exit();
/**
* 
*/
class Kustomer extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('status') != "login")
		{
			redirect(base_url().'admin?pesan=belumlogin');
		}

		$this->load->model('My_model','m');
		

	}

	function index()
	{
		$idcabang = $this->session->userdata('idcabang');
		
		$data['kustomer'] = $this->db->query("SELECT * FROM tb_kustomer WHERE idcabang = '$idcabang'")->result();
		$data1['barang'] = $this->db->query("SELECT id,nama_barang,stok FROM tb_barang WHERE stok <= 2 AND idcabang = '$idcabang'")->result();
		$data1['jumlah'] = $this->db->query("SELECT id,count(harga_jual) AS jumlah FROM tb_barang WHERE stok <= 2 AND idcabang = '$idcabang'")->result();

		$this->load->view('admin/header',$data1);
		$this->load->view('admin/kustomer/v_kustomer',$data);
		$this->load->view('admin/footer');
	}

	function tambahdata()
	{
		$idcabang = $this->session->userdata('idcabang');

		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$hp = $this->input->post('hp');
		$email = $this->input->post('email');

		if ($nama == "")
		{
			$result['pesan'] = "Nama harus di isi";
		}
		elseif ($alamat == "")
		{
			$result['pesan'] = "Alamat harus di isi";
		}
		elseif ($hp == "")
		{
			$result['pesan'] = "No HP harus di isi";
		}
		elseif ($email == "")
		{
			$result['pesan'] = "Email harus di isi";
		}
		else
		{
			$result['pesan'] ="";

			$data = array(
				'nama' => $nama,
				'alamat' => $alamat,
				'hp' => $hp,
				'email' => $email,
				'idcabang' => $idcabang
			);

			$this->m->tambahdata($data,'tb_kustomer');
		}
		echo json_encode($result);
	}

	function ambilid()
	{
		$id = $this->input->post('id');
		$where = array(
			'id' => $id
		);
		$datakustomer = $this->m->ambilid('tb_kustomer',$where)->result();
		echo json_encode($datakustomer);
	}

	function editdata()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$hp = $this->input->post('hp');
		$email = $this->input->post('email');

		if ($nama == '')
		{
			$result['pesan'] = "Nama harus di isi";
		}
		elseif ($alamat == '')
		{
			$result['pesan'] = "Alamat harus di isi";
		}
		elseif ($hp == '')
		{
			$result['pesan'] = "No HP harus di isi";
		}
		elseif ($email == '')
		{
			$result['pesan'] = "Email harus di isi";
		}
		else
		{
			$result['pesan'] = "";

			$where = array (
				'id' => $id
			);

			$data = array (
				'nama' => $nama,
				'alamat' => $alamat,
				'hp' => $hp,
				'email' => $email
			);

			$this->m->updatedata($where,$data,'tb_kustomer');
		}
		echo json_encode($result);
	}

	function hapusdata()
	{
		$id = $this->input->post('id');
		$where = array('id'=>$id);

		$this->m->hapusdata($where,'tb_kustomer');
	}	
}
?>
