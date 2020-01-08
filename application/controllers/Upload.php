<?php
/**
 * 
 */
class Upload extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('My_model','m');
	}

	function index()
	{
		$data1['barang'] = $this->db->query("SELECT id,nama_barang,stok FROM tb_barang WHERE stok <= 2 ")->result();
		$data1['jumlah'] = $this->db->query("SELECT id,count(harga_jual) AS jumlah FROM tb_barang WHERE stok <= 2 ")->result();

		$this->load->view('admin/header',$data1);
		$this->load->view('admin/upload/v_upload');
		$this->load->view('admin/footer');
	}

	function do_upload()
	{
		$config['upload_path'] = "./assets/images";
		$config['allowed_type'] = 'gif|jpg|png';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload',$config);
		if ($this->upload->do_upload("file"))
		{
			$data = array('upload_data' => $this->upload->data());

			$judul = $this->input->post('judul');
			$image = $data['upload_data']['file_name'];

			$result = $this->m->simpan_upload($judul,$image);
			echo json_decode($result);
		}
	}
}
?>