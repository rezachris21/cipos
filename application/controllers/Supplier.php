<?php  
defined('BASEPATH') OR exit();
/**
* 
*/
class Supplier extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('status') != 'login')
		{
			redirect(base_url().'admin?pesan=belumlogin');
		}

		$this->load->model('My_model','m');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	function index()
	{
		$data['supplier'] = $this->db->query("SELECT * FROM tb_supplier")->result();
		$data1['barang'] = $this->db->query("SELECT id,nama_barang,stok FROM tb_barang WHERE stok <= 2 ")->result();
		$data1['jumlah'] = $this->db->query("SELECT id,count(harga_jual) AS jumlah FROM tb_barang WHERE stok <= 2 ")->result();

		$this->load->view('admin/header',$data1);
		$this->load->view('admin/supplier/v_supplier',$data);
		$this->load->view('admin/footer');
	}

	function tambahdata()
	{
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$hp = $this->input->post('hp');

		if ($nama == "")
		{
			$result['pesan'] = "Nama tidak boleh kosong";
		}
		elseif ($alamat == "")
		{
			$result['pesan'] = "Alamat tidak boleh kosong";
		}
		elseif ($hp == "")
		{
			$result['pesan'] = "No HP tidak boleh kosong";
		}
		else
		{
			$result['pesan']="";

			$data = array (
				'nama' => $nama,
				'alamat' => $alamat,
				'hp' => $hp
			);

			$this->m->tambahdata($data,'tb_supplier');
		}
		echo json_encode($result);

	}

	function ambilid()
	{
		$id = $this->input->post('id');
		$where = array (
			'id' => $id
		);
		$datasupplier = $this->m->ambilid('tb_supplier',$where)->result();
		echo json_encode($datasupplier);
	}

	function editdata()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$hp = $this->input->post('hp');

		if ($nama == "")
		{
			$result['pesan'] = "Nama tidak boleh kosong";
		}
		elseif ($alamat == "")
		{
			$result['pesan'] = "Alamat tidak boleh kosong";
		}
		elseif ($hp == "")
		{
			$result['pesan'] = "No HP tidak boleh kosong";
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
				'hp' => $hp
			);

			$this->m->updatedata($where,$data,'tb_supplier');
		}
		echo json_encode($result);
	}

	function hapusdata()
	{
		$id = $this->input->post('id');
		$where = array (
			'id' => $id
		);

		$this->m->hapusdata($where,'tb_supplier');
	}
}
?>