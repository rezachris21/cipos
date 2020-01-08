<?php defined('BASEPATH') OR exit();

class Cabang extends CI_Controller
{
	function __construct()
	{
		parent:: __construct();

		if($this->session->userdata('status') != "login" || $this->session->userdata('level') != "owner"){
			redirect(base_url().'admin?pesan=belumlogin');
		}
		$this->load->model('My_model','m');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{
		$data1['barang'] = $this->db->query("SELECT id,nama_barang,stok FROM tb_barang WHERE stok <= 2 ")->result();
		$data1['jumlah'] = $this->db->query("SELECT id,count(harga_jual) AS jumlah FROM tb_barang WHERE stok <= 2 ")->result();

		$data['cabangs'] = $this->db->query("SELECT * FROM tb_cabang")->result();

		$this->load->view('admin/header',$data1);
		$this->load->view('admin/manage_toko/v_cabang', $data);
		$this->load->view('admin/footer');
	}

	public function tambahdata()
	{
		$txtNamaCabang = $this->input->post('txtNamaCabang');
		$txtLokasiCabang = $this->input->post('txtLokasiCabang');
		$slcStatus = $this->input->post('slcStatus');

		if($txtNamaCabang == "")
		{
			$result['pesan'] = "Nama cabang Harus di isi";
		}
		elseif($txtLokasiCabang == "")
		{
			$result['pesan'] = "Lokasi cabang Harus di isi";
		}
		elseif($slcStatus == "")
		{
			$result['pesan'] = "Status cabang Harus di isi";
		}
		else
		{
			$result['pesan'] = "";

			$data = array(
				'nama_cabang' => $txtNamaCabang,
				'lokasi_cabang' => $txtLokasiCabang,
				'status' => $slcStatus
			);

			$this->m->tambahdata($data, 'tb_cabang');
		}

		echo json_encode($result);

	}

	public function ambilid()
	{
		$id = $this->input->post('id');
		$where = array (
			'id' => $id
		);
		$datacabang = $this->m->ambilid('tb_cabang',$where)->result();

		echo json_encode($datacabang);
	}

	public function editdata()
	{
		$id = $this->input->post('id');
		$txtNamaCabang = $this->input->post('txtNamaCabang');
		$txtLokasiCabang = $this->input->post('txtLokasiCabang');
		$slcStatus = $this->input->post('slcStatus');

		if($txtNamaCabang == "")
		{
			$result['pesan'] = "Nama cabang Harus di isi";
		}
		elseif($txtLokasiCabang == "")
		{
			$result['pesan'] = "Lokasi cabang Harus di isi";
		}
		elseif($slcStatus == "")
		{
			$result['pesan'] = "Status cabang Harus di isi";
		}
		else
		{
			$result['pesan'] = "";

			$where = array(
				'id' => $id
			);

			$data = array(
				'nama_cabang' => $txtNamaCabang,
				'lokasi_cabang' => $txtLokasiCabang,
				'status' => $slcStatus
			);

			$this->m->updatedata($where, $data, 'tb_cabang');
		}

		echo json_encode($result);
	}

	public function hapusdata()
	{
		$id = $this->input->post('id');
		$where = array (
			'id' => $id
		);
		$this->m->hapusdata($where,'tb_cabang');
	}
}
